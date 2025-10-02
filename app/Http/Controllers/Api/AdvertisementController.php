<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertisementResource;
use App\Models\Advertisement;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $advertisements = null;
        if ($request->location) {
            $validated = $request->validate([
                'location' => 'nullable|string',
            ]);
            $location = $validated['location'];
            $advertisements = Advertisement::where('city', 'LIKE', "%{$location}%")->whereNotNull('admin_id')->get();
        } else {
            $advertisements = Advertisement::whereNotNull('admin_id')->get();
        }

        return response()->json([
            'message' => $advertisements->count() . " Advertisements found",
            'data' => AdvertisementResource::collection($advertisements),
        ], 200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'description' => 'nullable|string',
            'no_rooms' => 'required|integer|min:0',
            'property_size' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'property_type' => 'required|string|max:255',
        ]);

        $ad = $request->user()->advertisements()->create($validated);

        return response()->json([
            'message' => 'Advertisement created successfully',
            'data' => $ad
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advertisement = Advertisement::find($id);

    if (!$advertisement) {
        return response()->json([
            'message' => 'Advertisement not found'
        ], 404);
    }

    return new AdvertisementResource($advertisement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        // ensure only the owner can update
    if ($advertisement->user_id !== $request->user()->id) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $validated = $request->validate([
        'title' => 'sometimes|string|max:255',
        'price' => 'sometimes|numeric|min:0',
    ]);

    $advertisement->update($validated);

    return response()->json([
        'message' => 'Advertisement updated successfully',
        'data' => $advertisement
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Advertisement $advertisement)
    {
         if ($advertisement->user_id === $request->user()->id || $request->user()->user_type == 'admin') {

        $advertisement->delete();
        return response()->json(['message' => 'Advertisement deleted successfully']);
    }
    return response()->json(['message' => 'Unauthorized'], 403);




    }

    public function valuvate(Request $request, Advertisement $advertisement) {
        if ($request->user()->user_type === 'admin') {
            if ($advertisement->admin_id) {
                return response()->json([
        'message' => 'This advertisement is already valuvated',
        'data' => $advertisement
            ]);
            }
            $valuvated = ['admin_id' => $request->user()->id];
            $advertisement->update($valuvated);

            return response()->json([
        'message' => 'Valuvation status updated successfully',
        'data' => $advertisement
            ]);

        }
    }

    public function buyAdvertisement(Request $request, Advertisement $advertisement)
{
    $user = $request->user();

    // Prevent buying own advertisement
    if ($advertisement->user_id === $user->id) {
        return response()->json(['message' => 'You cannot buy your own advertisement.'], 403);
    }

    DB::transaction(function () use ($advertisement, $user) {
        Transaction::create([
            'user_id' => $user->id,
            'title'   => $advertisement->title,
            'amount'  => $advertisement->price,
            'type'    => 'debit',
        ]);

        $advertisement->delete();
    });

    return response()->json([
        'message' => 'Purchase successful. Advertisement removed and transaction recorded.'
    ], 201);
}
}

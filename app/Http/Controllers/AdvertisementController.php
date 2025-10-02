<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
 public function search(Request $request)
    {

        $query = $request->get('query');

        // [what] Filtering advertisements using either city or country attributes
        $advertisements = Advertisement::where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('city', 'like', '%' . $query . '%')
                ->orWhere('country', 'like', '%' . $query . '%');
        })
        ->whereNotNull('admin_id') // [why] Ensure listed advertisement is validated by the admin
        ->where(function ($queryBuilder) use ($request) {
            // [why] make sure your own advertisements are not shown
            if ($request->user()) {
                $queryBuilder->where('user_id', '!=', $request->user()->id);
            }
        })
        ->paginate(8);

        return view('guest.properties', compact('advertisements', 'query'));
    }
    public function edit($ad_id)
    {

        $advertisement = Advertisement::findOrFail($ad_id);


        return view('advertisements.edit', compact('advertisement'));

}
 public function addAdvertisement()
    {

        return view('advertisements.create');
    }

    public function store(Request $request)
    {

    $request->validate([
        'title' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'description' => 'required|string',
        'no_rooms' => 'nullable|integer',
        'property_size' => 'nullable|numeric',
        'price' => 'nullable|numeric',
        'property_type' => 'required|string|max:255',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
    ]);

    // Handle the image upload if there's one
    if ($request->hasFile('image_path')) {
        $imageName = time() . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('uploads'), $imageName);
    } else {
        $imageName = null;
    }


    Advertisement::create([
        'title' => $request->title,
        'city' => $request->city,
        'country' => $request->country,
        'description' => $request->description,
        'no_rooms' => $request->no_rooms,
        'property_size' => $request->property_size,
        'price' => $request->price,
        'property_type' => $request->property_type,
        'image_path' => $imageName,
        'user_id' => $request->user()->id,
    ]);

    return redirect()->route('member.dashboard');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
    ]);


    $advertisement = Advertisement::findOrFail($id);

    $advertisement->title = $request->input('title');
    $advertisement->price = $request->input('price');

    // [summary] Image uploads in server storage
    if ($request->hasFile('image_path')) {
        $imageName = time() . '.' . $request->image_path->extension();
        $request->image_path->move(public_path('uploads'), $imageName);
    }
        $advertisement->image_path = $imageName;

    $advertisement->save();

    return redirect()->route('member.dashboard');
}
}

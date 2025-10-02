<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Transaction;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
     public function purchase(Request $request, $ad_id)
    {

        $advertisement = Advertisement::findOrFail($ad_id);


        Transaction::create([
            'user_id' => $request->user()->id,
            'title' => $advertisement->title,
            'amount' => $advertisement->price,
            'type' => 'credit',
        ]);


        $advertisement->delete();


        return redirect()->route('properties')->with('success', 'Transaction completed successfully!');
    }

    public function load(Request $request) {
        $transactions = Transaction::where('user_id', $request->user()->id)->get();
        return view('member.transactions', ['transactions' => $transactions]);
    }
}

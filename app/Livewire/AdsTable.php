<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Livewire\Component;
use Illuminate\Http\Request;

class AdsTable extends Component
{
    public $ads;

    public function render()
    {
        $this->ads = Advertisement::all();

        return view('livewire.ads-table');
    }

    public function removeAd($adId)
    {
        $ad = Advertisement::find($adId);
        $ad->delete();

        // Refresh the ad list after removal
        $this->ads = Advertisement::all();
    }

    public function validateAd($adId, Request $request)
    {
        $ad = Advertisement::find($adId);
        $ad->admin_id = $request->user()->id;
        $ad->save();

        $this->ads = Advertisement::all();
    }
}

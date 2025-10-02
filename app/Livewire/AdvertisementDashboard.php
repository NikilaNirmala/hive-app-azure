<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Livewire\Component;

class AdvertisementDashboard extends Component
{
   public $advertisements = [];


    public function mount(Request $request)
    {

        $this->advertisements = $request->user()->advertisements;
    }


    public function deleteAdvertisement($adId, Request $request)
    {

        $advertisement = Advertisement::find($adId);

        if ($advertisement && $advertisement->user_id == $request->user()->id) {

            $advertisement->delete();
        }


        $this->advertisements = $request->user()->advertisements;
    }


    public function editAdvertisement($adId)
    {
        return redirect()->route('advertisement.edit', ['ad_id' => $adId]);
    }

    public function render()
    {
        return view('livewire.advertisement-dashboard');
    }
}

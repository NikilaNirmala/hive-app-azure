<?php

namespace App\Livewire;

use App\Models\Request;
use Livewire\Component;

class RequestsTable extends Component
{
    public $userId;

    public $requests;


    public function mount($userId)
    {

        $this->userId = $userId;


        $this->requests = Request::all();
    }


    public function deleteRequest($requestId)
    {
        $request = Request::find($requestId);
        if ($request) {
            $request->delete();

            $this->requests = $this->requests->where('id', '!=', $requestId);
        }


        session()->flash('message', 'Request deleted successfully.');
    }

    public function render()
    {
        return view('livewire.requests-table');
    }
}

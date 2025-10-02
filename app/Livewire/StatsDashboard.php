<?php

namespace App\Livewire;

use App\Models\Advertisement;
use App\Models\User;
use Livewire\Component;

class StatsDashboard extends Component
{
   public $membersCount = 0;
    public $agentsCount = 0;
    public $adminsCount = 0;
    public $adsCount = 0;

    public function mount()
    {
        $this->updateCounts();
    }

    public function updateCounts()
    {

        $this->membersCount = User::where('user_type', 'member')->count();
        $this->agentsCount = User::where('user_type', 'agent')->count();
        $this->adminsCount = User::where('user_type', 'admin')->count();
        $this->adsCount = Advertisement::count();
    }

    public function render()
    {
        return view('livewire.stats-dashboard');
    }
}


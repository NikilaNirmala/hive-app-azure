<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    public $users;


    public function render()
    {

        $this->users = User::where('user_type', '!=', 'admin')->get();

        return view('livewire.user-table');
    }


    public function userAction($userId)
    {
        $user = User::find($userId);
        $user->status = !$user->status;
        $user->save();

        $this->users = User::where('user_type', '!=', 'admin')->get();
    }
}

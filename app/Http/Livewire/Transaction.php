<?php

namespace App\Http\Livewire;

use App\Models\Transactions;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Transaction extends Component
{
    public $user;
    public $readyToLoad = false;

    public function mount(){
        $this->user = Auth::user();
    }

    public function loadTransactions(){
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.transaction', [
            'transactions' => $this->readyToLoad ?
             Transactions::orderByDesc('id')->where('admin_id', $this->user->id)->get() :
             [] ,
        ]);
    }
}

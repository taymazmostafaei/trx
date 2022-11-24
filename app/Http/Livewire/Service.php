<?php

namespace App\Http\Livewire;

use App\Models\Service as ModelsService;
use App\Models\ServiceMod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Service extends Component
{
    public $user;
    public $readyToLoad = false;
    public $plans;
    public $ShowCreateServicePart = false;

    public function pay($planId){
        $planId = ServiceMod::find($planId);
        dd($planId);
    }

    public function mount(){
        $this->user = Auth::user();
    }

    public function loadServices(){
        $this->readyToLoad = true;
    }

    public function NewService(){
        $this->ShowCreateServicePart = true;
        $this->plans = ServiceMod::all();
    }

    public function ServiceList(){
        $this->ShowCreateServicePart = false;
    }

    public function render()
    {
        return view('livewire.service', [
            'services' => $this->readyToLoad ?
             ModelsService::orderByDesc('id')->where('admin_id', $this->user->id)->get() :
             [] ,
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Http\Controllers\InboundsController;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Clients extends Component
{
    public $readyToLoad = false;
    public $user;
    public $link;
    public $newAccountModel = false;
    public $newClientName;
    protected $clients = [];
    public $error = false;


    public function NewAccount()
    {
        $this->newAccountModel = true;
    }

    public function createNewClient()
    {
        $ic = new InboundsController();
        $result = $ic->CreateClient($this->user, $this->newClientName);
        if ($result) {
            $this->newAccountModel = false;
            return;
        }
        $this->error = "برای خرید بیشتر باید بدهی خود را پرداخت کنید.";
    }

    public function mount($data = '')
    {
        $this->data = $data;
        $this->show = false;
        $this->user = Auth::user();
    }

    public function getLink($id, $port, $remark, $name, $sid, $sni, $pbk)
    {

        $ic = new InboundsController();
        $this->link = $ic->createConnectLink($id, $port, $remark, $name, $sid, $sni, $pbk);
        $this->showModal($this->link);
    }

    public function Clientstatus($enable ,$uuId, $name, $inbound, $expiry){
        $ic = new InboundsController();
        $ic->ClientStatus($enable ,$this->user, $name, $inbound, $expiry, $uuId);
    }

    public function getClientsData()
    {
        $ic = new InboundsController();
        $this->clients = $ic->fetchClients($this->user);
        return $this->clients;
    }

    public function delete($id, $inbound)
    {
        $ic = new InboundsController();
        $ic->deleteClient($id, $inbound, $this->user);
    }

    public function loadClients()
    {
        $this->readyToLoad = true;
    }

    public $data;
    public $show;

    protected $listeners = ['showModal' => 'showModal'];

    public function showModal($data = "")
    {
        $this->data = $data;
        $this->doShow();
    }

    public function doShow()
    {
        $this->show = true;
    }

    public function doClose()
    {
        $this->show = false;
    }

    public function doSomething()
    {
        // Do Something With Your Modal

        // Close Modal After Logic
        $this->doClose();
    }

    public function render()
    {
        return view('livewire.clients', [
            'clients' => $this->readyToLoad ? $this->getClientsData() :
                $this->clients,
        ]);
    }
}

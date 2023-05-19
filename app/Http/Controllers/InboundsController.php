<?php

namespace App\Http\Controllers;

use App\Models\Debt;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class InboundsController extends Controller
{

    /**
     * get user related clients data
     * @return clients
     */

    public function fetchClients($user)
    {
        $clients = [];

        if (!$user->inbounds) {
            return [];
        }

        foreach ($user->inbounds->access['inbounds'] as $inbound) {

            $data = json_decode(Http::withHeaders([
                'Cookie' => 'session=' . Cache::get('xuisession'),
                'Accept' => 'application/json',
            ])->get('http://159.223.249.93:43210/xui/API/inbounds/get/' . $inbound)->body());

            $config = json_decode($data->obj->settings);
            $streamSettings = json_decode($data->obj->streamSettings);

            foreach ($config->clients as $client) {

                $client->inboundId = $inbound;
                $client->port = $data->obj->port;
                $client->remark = $data->obj->remark;
                $client->pbk = $streamSettings->realitySettings->settings->publicKey;
                $client->sni = $streamSettings->realitySettings->serverNames[0];
                $client->sid = $streamSettings->realitySettings->shortIds[0];
                $clients[] = $client;
            }
        }

        return array_reverse($clients);
    }

    /**
     * create link
     */
    public function createConnectLink($id, $port, $remark, $name, $sid, $sni, $pbk)
    {

        $link = "vless://$id@route.taymaz.online:$port?type=grpc&serviceName=&security=reality&fp=firefox&pbk=$pbk&sni=$sni&sid=$sid#$remark-$name";

        return $link;
    }

    public function deleteClient($id, $inbound, $user)
    {
        if (!in_array($inbound ,$user->inbounds->access['inbounds'])) {
            return false;
        }


        $result = Http::withHeaders([
            'Cookie' => 'session=' . Cache::get('xuisession'),
            'Accept' => 'application/json',
        ])
            ->post("http://159.223.249.93:43210/xui/API/inbounds/$inbound/delClient/$id");

        $debt = Debt::where('client_id', $id)->first();
        $debt->delete();
        return true;
    }

    public function CreateClient($user, $name)
    {
        if (!empty($user->debts[4])) {
            return false;
        }


        $inbound = $user->inbounds->access['inbounds'][array_rand($user->inbounds->access['inbounds'])];
        $uuId = (string) Str::uuid();

        $setting = "{\"clients\":[{\"id\":\"$uuId\",\"alterId\":0,\"email\":\"$name\",\"limitIp\":1,\"totalGB\":75161927680,\"expiryTime\":-2592000000,\"enable\":true,\"tgId\":\"\",\"subId\":\"\"}]}";

        $postData = [

            "id" => $inbound,
            "settings" => $setting
        ];


        $result = Http::withHeaders([
            'Cookie' => 'session=' . Cache::get('xuisession'),
            'Accept' => 'application/json',
        ])->post("http://159.223.249.93:43210/xui/API/inbounds/addClient", $postData);

        $debt = new Debt([
            'admin_id' => $user->id,
            'inbound_id' => $inbound,
            'client_id' => $uuId,
            'amount' => 80000
        ]);
        $debt->save();

        return true;
    }


    public function ClientStatus($enable ,$user, $name, $inbound, $expiry, $uuId)
    {
        if (!in_array($inbound ,$user->inbounds->access['inbounds'])) {
            return false;
        }

        $setting = "{\"clients\":[{\"id\":\"$uuId\",\"alterId\":0,\"email\":\"$name\",\"limitIp\":1,\"totalGB\":75161927680,\"expiryTime\":$expiry,\"enable\":$enable,\"tgId\":\"\",\"subId\":\"\"}]}";

        $postData = [

            "id" => $inbound,
            "settings" => $setting
        ];

        $result = Http::withHeaders([
            'Cookie' => 'session=' . Cache::get('xuisession'),
            'Accept' => 'application/json',
        ])->post("http://159.223.249.93:43210/xui/API/inbounds/updateClient/$uuId", $postData);

        return true;
    }
}

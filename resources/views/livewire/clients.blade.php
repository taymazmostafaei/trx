<div>
    @if ($error)
        <div class="alert alert-warning" role="alert">
            {{ $error }}
        </div>
    @endif
    @if ($newAccountModel)
        <input type="text" wire:model.lazy="newClientName" placeholder="نام مشتری">
        <button class="btn btn-success btn-sm" wire:click="createNewClient">خرید</button>
    @else
        <div><button wire:click="NewAccount" class="btn btn-success"> خرید اکانت +</button></div>
    @endif

    <br>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام مشتری</th>
                <th scope="col">وضیعت سرویس</th>
                <th scope="col">تعداد آیپی</th>
                <th scope="col">تاریخ سررسید</th>
                <th scope="col">کد مشتری</th>
                <th scope="col">عملیات</th>
            </tr>
        </thead>
        <tbody wire:init="loadClients">
            @php
                $counter = 1;
            @endphp
            @foreach ($clients as $client)
                <tr>
                    <th scope="row">{{ $counter++ }}</th>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->enable ? 'فعال' : 'غیرفعال' }}</td>
                    <td>{{ $client->limitIp }}</td>
                    <td>{{ $client->expiryTime <= 0 ? 'بینهایت-30 روز' : date("Y-m-d H:i:s", $client->expiryTime/1000) }}</td>
                    <td>{{ $client->id }}</td>
                    <td>
                        <button class="btn btn-outline-dark btn-sm"
                            wire:click="getLink({{ "'$client->id','$client->port','$client->remark','$client->email','$client->sid','$client->sni','$client->pbk'" }})">لینک
                            اتصال</button>
                        <button class="btn btn-outline-danger btn-sm" wire:click="delete('{{ $client->id }}','{{ $client->inboundId }}')">لغو خرید</button>
                        @if ($client->enable)
                            <button class="btn btn-outline-success btn-sm" wire:click="Clientstatus({{ "0,'$client->id','$client->email',$client->inboundId,'$client->expiryTime'" }})">قطع اتصال</button>
                        @else
                            <button class="btn btn-outline-warning btn-sm" wire:click="Clientstatus({{ "1,'$client->id','$client->email',$client->inboundId,'$client->expiryTime'" }})">فعال سازی</button>
                        @endif

                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div wire:loading>
        در حال بارگیری...
    </div>


    <div class="modal fade @if ($show === true) show @endif" id="myExampleModal"
        style="display: @if ($show === true) block
         @else
                 none @endif;"
        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">لینک اتصال</h5>
                    <button class="close" type="button" aria-label="Close" wire:click.prevent="doClose()">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- The Data From The $emit Will Show Up Here --}}
                    <input type="text" id="copy_{{ $data }}" value="{{ $data }}">

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" wire:click.prevent="doClose()">Close</button>

                    <button class="btn btn-secondary" type="button"
                        onclick="copyToClipboard('copy_{{ $data }}')">
                        Copy</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Let's also add the backdrop / overlay here -->
    <div class="modal-backdrop fade show" id="backdrop"
        style="display: @if ($show === true) block
         @else
                 none @endif;"></div>


    <script>
        function copyToClipboard(id) {
            document.getElementById(id).select();
            document.execCommand('copy');
        }
    </script>


</div>

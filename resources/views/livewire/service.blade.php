<div>
    @if ($ShowCreateServicePart)
        <div><button wire:click="ServiceList" class="btn btn-secondary">
                <- سرویس ها</button>
        </div>
        <hr>
        <div class="container">
            <div class="card-deck mb-3 text-center">
                <div class="row">
                    @foreach ($plans as $plan)
                        <div class="card m-4 box-shadow col-lg-4">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">تومن {{ number_format($plan->price, 0, ',') }}
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    
                                    @foreach ($plan->options['items'] as $item)
                                        <li>{{$item}}</li>
                                    @endforeach
                                </ul>
                                <button type="button" wire:click="pay({{$plan->id}})" class="btn btn-lg btn-block btn-primary">خرید سریع</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div><button wire:click="NewService" class="btn btn-success">ایجاد سرویس +</button></div>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام سرویس</th>
                    <th scope="col">تاریخ سررسید</th>
                    <th scope="col">کد اتصال</th>
                </tr>
            </thead>
            <tbody wire:init="loadServices">
                @php
                    $counter = 1;
                @endphp
                @foreach ($services as $service)
                    <tr>
                        <th scope="row">{{ $counter++ }}</th>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->deadline }}</td>
                        <td>{{ $service->uuid }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div wire:loading>
            در حال بارگیری...
        </div>
    @endif
</div>

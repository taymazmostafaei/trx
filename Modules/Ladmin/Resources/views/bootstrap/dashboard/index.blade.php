<x-ladmin-auth-layout>
    <x-slot name="title">داشبورد</x-slot>
    <div class="m-3">
        <div class="row">
            <div class="col-lg-6 m-0 p-0">
                <x-ladmin-card class="rounded-0">
                    <x-slot name="body">
                        <div class="d-flex align-item-top">
                            <div class="me-3">
                                <i class="fa-3x text-primary fa-solid fa-cogs"></i>
                            </div>
                            <div>
                                <a href="{{route('ladmin.service.index')}}" class="text-decoration-none">
                                    <h5 class="card-title">سرویس ها</h5>
                                </a>
                                <p class="text-muted">
                                    {{$ServiceCount}}
                                </p>
                            </div>
                        </div>
                    </x-slot>
                </x-ladmin-card>
            </div>
        </div>
    </div>


</x-ladmin-auth-layout>

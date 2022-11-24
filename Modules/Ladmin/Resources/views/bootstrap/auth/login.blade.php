<x-ladmin-guest-layout meta-title="ورود">

    <div class="row justify-content-center align-items-center d-flex vh-100">
        <div class="col-lg-4 col-md-6 col-sm-10 col-xs-10">
            <x-ladmin-card class="mx-3 mb-5 rounded-lg">
                <x-slot name="body">
                    <div class="px-4">
                        <div class="text-center p-3">
                            <img src="{{ config('ladmin.logo') }}" alt="Logo" class="mb-3" width="200">
                            <div>ورود</div>
                        </div>

                        <x-ladmin-alert class="mb-3" />

                        <form action="{{ route('ladmin.login.attempt') }}" method="POST">
                            @csrf

                            <x-ladmin-input type="email" class="mb-3" name="email" value="{{ old('email') }}" placeholder="آدرس ایمیل" />

                            <x-ladmin-input type="password" class="mb-4" name="password" placeholder="رمز عبور" />

                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <div>
                                    <input type="checkbox" id="remember" name="remember">
                                    <label for="remember">من را یاد آوری کن</label>
                                </div>

                                @if (Route::has('ladmin.password.form'))
                                    <div>
                                        <a href="{{ route('ladmin.password.form') }}">فراموشی رمز عبور</a>
                                    </div>
                                @endif

                            </div>

                            <div class="text-end mb-4">
                                <x-ladmin-button>ورود</x-ladmin-button>
                            </div>
                        </form>
                    </div>
                </x-slot>
            </x-ladmin-card>
            <div class="text-center">
                <a href="{{ route('ladmin.register')}}">&larr; ثبت نام</a>
            </div>
            <div class="text-center">
                <a href="{{ url('/') }}">&larr; بازگشت به خانه</a>
            </div>
        </div>
    </div>

</x-ladmin-guest-layout>

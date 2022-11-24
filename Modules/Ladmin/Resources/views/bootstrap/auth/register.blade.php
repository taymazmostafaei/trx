<x-ladmin-guest-layout meta-title="ثبت نام">

    <div class="row justify-content-center align-items-center d-flex vh-100">
        <div class="col-lg-4 col-md-6 col-sm-10 col-xs-10">
            <x-ladmin-card class="mx-3 mb-5 rounded-lg">
                <x-slot name="body">
                    <div class="px-4">
                        <div class="text-center p-3">
                            <img src="{{ config('ladmin.logo') }}" alt="Logo" class="mb-3" width="200">
                            <div>ساخت حساب کاربری</div>
                        </div>

                        <x-ladmin-alert class="mb-3" />

                        <form action="{{ route('ladmin.register.attempt') }}" method="POST">
                            @csrf


                            <x-ladmin-input type="text" class="mb-3" name="name" value="{{ old('name') }}" placeholder="نام نام خانوادگی" />
                            <x-ladmin-input type="email" class="mb-3" name="email" value="{{ old('email') }}" placeholder="آدرس ایمیل" />
                            <x-ladmin-input type="password" class="mb-4" name="password" placeholder="رمز عبور" />
                            <x-ladmin-input type="password" class="mb-4" name="password_confirmation" placeholder="تکرار رمز عبور" />


                            <div class="mb-4 d-flex align-items-center justify-content-between">

                                @if (Route::has('ladmin.password.form'))
                                    <div>
                                        <a href="{{ route('ladmin.login') }}">ورود</a>
                                    </div>
                                @endif

                            </div>

                            <div class="text-end mb-4">
                                <x-ladmin-button>ثبت نام</x-ladmin-button>
                            </div>
                        </form>
                    </div>
                </x-slot>
            </x-ladmin-card>

            <div class="text-center">
                <a href="{{ url('/') }}">&larr; بازگشت به خانه</a>
            </div>
        </div>
    </div>

</x-ladmin-guest-layout>

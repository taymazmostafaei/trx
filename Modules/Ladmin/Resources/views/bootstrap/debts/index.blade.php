<x-ladmin-auth-layout>
    <x-slot name="title">بدهی ها</x-slot>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">مبلغ</th>
                <th scope="col">کد مشتری</th>
                <th scope="col">تاریخ خرید</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
                $fullAmount = 0;
            @endphp
            @foreach ($debts as $debt)
            @php
                $fullAmount += $debt->amount;
            @endphp
                <tr>
                    <th scope="row">{{ $counter++ }}</th>
                    <td>{{ number_format( $debt->amount ) }}</td>
                    <td>{{ $debt->client_id }}</td>
                    <td>{{ $debt->created_at }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <hr>
    <p>مجموع بدهی:
        {{number_format($fullAmount)}}
        تومن
    </p>

</x-ladmin-auth-layout>

<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">مبلغ</th>
                <th scope="col">تاریخ</th>
                <th scope="col">وضیعت</th>
                <th scope="col">شماره تراکنش</th>
            </tr>
        </thead>
        <tbody wire:init="loadTransactions">
            @php
                $counter = 1;
            @endphp
            @foreach ($transactions as $transaction)
                <tr>
                    <th scope="row">{{ $counter++ }}</th>
                    <td>{{ number_format($transaction->price,0,',')  }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->status == "fail" ? "ناموفق" : "موفق" }}</td>
                    <td>{{ $transaction->id }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div wire:loading>
        در حال بارگیری...
    </div>
</div>

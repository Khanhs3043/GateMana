@extends('layouts.app')
@section('content')
        <h1>Lịch sử thanh toán</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mã thanh toán</th>
                    <th>Số tiền</th>
                    <th>Ngày thanh toán</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentHistories as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ number_format($payment->amount, 2) }} VND</td>
                        <td>{{ $payment->payment_date}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection

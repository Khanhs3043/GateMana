@extends('layouts.app')

@section('content')

<!-- Nội dung chính -->
<div class="container">

    <div class="wrap2">
        <div class="wrap1">
           <h2 >Lịch sử ra vào</h2> 
        </div>
        <div class="d-flex align-items-center">
            <h2 class="mb-0">Tổng tiền: {{ number_format($totalAmount, 2) }} VND</h2>
            <button class="btn btn-success btn-payment">Thanh Toán</button>
        </div>
    </div>

    <!-- Bảng lịch sử -->
    <table class="table table-bordered table-hover mt-4">
        <thead>
            <tr>
                <th>Thời gian vào</th>
                <th>Thời gian ra</th>
                <th>Số tiền (VND)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parkingHistories as $history)
                <tr>
                    <td>{{ $history->entry_time }}</td>
                    <td>{{ $history->exit_time ?? 'Chưa ra' }}</td>
                    <td>{{ $history->amount ? number_format($history->amount, 2) : 'Chưa có' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

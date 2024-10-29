@extends('layouts.app')

@section('content')

<!-- Nội dung chính -->
<div class="container">

    <div class="wrap2">
        <div class="wrap1">
           <h2>Lịch sử ra vào</h2> 
        </div>
        <div class="d-flex align-items-center">
            <h2 class="mb-0">Tổng tiền: {{ number_format($totalAmount, 0) }} VND</h2>
            @if($totalAmount>0)
            <button class="btn btn-success btn-payment" id="btn-payment">Thanh Toán</button>
            @endif
        </div>
    </div>

    <!-- Box chứa mã QR -->
     <div id="qrbox" style="display: none;">
    <div id="qr-box" >
        <h3>QR Thanh Toán</h3>
        <div id="qr-code"></div>
            <button class="btn btn-close" id="btn-close-qr" >&times;</button>
            <button class="btn btn-primary" style="background-color: #28a745;">Hoàn thành</button>
    </div></div>

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
                    <td>{{ $history->amount ? number_format($history->amount, 0) : 'Chưa có' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-payment').addEventListener('click', function() {
            const amount = {{ $totalAmount }}; // Lấy tổng tiền từ Blade
            const bankId = '546034'; 
            const accountNo = '0944358547'; 
            const template = 'qr_only'; 
            
            // Tạo URL cho mã QR
            const qrCodeUrl = `https://img.vietqr.io/image/${bankId}-${accountNo}-${template}.png?amount=${amount}`;
            
            // Hiển thị mã QR trong box
            document.getElementById('qr-code').innerHTML = `<img src="${qrCodeUrl}" alt="Mã QR" />`;
            document.getElementById('qrbox').style.display = 'flex'; // Hiển thị box chứa mã QR
        });

        document.getElementById('btn-close-qr').addEventListener('click', function() {
            document.getElementById('qrbox').style.display = 'none'; // Ẩn box chứa mã QR
            document.getElementById('qr-code').innerHTML = ''; // Xóa mã QR để không hiển thị lại
        });
    });
</script>
@endsection

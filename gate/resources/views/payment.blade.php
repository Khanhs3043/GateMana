@extends('layouts.app')
@section('content')
<style>
    .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: #343a40;
    color: white;
}

.header .logo h3 {
    margin: 0;
    color: #fff;
}

.header img {
    height: 50px;
    margin-right: 15px;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info img {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-right: 10px;
    border: 2px solid white;
}

.user-info span {
    margin-right: 10px;
    font-weight: 600;
    font-size: 18px;
}

.container {
    margin-top: 30px;
}

.wrap2 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.btn-payment {
    margin-left: 15px;
}

.table thead {
    background-color: #f8f9fa;
}

.table thead th {
    text-align: center;
    font-weight: bold;
}

.table tbody td {
    text-align: center;
}
#qr-box{
    position: absolute;
    top: 50%;
    right: 50%;
    transform: translate(50%,-50%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px 40px;
    gap:20px;
    border-radius: 15px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.226);
    background-color: white;
}
#qr-code img{
    width: 300px;
    padding: 10px;
    border-radius: 15px;
    border: 2px solid rgba(69, 174, 146, 0.267);
}
#btn-close-qr{
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 30px;
    font-weight: bold;
    padding: 3px;
    color: rgb(191, 34, 34);
    line-height: 1;
}
#qrbox{
    position: fixed;
    top: 0px;
    right: 0px;
    left: 0px;
    bottom: 0px;
    background-color: rgba(0, 0, 0, 0.39)
}
.nav{
    display: flex;
    gap:20px;
    font-size: 20px;
    flex: 1;
    padding-left: 20px;
    margin-left: 20px;
    border-left: 2px solid rgba(255, 255, 255, 0.478);
}
.alert {
    position: absolute;
    top: 20px;
    right: 20px;
}
</style>
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

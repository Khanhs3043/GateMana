<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Cổng Ra Vào</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<div class="header">
    <div class="logo d-flex align-items-center">
        <img src="/embedded.png" alt="Logo">
        <h3>Quản Lý Ra Vào - RFID</h3>
    </div>
    <div class="user-info">
        <img src="{{Auth::user()->avatar}}" alt="Avatar">
        <span>{{ Auth::user()->name }}</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Đăng Xuất</button>
        </form>
    </div>
</div>

    <div class="container mt-4">
        @yield('content')
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

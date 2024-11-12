
@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Quản lý tài khoản </h1>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Danh sách tài khoản</h4>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-responsive-sm mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th>ID thẻ</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>

                        <td>{{ $user->card_id ??'-- chưa có thẻ --' }}</td>
                        <td class="text-center">
                            @if($user->card_id)
                            <form action="/unassignCard/{{$user->id}}" method="POST" style="display: inline;">
                                @csrf
                                @method('POST')
                                <button type="submit" class="btn btn-sm btn-outline-primary" onclick="return confirm('Bạn có chắc chắn muốn gỡ thẻ?')"> Gỡ thẻ </button>
                            </form>
                        
                            @endif
                            <form action="/deleteAccount/{{$user->id}}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

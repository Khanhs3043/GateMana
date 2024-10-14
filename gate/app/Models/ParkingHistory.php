<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingHistory extends Model
{
    use HasFactory;

    // Khai báo bảng tương ứng với model này
    protected $table = 'parking_histories';

    // Các thuộc tính có thể được ghi vào
    protected $fillable = [
        'uid',
        'card_id',
        'entry_time',
        'exit_time',
        'amount',
    ];

    // Định nghĩa quan hệ với model User
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}

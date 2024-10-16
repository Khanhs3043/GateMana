<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ParkingHistory;
use App\Models\UnknownCard;
use App\Notifications\ParkingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Lấy lịch sử ra vào của người dùng hiện tại
        $parkingHistories = ParkingHistory::where('uid', $user->id)->get();
    
        // Tính tổng số tiền từ lịch sử gửi xe
        $totalAmount = $parkingHistories->sum('amount');
    
        // Truyền dữ liệu lịch sử và tổng tiền vào view
        return view('home', [
            'parkingHistories' => $parkingHistories,
            'totalAmount' => $totalAmount
        ]);
    }

    public function handle($cardId)
    {
        $amount = 3000;
        $user = User::where('card_id', $cardId)->first();
    
        if ($user) {
            // Kiểm tra xem xe đang vào hay ra
            $history = ParkingHistory::where('uid', $user->id)
                                     ->whereNull('exit_time')
                                     ->first();
    
            if ($history) {
                // Nếu có entry mà chưa có exit, thì xe ra
                $history->exit_time = now();
                $history->amount = $amount;
                $history->save();

                $user->total = $user->total + $amount;  
                $user->save();
                // Gửi mail thông báo xe ra và tổng tiền
                $user->notify(new ParkingNotification($user, false, $history->amount));

                // Trả về JSON response cho sự kiện xe ra
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vehicle exited successfully',
                    'amount' => $history->amount,
                    'exit_time' => $history->exit_time->format('Y-m-d H:i:s')
                ], 200);
            } else {
                // Nếu không có entry chưa hoàn thành, thì xe vào
                ParkingHistory::create([
                    'uid' => $user->id,
                    'card_id' => $cardId,
                    'entry_time' => now(),
                ]);

                // Gửi mail thông báo xe vào
                $user->notify(new ParkingNotification($user, true));

                // Trả về JSON response cho sự kiện xe vào
                return response()->json([
                    'status' => 'success',
                    'message' => 'Vehicle entered successfully',
                    'entry_time' => now()->format('Y-m-d H:i:s')
                ], 200);
            }
        } else {
            // Trường hợp không tìm thấy user với cardId
            $unknownCard = UnknownCard::where('card_id', $cardId)->first();

            if (!$unknownCard) {
                // Nếu thẻ chưa tồn tại, thêm vào bảng unknown_cards
                UnknownCard::create(['card_id' => $cardId]);}
            return response()->json([
                'status' => 'error',
                'message' => 'Card ID not found'
            ], 404);
        }
    }

    public function showAssignCardForm()
    {
        $users = User::whereNull('card_id')->get();  // Lấy người dùng chưa có thẻ
        $unknownCards = UnknownCard::all();  // Lấy các thẻ chưa xác định
        return view('assign-card', compact('users', 'unknownCards'));
    }

    // Xử lý gán thẻ
    public function assignCard(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',  // Người dùng
            'card_id' => 'required|exists:unknown_cards,card_id'  // Thẻ lạ
        ]);

        $user = User::find($request->user_id);

        // Gán thẻ cho người dùng
        $user->card_id = $request->card_id;
        $user->save();

        // Xóa thẻ khỏi bảng unknown_cards sau khi gán thành công
        UnknownCard::where('card_id', $request->card_id)->delete();

        return redirect()->back()->with('success', 'Thẻ đã được gán thành công!');
    }
}

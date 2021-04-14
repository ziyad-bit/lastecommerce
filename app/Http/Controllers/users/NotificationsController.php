<?php

namespace App\Http\Controllers\users;

use App\Models\Comments;
use App\Traits\Notifications;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    use Notifications;
    
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified']);
    }
####################################      show          #################################
    public function show()
    {
        try {
            $user_id         = Auth::user()->id;
            $items_id        = $this->auth_items_id();
            $notifs_not_read = $this->notifications_not_read($user_id);

            $notifs_not_read_count  = $notifs_not_read->count();

            $all_notifications = Comments::with('users')->whereIn('item_id',$items_id)
                            ->where('user_id','!=',$user_id)->orderBy('id','desc')->get();
            
            return response()->json(compact('notifs_not_read_count','all_notifications'));

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        
    }

####################################      update          #################################
    public function update()
    {
        try {
            $notifications_not_read = $this->notifications_not_read(Auth::user()->id);
            $comments_ids           = $notifications_not_read->pluck('id')->toArray();

            Comments::whereIn('id', $comments_ids)
                ->update([
                    'notification' => 1,
                ]);

            return response()->json();

        } catch (\Exception $th) {
            return response()->json(['error'=>'something went wrong'],500);
        }
        

    }
}

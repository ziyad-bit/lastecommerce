<?php

namespace App\Http\Controllers\users;

use App\Models\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth , Redirect};
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web','verified']);
    }
####################################      create          #################################
    public function create(CommentRequest $request, int $id)
    {
        try {
            $comment  = filter_var($request->get('comment') , FILTER_SANITIZE_STRING);

            Comments::create([
                'comment'     => $comment,
                'user_id'     => Auth::user()->id,
                'item_id'     => $id
            ]);
    
            return  redirect()->back()->with(['success'=>'you added comment successfully']);

        } catch (\Exception $ex) {
            return redirect()->back()->with(['error'=>'Something went wrong']);
        }
    
    }

####################################      edit          #################################
    public function edit(int $id)
    {
        try {
            $comment=Comments::find($id);
            if(!$comment){
                return redirect()->back()->with(['error'=>'no comment found']);
            }

            return view('users.items.editComment',compact('comment'));

        } catch (\Exception $ex) {
            return Redirect::to('items/get')->with(['error'=>'Something went wrong']);
        }
        
    }

####################################      update          #################################
    public function update(CommentRequest $request,int $id)
    {
        try {
            $comments=Comments::find($id);
            if(! $comments){
                return redirect()->back()->with(['error'=>'no comment found']);
            }

            $comment  = filter_var($request->get('comment') , FILTER_SANITIZE_STRING);

            $comments->comment = $comment;
            $comments->save();
                
            return Redirect::to('comments/edit/'.$id)->with(['success'=>'you updated comment successfully']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error'=>'something went wrong']);
        }
        
    }

####################################      delete          #################################
    public function delete(int $id)
    {
        try {
            $comment=Comments::find($id);
            if(! $comment){
                return redirect()->back()->with(['error'=>'no comment found']);
            }
            $comment->delete();

            return redirect()->back()->with(['success'=>'you deleted comment successfully']);

        } catch (\Exception $th) {
            return Redirect::to('items/get')->with(['error'=>'Something went wrong']);
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\
    {Comment, Customer, User
    };
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //
    public function store($id, Request $request, User $user, Comment $comment, Customer $customer) {
        $request -> validate([
            'commentTitle' => ['required', 'string'],
            'commentBody' => ['required', 'string'],
        ]);

        $customer = Auth::user() ->customer;

        $comment = $customer->comments()->create([
            'title' => $request -> commentTitle,
            'body' => $request -> commentBody,
            'book_id' => $id,
        ]);

        return redirect()->route('produto.view', ['id' => $id]);
    }

    public function rmComment($id, $id_cm) {
        DB::delete('Delete from comments where id = ?', [$id_cm]);
        return redirect()->route('produto.view', ['id' =>$id]);
    }

    public function upComment($id, $id_cm, Request $request){
        $inputs = $request->except(['_token']);

        $comment = Comment::find($id_cm);
        if (!$comment) {
            // Comentário não encontrado
            return redirect()->back()->withErrors(['message' => 'Comentário não encontrado.']);
        }

        foreach($inputs as $key => $value){
            if($request->filled($key)){
                 $comment->$key = $value;
            }
        }

        $comment->save();

        return redirect()->route('produto.view', ['id' =>$id]);
    }

}

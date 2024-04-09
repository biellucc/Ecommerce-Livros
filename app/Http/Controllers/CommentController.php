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
    //cria comentário
    public function store($id, Request $request, User $user, Comment $comment, Customer $customer) {
        $request -> validate([
            'commentTitle' => ['required', 'string', 'max:50'],
            'commentBody' => ['required', 'string'],
        ]);

        $customer = Auth::user() ->customer;
        //dd($id);
        $comment = $customer->comments()->create([
            'title' => $request -> commentTitle,
            'body' => $request -> commentBody,
            'book_id' => $id,
        ]);

        return redirect()->route('site.view', ['id' => $id]);
    }

    //Deleta comentário
    public function rmComment($id, Request $request) {
        $id_comment = $request->input('comment_id');
        DB::delete('Delete from comments where id = ?', [$id_comment]);
        return redirect()->route('site.view', ['id' =>$id]);
    }

    //Atualiza comentário
    public function upComment($id_livro, Request $request){
        $inputs = $request->except(['_token', 'comment_id']);

        $request->validate([
            'title' => 'nullable|string|max:50',
            'body' => 'nullable|string'
        ]);

        $comment_id = $request->input('comment_id');

        $comment = Comment::find($comment_id);
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

        return redirect()->route('site.view', ['id' =>$id_livro]);
    }

}

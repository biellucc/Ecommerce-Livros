<?php

namespace App\Traits;

use App\Models\Book;
use Illuminate\Support\Facades\DB;

trait SharedLogicTrait
{
    public function alterar_qntd_books(Book $book, $tipo){
        if ($tipo == 1) {
            //Se tipo for 1, ent devo remover em 1 a quantidade do books
            //pois um livro foi adicionado ao carrinho
            $affectedRows = DB::update(
                'update books set amount = amount - 1 where id = ?', [$book->id]
            );
            return $affectedRows;
        }else if ($tipo == 2){
            //Se tipo for 2, ent devo adicionar em 1 a quantidade do books
            //pois um livro foi removido do carrinho
            $affectedRows = DB::update(
                'update books set amount = amount + 1 where id = ?', [$book->id]
            );
            return $affectedRows;
        }
        return 0;
    }
}

?>

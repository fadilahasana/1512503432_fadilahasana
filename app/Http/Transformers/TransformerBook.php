<?php

namespace App\Http\Transformers;
use League\Fractal\TransformerAbstract;
use App\Http\Models\Book;

class TranformerBook extends TransformerAbstract
{
    public function transform(Book $field)
    {
       

        //mengubah format Tampilan di Postman
        return[
            'ID Buku' => $field->id,
            'ID Kategori' => $field->category_id,
            'Judul Buku' => $field->title,
            'Pengarang' => $field->author,
            'Penerbit' =>   $field->publish,
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Models\Book;
use App\Http\Models\Category;
use App\Http\Transformers\TranformerBook;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Mockery\Exception;

class BookController extends Controller
{
    use Helpers;

    public function index () {
        $orm = Book::all();

        return $this->response->collection($orm, new TranformerBook);
    }
    public function show ($id) {
        try {

            $orm = Book::find($id);

        } catch ( Exception $e ) {
            return $e;
        }
        if ( $orm ) {
            return $this->response->item($orm, new TranformerBook);
        }

        return $this->response->errorNotFound('Data Tidak Ketemu');
    }

    public function destroy ($id) {
        $orm = Book::find($id);
        if ( $orm ) {
            try {
                $orm->delete();
            } catch ( Exception $e ) {
                return $e;
            }

            return response('Data Berhasil Dihapus');
        }

        return $this->response->errorNotFound('Data tidak ketemu');
    }

    public function store (Request $request) {

        //        $book = Book::where('categories_id','=',Category::find($id));

        $data = $request->only([
            'judul',
            'kategori',
            'author',
            'isbn',
            'penerbit'
        ]);

        $idcat = Category::find($data['kategori']);

        if($idcat)
        {
            $insert = new Book([
                'title' => $data['judul'],
                'category_id' => $data['kategori'],
                'author' => $data['pengarang'],
                'isbn' => $data['isbn'],
                'publish' => $data['penerbit']
            ]);

            try {
                $insert->save();
            } catch ( Exception $e ) {
                $this->response->error($e, 500);
            }

            $this->response->created();

            return response('Berhasil Tambah Data Buku');
        }else {
            $this->response->errorNotFound('data kategori tidak ditemukan');
        }
    }

    public function update($id,Request $request)
    {
        try{
            $update = Book::find($id);
        }catch(Exception $e){
            $this->response->error($e,500);
        }
        if($update){
            $data = $request->only([
                'judul',
                'kategori',
                'author',
                'isbn',
                'penerbit'
            ]);

            $idcat = Category::find($data['kategori']);

            if($idcat)
            {
                $update->fill([
                    'title' => $data['judul'],
                    'category_id' => $data['kategori'],
                    'author' => $data['pengarang'],
                    'isbn' => $data['isbn'],
                    'publish' => $data['penerbit']  
                    ]);
                try{
                    $update->update();
                }catch (Exception $e){
                    $this->response->error($e,500);
                }
                return response('Data Berhasil di Update');
            }else{
                return response('Data kategori tidak ditemukan');
            }

        }else{
            $this->response->errorNotFound('data tidak berhasil di Update');
        }
    }
}
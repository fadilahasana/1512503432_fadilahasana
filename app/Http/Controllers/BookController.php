<?php
namespace App\Http\Controllers;

use App\Http\Models\Book;
use App\Http\Models\Category;
use App\Http\Transformers\TransformerBook;
use Dingo\Api\Http\Request;
use Dingo\Api\Routing\Helpers;
use Mockery\Exception;

class BookController extends Controller
{
    use Helpers;

    public function index () {
        $orm = Book::all();

        return $this->response->collection($orm, new TransformerBook);
    }
    public function show ($id) {
        try {

            $orm = Book::find($id);

        } catch ( Exception $e ) {
            return $e;
        }
        if ( $orm ) {
            return $this->response->item($orm, new BookTransformer);
        }

        return $this->response->errorNotFound('Data Tcategory_idak Ketemu');
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

        return $this->response->errorNotFound('Data tcategory_idak ketemu');
    }

    public function store (Request $request) {


        $data = $request->only([
                'id',
                'title',
                'isbn',
                'author',
                'publish'
        ]);

        $idcat = Category::find($data['id']);

        if($idcat)
        {
            $insert = new Book([
               'category_id' => $data['id'],
                    'title' => $data['title'],
                    'isbn' => $data['isbn'],
                    'author' => $data['author'],
                    'publish' => $data['publish'],
            ]);

            try {
                $insert->save();
            } catch ( Exception $e ) {
                $this->response->error($e, 500);
            }

            $this->response->created();

            return response('Berhasil Tambah Data Buku');
        }else {
            $this->response->errorNotFound('data kategori tcategory_idak ditemukan');
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
                'id',
                'title',
                'isbn',
                'author',
                'publish'
            ]);

            $idcat = Category::find($data['id']);

            if($idcat)
            {
                $update->fill([
                    'category_id' => $data['id'],
                    'title' => $data['title'],
                    'isbn' => $data['isbn'],
                    'author' => $data['author'],
                    'publish' => $data['publish'],
                    ]);
                try{
                    $update->save();
                }catch (Exception $e){
                    $this->response->error($e,500);
                }
                return response('Data Berhasil di Update');
            }else{
                return response('Data kategori tcategory_idak ditemukan');
            }

        }else{
            $this->response->errorNotFound('data tcategory_idak berhasil di Update');
        }
    }
}
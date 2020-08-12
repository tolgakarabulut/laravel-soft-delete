<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreRequest};
use App\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * Silinenler dahil tüm yazıları getirir.
     * @return JsonResponse
     */
    public function all()
    {
        /**
         * withTrashed ile sorguya silinen yazılarıda eklemiş olduk.
         */
        $blogs = Blog::withTrashed()->get();
        return response()->json($blogs,200);
    }
    /**
     * @return JsonResponse
     * Silinenler hariç tüm blog yazılarını getirir.
     */
    public function list()
    {
        return response()->json( Blog::all() , 200);
    }

    /**
     * @param StoreRequest $request
     * Yeni bir blog yazısı kayıt eder.
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $store = [
            'title' => $request->post('title'),
            'content' => $request->post('content'),
            'author' => $request->post('author') ?? "Anonymous",
        ];
        $result = Blog::create( $store );
        return response()->json($result,200);
    }

    /**
     * Bir blog yazısını siler.
     * @param Int $id
     * @return JsonResponse
     */
    public function delete(Int $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return response()->json(['deleted_at' => $blog->deleted_at],200);
    }

    /**
     * Silinen bir blog yazısını geri getirir.
     * @param Int $id
     * @return JsonResponse
     */
    public function restore(Int $id)
    {
        /**
         * Sadece silinenler arasından içeriği bul.
         */
        $blog = Blog::onlyTrashed()->findOrFail($id);
        $blog->restore();
        return response()->json($blog,200);
    }

    /**
     * Sadece silinen blog yazılarını getirir.
     */
    public function onlyTrashed()
    {
        /**
         * Burada ekstra olarak onlyTrashed çağırıyoruz.
         */
        $blog = Blog::onlyTrashed()->get();
        return response()->json($blog,200);
    }
}

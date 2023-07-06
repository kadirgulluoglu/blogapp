<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategories;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        return response()->json($blog);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = $request->categoryids;
            $category = explode(",", $category);
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $blog = Blog::create($data);
            if ($blog) {
                foreach ($category as $c) {
                    BlogCategories::create([
                        'blog_id' => $blog->id,
                        'category_id' => $c
                    ]);
                }
            }
            DB::commit();
            response()->json(['message' => 'Kayıt başarıyla oluşturuldu'], 201);
        } catch (\Exception $e) {
            DB::rollback();
            response()->json(['message' => 'Kayıt oluşturulurken bir hata oluştu. Hata: ' .$e], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::find($id);
        return response()->json($blog);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $category = $request->categoryids;
            $category = explode(",", $category);
            $data = $request->all();
            $data['user_id'] = Auth::id();
            $blog = Blog::find($id);
            $blog->update($data);
            if ($blog) {
                BlogCategories::where('blog_id', $id)->delete();
                foreach ($category as $c) {
                    BlogCategories::create([
                        'blog_id' => $blog->id,
                        'category_id' => $c
                    ]);
                }
            }
            DB::commit();
           return response()->json(['message' => 'Kayıt başarıyla güncellendi'], 201);
        } catch (\Exception $e) {
            DB::rollback();
           return response()->json(['message' => 'Kayıt güncellenirken bir hata oluştu. Hata: ' .$e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

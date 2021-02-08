<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];

        return view('admin.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image|max:512'
        ]);

        $data = $request->all();
        $new_post = new Post();

        if(array_key_exists('image', $data)) {
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path;
        }

        $new_post->fill($data);
        $slug = Str::slug($new_post->title);
        $slug_base = $slug;
        $counter = 1;
        $post_current = Post::where('slug', $slug)->first();
        while($post_current) {
            $slug = $slug_base .'-' .$counter;
            $counter++;
            $post_current = Post::where('slug', $slug)->first();
        }
        $new_post->slug = $slug;
        $new_post->save();
        if(array_key_exists('tags', $data)) {
            $new_post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if(!$post) {
            abort(404);
        }

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post) {
            abort(404);
        }

        $data = [
            'post' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all()
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'exists:tags,id',
            'image' => 'nullable|image|max:512'
        ]);

        $data = $request->all();
        // controllo che il titolo ricevuto dal form sia diverso dal vecchio titolo
        if($data['title'] != $post->title) {
            $slug = Str::slug($new_post->title);
            $slug_base = $slug;
            $counter = 1;
            $post_current = Post::where('slug', $slug)->first();
            while($post_current) {
                $slug = $slug_base .'-' .$counter;
                $counter++;
                $post_current = Post::where('slug', $slug)->first();
            }
            $new_post->slug = $slug;
        }

        if(array_key_exists('image', $data)) {
            // salvo l'immagine e recupero la path
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path;
        }

        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}

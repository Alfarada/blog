<?php

namespace App\Http\Controllers\Admin;

use App\{Post, Category, Tag};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\{PostUpdateRequest, PostStoreRequest};

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')
            ->where('user_id', auth()->user()->id)
            ->paginate();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('admin.posts.create', ['categories' => $categories, 'tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $post = Post::create($request->all());

        // IMAGE
        if ($request->file('file')) {
            $path = Storage::disk('public')->put('image', $request->file('file'));
            $post->fill(['file' => asset($path)])->save();
        }

        // TAGS
        $post->tags()->attach($request->get('tags'));

        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Entrada creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        $this->authorize('pass',$post);

        return  view('admin.posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $post = Post::find($id);

        $this->authorize('pass',$post);

        $categories = Category::orderBy('name', 'ASC')
            ->pluck('name', 'id');

        $tags = Tag::orderBy('name', 'ASC')->get();

        return  view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        $this->authorize('pass',$post);
        $post->fill($request->all())->save();

        // IMAGE
        if ($request->file('file')) {
            $path = Storage::disk('public')->put('image', $request->file('file'));
            $post->fill(['file' => asset($path)])->save();
        }

        // TAGS
        $post->tags()->sync($request->get('tags'));

        return redirect()->route('posts.edit', $post->id)
            ->with('info', 'Entrada Actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('pass',$post);
        $post->delete();
        return back()->with('info', 'Eliminado correctamente');
    }
}

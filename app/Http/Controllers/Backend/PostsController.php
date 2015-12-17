<?php

namespace blogCms\Http\Controllers\Backend;

use blogCms\Http\Requests;
use blogCms\Http\Requests\Post\StorePostRequest;
use blogCms\Http\Requests\Post\UpdatePostRequest;
use blogCms\Post;

/**
 * Class PostsController
 * @package blogCms\Http\Controllers\Backend
 */
class PostsController extends Controller
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * PostsController constructor.
     * @param Post $post
     */
    function __construct(Post $post)
    {
        $this->post = $post;

        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->post->with('author')->latest('published_at')->paginate(10);

        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('backend.posts.form', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $this->post->create(['author_id' => auth()->user()->id]  + $request->only('title', 'slug', 'published_at', 'excerpt', 'body'));

        return redirect(route('backend.posts.index'))->withStatus('Post has been created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        return view('backend.posts.form', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest|\Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = $this->post->findOrFail($id);

        $post->fill($request->only('title', 'slug', 'published_at', 'excerpt', 'body'));

        $post->save();

        return redirect(route('backend.posts.edit', $id))->withStatus('Post has been updated');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm($id)
    {
        $post = $this->post->findOrFail($id);

        return view('backend.posts.confirm', compact('post'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->post->findOrFail($id);

        $post->delete();

        return redirect(route('backend.posts.index'))->withStatus('Post has been deleted');
    }
}

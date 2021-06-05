<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;

define('POSTS_STORAGE_PATH', 'public/posts');

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.new-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $postId = $this->savePost($request);

        if ($request->has('images')) {
            $this->saveAllImages($request, $postId);
        }

        return redirect()->route('profile', ['username' => Auth::user()->profile->username]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->fetchPost($id);
        $images = $post->images->pluck('url');
        $comments = $this->fetchComments($post);

        return view('post.show', compact('post', 'images', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function storeComment(Request $request, $id)
    {
        $post = $this->fetchPost($id);
        $parameters = $this->getPostCommentParameters($request);

        $post->comments()->create($parameters);

        return redirect()->route('post.show', ['post' => $post->id]);
    }

    public function storeLike($id)
    {
        if ($this->postLiked($id)) {
            $this->like($id);
        } else {
            $this->unlike($id);
        }

        return redirect()->route('post.show', ['post' => $id]);
    }

    private function getRequestBody(CreatePostRequest $request)
    {
        return $request->only('title', 'body');
    }

    public function createImageStoragePath(int $postId)
    {
        $path = POSTS_STORAGE_PATH . '/' . Auth::user()->id . '/' . $postId;
        return $path;
    }

    public function uploadImage(UploadedFile $image, int $postId)
    {
        $directory = $this->createImageStoragePath($postId);
        $filename = $image->getClientOriginalName();

        $image->storeAs($directory, $filename);

        return $filename;
    }

    public function saveImage(UploadedFile $image, int $postId)
    {
        $filename = $this->uploadImage($image, $postId);

        $post = Auth::user()->posts()->find($postId);
        $post->images()->create(['url' => $filename]);
    }

    private function saveAllImages(CreatePostRequest $request, int $postId)
    {
        foreach ($request->file('images') as $image) {
            $this->saveImage($image, $postId);
        }
    }

    private function savePost(CreatePostRequest $request)
    {
        $parameters = $this->getRequestBody($request);
        $post = Auth::user()->posts()->create($parameters);
        $postId = $post->id;
        return $postId;
    }

    public function fetchPost($id)
    {
        return Post::find($id);
    }

    public function fetchComments(Post $post)
    {
        return $post->comments;
    }

    public function getPostCommentParameters(Request $request)
    {
        return [
            'body' => $request->input('body'),
            'user_id' => Auth::user()->id,
        ];
    }

    private function postLiked(int $id)
    {
        $like = $this->getLike($id)->where('likeable_id', $id)->count();
        return $like < 1;
    }

    private function getLike(int $id)
    {
        $adminUserId = Auth::user()->id;

        return Post::find($id)->likes()->where('user_id', $adminUserId);
    }

    private function like(int $id)
    {
        $adminUserId = Auth::user()->id;

        return $this->getLike($id)->create(['user_id' => $adminUserId]);
    }

    private function unlike(int $id)
    {
        return $this->getLike($id)->delete();
    }
}

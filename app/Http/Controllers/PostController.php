<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    public function index()
    {
        $post = $this->postRepository->index();
        return $post;
    }
 
    public function show($id)
    {
        $post = $this->postRepository->show($id);
         return $post;
    }
 
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);
 
        $postStore = $this->postRepository->store($request);
        return $postStore;
    }
 
    public function update(Request $request, $id)
    {
        $post = $this->postRepository->update($request, $id);
        return $post;
    }
 
    public function destroy($id)
    {
        $post = $this->postRepository->destroy($id);
        return $post;
 
    }
}

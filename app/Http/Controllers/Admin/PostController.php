<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Admin\CreatePostRequest;
use App\Http\Requests\Admin\UpdatePostRequest;
use App\Repositories\PostRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class PostController extends AppBaseController
{
    /** @var  PostRepository */
    private $postRepository;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepository = $postRepo;
    }

    /**
     * Display a listing of the Post.
     *
     * @param  Request  $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $data['pageTitle'] = 'Post';
        $data['menu'] = 'posts';
        $data['posts'] = $this->postRepository->paginate(10);

        return view('admin.posts.index')
            ->with($data);
    }

    /**
     * Show the form for creating a new Post.
     *
     * @return Response
     */
    public function create()
    {
        $data['pageTitle'] = 'Add '.'Post';
        $data['menu'] = 'posts';

        return view('admin.posts.create')->with($data);
    }

    /**
     * Store a newly created Post in storage.
     *
     * @param  CreatePostRequest  $request
     *
     * @return Response
     */
    public function store(CreatePostRequest $request)
    {
        $input = $request->all();

        $post = $this->postRepository->create($input);

        Flash::success('Post saved successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified Post.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $data['pageTitle'] = 'Post';
        $data['menu'] = 'posts';
        $data['post'] = $this->postRepository->find($id);

        if (empty($data['post'])) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('admin.posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified Post.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $data['pageTitle'] = 'Edit '.'Post';
        $data['menu'] = 'posts';
        $data['post'] = $this->postRepository->find($id);

        if (empty($data['post'])) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        return view('admin.posts.edit')->with($data);
    }

    /**
     * Update the specified Post in storage.
     *
     * @param  int  $id
     * @param  UpdatePostRequest  $request
     *
     * @return Response
     */
    public function update($id, UpdatePostRequest $request)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $post = $this->postRepository->update($request->all(), $id);

        Flash::success('Post updated successfully.');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified Post from storage.
     *
     * @param  int  $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $post = $this->postRepository->find($id);

        if (empty($post)) {
            Flash::error('Post not found');

            return redirect(route('posts.index'));
        }

        $this->postRepository->delete($id);

        Flash::success('Post deleted successfully.');

        return redirect(route('posts.index'));
    }
}

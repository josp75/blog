<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('blog.index', [
            'posts' => Post::with('category', 'tags')->paginate(5)
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $post = new Post();
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select(['id', 'name'])->get(),
            'tags' => Tag::select(['id', 'name'])->get()
        ]);
    }

    /**
     * @param string $slug
     * @param Post $post
     * @return RedirectResponse|Post
     */
    public function show(string $slug, Post $post): RedirectResponse|View
    {
        if ($post->slug !== $slug) {
            return to_route('blog.show', ['slug' => $post->slug, 'post' => $post->id]);
        }
        return view('blog.show', ['post' => $post]);
    }

    /**
     * @param Post $post
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select(['id', 'name'])->get(),
            'tags' => Tag::select(['id', 'name'])->get()
        ]);
    }

    /**
     * @param Post $post
     * @param FormPostRequest $request
     * @return RedirectResponse
     */
    public function update(Post $post, FormPostRequest $request): RedirectResponse
    {
        $data = $this->extractData($post, $request);
        $post->update($data);
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été modifié");

    }
    /**
     * @param FormPostRequest $request
     * @return RedirectResponse
     */
    public function store(FormPostRequest $request): RedirectResponse
    {
        $data = $this->extractData(new Post(), $request);
        $post->update($data);
        $post->tags()->sync($request->validated('tags'));
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])->with('success', "L'article a bien été sauvegardé");
    }


    private function extractData(Post $post, FormPostRequest $request){
        $data = $request->validated();
        /**
         * @var UploadedFile|null $image
         */
        $image = $request->validated('image');
        if($image === null || $image->getError()) {
            return $data;
        }
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $data['image'] = $image->store('blog', 'public');
        return $data;
    }


}

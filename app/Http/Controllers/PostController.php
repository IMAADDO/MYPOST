<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
{
    $posts = Post::latest()->paginate(10);
    return view('posts.index', compact('posts'));
}
    public function show(Post $post)
{
    
    return view('posts.show', compact('post'));
}

    public function create()
    {
        return view('posts.create');
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // الصورة اختيارية، بحجم أقصى 2MB
    ]);

    $post = new Post();
    $post->user_id = auth()->id();
    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->body = $validated['body'];

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public'); // تخزين الصورة فـ storage/app/public/posts
        $post->image = $imagePath;
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully!');
}

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post->title = $validated['title'];
    $post->content = $validated['content'];
    $post->body = $validated['body'];

    if ($request->hasFile('image')) {
        // حذف الصورة القديمة لو كانت موجودة
        if ($post->image) {
            \Storage::disk('public')->delete($post->image);
        }
        $imagePath = $request->file('image')->store('posts', 'public');
        $post->image = $imagePath;
    }

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
}

   public function destroy(Post $post)
{
    if (auth()->check() && (auth()->user()->is_admin || auth()->id() === $post->user_id)) {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }
    return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post!');
}
}

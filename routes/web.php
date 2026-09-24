<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Post;
use App\Models\TilPost;

Route::get('/', function () {
    return view('pages.home', [
        'projects' => Project::featured()->get(),
    ]);
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/projects', function () {
    return view('pages.projects.index', [
        'projects' => Project::orderBy('sort_order')->get(),
    ]);
});

Route::get('/projects/{slug}', function ($slug) {
    $project = Project::where('slug', $slug)->firstOrFail();
    return view('pages.projects.show', compact('project'));
});

Route::get('/blog', function () {
    return view('pages.blog.index', [
        'posts' => Post::published()->latest('published_at')->get(),
    ]);
});

Route::get('/blog/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->whereNotNull('published_at')->firstOrFail();
    return view('pages.blog.show', compact('post'));
});

Route::get('/til', function () {
    return view('pages.til', [
        'posts' => TilPost::published()->latest('published_at')->get(),
    ]);
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::post('/contact', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string|max:5000',
    ]);

    // TODO: send mail
    return back()->with('success', 'Thanks! I\'ll get back to you soon.');
});

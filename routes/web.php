<?php

use App\Http\Controllers\ContactController;
use App\Models\Agency;
use App\Models\Post;
use App\Models\Project;
use App\Models\SkillCategory;
use App\Models\TilPost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $agencies = Agency::orderBy('sort_order')->get();
    return view('pages.home', [
        'agencies'      => $agencies,
        'platforms'     => Project::published()->with('agency')->orderBy('sort_order')->get(),
        'skills'        => SkillCategory::orderBy('sort_order')->get(),
        'journey'       => $agencies,
        'featured_post' => Post::published()->where('featured', true)->latest('published_at')->first(),
        'til_posts'     => TilPost::published()->latest('published_at')->take(3)->get(),
    ]);
});

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/projects', function () {
    return view('pages.projects.index', [
        'projects' => Project::published()->with('agency')->orderBy('sort_order')->get(),
    ]);
});

Route::get('/projects/{slug}', function ($slug) {
    $project = Project::where('slug', $slug)
        ->where('published', true)
        ->with('agency')
        ->firstOrFail();
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

Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:6,1');

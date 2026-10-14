<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url><loc>{{ url('/') }}</loc><changefreq>weekly</changefreq><priority>1.0</priority></url>
    <url><loc>{{ url('/about') }}</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/projects') }}</loc><changefreq>monthly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/blog') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ url('/til') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>
    <url><loc>{{ url('/contact') }}</loc><changefreq>yearly</changefreq><priority>0.5</priority></url>

    @foreach($projects as $project)
    <url><loc>{{ url('/projects/' . $project->slug) }}</loc><changefreq>monthly</changefreq><priority>0.7</priority></url>
    @endforeach

    @foreach($posts as $post)
    <url>
        <loc>{{ url('/blog/' . $post->slug) }}</loc>
        <lastmod>{{ $post->published_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    @if($tilPosts->count())
    <url>
        <loc>{{ url('/til') }}</loc>
        <lastmod>{{ $tilPosts->first()->published_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    @endif
</urlset>

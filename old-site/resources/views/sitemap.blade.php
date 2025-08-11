<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{url('/')}}</loc>
        <lastmod>2021-06-28T08:11:21Z</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{url('/blogs')}}</loc>
        <lastmod>2021-06-28T08:11:21Z</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
    @foreach ($blogs as $blog)
    <url>
        <loc>{{url('/blog/'. $blog->slug)}}</loc>
        <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($blog->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.6</priority>
    </url>
@endforeach
    @foreach ($projects as $project)
        <url>
            <loc>{{url('/project/'. $project->slug)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($project->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
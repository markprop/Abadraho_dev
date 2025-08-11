@extends('layouts.master')
@section('content')
    <!-- Main Blog Post Content -->
    <section class="blog_post_container bgc-f7">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content style2">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>

                            <li class="breadcrumb-item active text-thm" aria-current="page">Blogs</li>
                        </ol>
                        <h2 class="breadcrumb_title">Blogs</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main_blog_post_content">
                        <div class="row">
                            @foreach ($blogs as $blog)
                                <div class="col-lg-4">
                                    <div class="for_blog feat_property">
                                        <div class="thumb">
                                            <a href="/{{ optional($blog->category)->slug }}/{{ $blog->slug }}" class="w-100">
                                                <img class="img-whp" src="/uploads/blogs/{{ $blog->cover_img }}"
                                                    alt="{{ $blog->title }}">
                                            </a>
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                            <p class="text-thm">{{ optional($blog->category)->title }}</p>

                                            <h4><a href="/blog/{{ $blog->slug }}"
                                                class="w-100 blog-title-heading">{{ $blog->title }}</a></h4>

                                            <ul class="utf-blog-item-post-list">
                                                <li>By, Mark Admin</li>  
                                                <li>20 Jan, 2022</li>
                                            </ul>

                                            <br>

                                            {!! Str::limit($blog->description, 90) !!}
                                        </div>
                                            <!-- <div class="fp_footer">
                                                <ul class="fp_meta float-left mb0">
                                                    <li class="list-inline-item d-none"><a href="#"><img
                                                                src="assets/images/property/pposter1.png"
                                                                alt="pposter1.png"></a></li>
                                                    <li class="list-inline-item d-none"><a href="#">Ali Tufan</a></li>
                                                    <li class="list-inline-item">
                                                        <a href="#"><span class="flaticon-calendar pr10"></span>
                                                            {{ $blog->updated_at->format('l jS \\of F Y h:i:s A') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                                <a class="fp_pdate float-right text-thm"
                                                    href="/blog/{{ $blog->slug }}">Read
                                                    More <span class="flaticon-next"></span></a>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

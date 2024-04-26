@php use Illuminate\Support\Str; @endphp
@extends('front.layout.appPost')
    @section('content')
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text fw-bolder fs-5" href="#">Home</a></li>
                        <li class="breadcrumb-item active fw-bolder fs-5">Post</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-6 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <div class="sub-title">
                            <h2>Categories</h2>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionExample">

                                    <div class="accordion-body">
                                        <div class="navbar-nav">
                                            @foreach($categories as $category)
                                                <a href="{{ route('postCategoryPage',["categoryId"=>$category->id]) }}" class="nav-item nav-link">{{ $category->name }}</a>
                                            @endforeach
                                            <a href="{{ route('showPost') }}" class="nav-item nav-link">All</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::check())
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush">
                                    <div class="accordion-body">
                                        <div class="navbar-nav">
                                            <a href="{{route('user.addPost')}}">Create Post</a>
                                            <a href="{{route('user.postList')}}">Uploaded Post</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-md-9">

                                    @if($posts-> isNotEmpty())
                                        @foreach($posts as $post)
                                            <div class="col">
                                                <div class="row-md-5 mb-4">
                                                    <div class="card card-body flex-fill">
                                                        @foreach($categories as $category)
                                                            @if($post->category_id == $category->id)
                                                                <div class="card-header"><center>{{$category->name}}</center></div>
                                                            @endif
                                                        @endforeach
                                                        <div class="card-content">
                                                            <img src="{{ asset($post->thumbImage) }}" class="card-img-top" alt="Product 1 Image">
                                                            @foreach($authors as $author)
                                                                @if($author->id == $post->author_id)
                                                                    <p class="text-warning mt-3"><i class="fa fa-clock">
                                                                        </i> Post by {{$author->name}} - {{date('M, j Y', strtotime($post->updated_at)) }}.
                                                                    </p>
                                                                @endif
                                                            @endforeach
                                                            <h5 class="card-text"> ●{{$post->name}}</h5>
                                                            <p class="card-title">{!! $post->description !!}</p>
                                                        </div>
                                                            <a class="btn btn-dark" href="{{ route('detailPost',$post->id) }}">
                                                                <i class="fa fa-info-circle"></i> Details
                                                            </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                    @endif
                                <div class="col-md-12 pt-5">
                                    {{ $posts->withQueryString()->links() }}
                                </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @section('customJs')
        <script>
        </script>
    @endsection

{{--    <section class="container">--}}
{{--        <div class="row mt-5">--}}
{{--            --}}
{{--        </div>--}}
{{--        <div class="card-footer clearfix">--}}
{{--            {{ $posts -> links() }}--}}
{{--        </div>--}}
{{--    </section>--}}

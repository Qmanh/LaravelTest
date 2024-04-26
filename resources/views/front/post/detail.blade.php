@extends('front.layout.appPost')

@section('content')
<div class="container mt-3 d-flex align-items-center justify-content-center bg-light">
    <div class="col">
        <div class="row-md-6 ">
            <img width="600" src="{{ asset($post->thumbImage) }}" class="img-fluid mt-5" alt="Product Image">
        </div>
        <div class="row-md-6 mt-3 ">
            <h1 class="text-info">{{$post->name}}</h1>
            <h5 class="text-warning mt-3"><i class="fa fa-clock"></i> Post by {{$author->name}} - {{date('M, j Y', strtotime($post->updated_at)) }}.</h5>
            <h5><span class="badge bg-info text-dark">{{$category->name}}</span></h5>
            <p>{!! $post->description  !!}</p>
            <p> {!! $post->content !!}</p>
            <a href="{{ route('showPost') }}" class="btn btn-primary" style="float: right;">Back Home</a>
        </div>
    </div>

</div>


@endsection

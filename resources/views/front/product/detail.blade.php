@extends('front.layout.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('homePage') }}">Home</a></li>
                    <li class="breadcrumb-item">{{ $product-> name }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            <div class="carousel-item active">
                                <img class="w-60 h-50" src="{{ asset($product->thumbImage) }}" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{ $product-> name }}</h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        <div class="d-flex mb-3">
                            <h2 class="price text-secondary ">Price: ${{ $product->price }}</h2>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="bg-light">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Content</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="category-tab" data-bs-toggle="tab" data-bs-target="#category" type="button" role="tab" aria-controls="category" aria-selected="false">Category</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        {!! $product->content !!}
                                    </div>
                                    <div class="tab-pane fade" id="category" role="tabpanel" aria-labelledby="category-tab">
                                        {!! $category->name !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                      <div class="mt-3">
                          <a class="btn btn-dark" href="{{route('homePage')}}">
                              <i class="fa fa-home"></i> &nbsp; Back Home
                          </a>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection


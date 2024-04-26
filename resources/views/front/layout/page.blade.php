@extends('front.layout.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                @if($categories->isNotEmpty())
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
                                                <a href="{{ route('productPage',["categoryId"=>$category->id]) }}" class="nav-item nav-link">{{ $category->name }}</a>
                                            @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="col-md-2 sidebar"></div>
                @endif
                <div class="col-md-9">
                    <div class="row pb-3">
                        @if($products->isNotEmpty())
                            @foreach($products as $product)
                                <div class="col-md-4">
                                    <div class="card product-card">
                                        <div class="product-image position-relative">
                                            <a href="#" class="product-img">
                                                @if(!empty($product->thumbImage))
                                                    <img  src="{{ asset($product->thumbImage) }}" class="card-img-top img-thumbnail" >
                                                @else
                                                    <img  src="{{ asset('admin-assets/img/default-150x150.png') }}" class="card-img-top img-thumbnail">
                                                @endif
                                            </a>

                                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>

                                            <div class="product-action">

                                                <a class="btn btn-dark" href="{{ route('detailProduct',$product->id) }}">
                                                    <i class="fa fa-info-circle"></i> Details
                                                </a>

                                            </div>
                                        </div>
                                        <div class="card-body text-center mt-3">
                                            <a class="h6 link" href="{{ route('detailProduct',$product->id) }}">{{$product->name}}</a>
                                            <div class="price mt-2">
                                                <span class="h6 text-underline">${{ $product->price }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="col-md-12 pt-5">
                            {{ $products->withQueryString()->links() }}
                        </div>
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

@extends('layouts.appfront')

@section('content')
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
            <h1 class="mb-5">Courses Categories</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">

                    @if ($categories)
                        @foreach ($categories as $category)
                            <div class="col-lg-6 col-md-12 wow zoomIn my-1" data-wow-delay="0.3s">
                                <a class="position-relative d-block overflow-hidden category-link" href="{{ route('Front.Category.show' , $category) }}">
                                    <div class="overlay"></div>
                                    <div class=" text-center position-absolute py-2 px-3 z-50 category-info">
                                        <h5 class="m-0 text-white">{{ $category->name }}</h5>
                                        <small class="text-primary"> Courses</small>
                                    </div>
                                    <img class="img-fluid z-10" src="{{ asset($category->image) }}" alt="" >
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

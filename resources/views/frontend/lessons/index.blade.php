@extends('layouts.appfront')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8"
        style="background-image: url('{{ asset('jambasangsang/frontend/images/page-banner-2.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>@lang('Our Lessons ') in {{ $course->name }} Course
                            {{ request()->segment(1) == 'Category' ? '- ' . Str::replace('-', ' ', Str::ucfirst(request()->segment(2))) : '' }}
                        </h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">@lang('Home')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('Courses')</li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('Lessons')</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->

    <!--====== COURSES PART START ======-->

    <section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        <ul class="nav float-left" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="courses-grid-tab" data-toggle="tab" href="#courses-grid"
                                    role="tab" aria-controls="courses-grid" aria-selected="true"><i
                                        class="fa fa-th-large"></i></a>
                            </li>
                            <li class="nav-item">
                                <a id="courses-list-tab" data-toggle="tab" href="#courses-list" role="tab"
                                    aria-controls="courses-list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                            </li>
                            <li class="nav-item">Showning 4 0f 24 Results</li>
                        </ul> <!-- nav -->

                        <div class="courses-search float-right">
                            <form action="#">
                                <input type="text" placeholder="Search">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div> <!-- courses search -->
                    </div> <!-- courses top search -->
                </div>
            </div> <!-- row -->
            <div class="row ">
                <div class="py-5 ">
                    <div class="container ">
                        <div class="row d-flex flex-row g-4 justify-content-center">
                            @if ($lessons)
                                @foreach ($lessons as $lesson)
                                    <div class="col-lg-4 col-md-6 wow fadeInUp p-3" data-wow-delay="0.1s">
                                        <div class="course-item bg-light">
                                            <div class="position-relative mb-4">
                                                @if ($lesson->image)
                                                    <img class="img-fluid z-10" src="{{ asset($lesson->image) }}"
                                                        alt="{{ $lesson->title }}" />
                                                @endif
                                                <div
                                                    class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4 py-2 z-50">
                                                    <a href="{{ route('Courses.lessons.index', $lesson->id) }}"
                                                        class="flex-shrink-0 btn btn-sm btn-primary px-3 ">Read More</a>
                                                    {{-- <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                                style="border-radius: 0 30px 30px 0;">Join Now</a> --}}
                                                </div>
                                            </div>
                                            <div class="text-center p-4 pb-0">
                                                {{-- <h3 class="mb-0">{{ $course->price() }}</h3> --}}
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small>(123)</small>
                                                </div>
                                                <h5 class="mb-4">{{ $lesson->title }}</h5>
                                            </div>
                                            {{-- <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                                        <small class="flex-fill text-center border-end py-2"><i
                                                class="fa fa-clock text-primary me-2"></i>{{ $course->duration }}</small>
                                        <small class="flex-fill text-center py-2"><i
                                                class="fa fa-user text-primary me-2"></i>30
                                            Students</small>
                                    </div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- tab content -->
        <div class="row">
            <div class="col-lg-12">
                <nav class="courses-pagination mt-50">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a href="#" aria-label="Previous">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li class="page-item"><a class="active" href="#">1</a></li>
                        <li class="page-item"><a href="#">2</a></li>
                        <li class="page-item"><a href="#">3</a></li>
                        <li class="page-item">
                            <a href="#" aria-label="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav> <!-- courses pagination -->
            </div>
        </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== COURSES PART ENDS ======-->
@endsection

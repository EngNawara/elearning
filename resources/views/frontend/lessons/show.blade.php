@extends('layouts.appfront')

@section('content')
    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8"
        style="background-image: url('{{ asset('frontend/images/page-banner-2.jpg') }}')">
        <div class="container">
            <style>
                .lesson-card {
                    background-color: #f8f8f8;
                    border: 1px solid #ddd;
                    padding: 20px;
                    border-radius: 8px;
                }

                .lesson-image img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 5px;
                }

                .lesson-content {
                    font-size: 18px;
                    color: #333;
                    margin-top: 10px;
                }

                .lesson-content h3 {
                    font-size: 24px;
                    color: #007BFF;
                }
            </style>

            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>{{ $lesson->title }} lesson in {{ $course->name }} Course
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

    <!--====== lesson PART START ======-->

    <section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div> <!-- courses top search -->
                </div>
            </div> <!-- row -->
            <div class="row ">
                <div class="py-5 ">
                    <div class="container ">
                        <div class="row d-flex flex-row g-4 justify-content-center">
                            <div class="container">
                                <div class="row d-flex flex-row g-4 justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="lesson-card bg-light p-3">
                                            <div class="lesson-image">
                                                <img src="{{ asset($lesson->image) }}" alt="{{ $lesson->title }}"
                                                    class="img-fluid rounded">
                                            </div>
                                            <div class="lesson-content mt-3">
                                                <h3 class="text-primary">{{ $lesson->title }}</h3>
                                                <p class="mb-3">{{ $lesson->content }}</p>
                                                <p class="mb-0"><strong>Teacher:</strong>
                                                    {{ \App\Models\User::find($course->teacher_id)->name }}

                                                </p>
                                            </div>
                                            {{-- if (auth()->user()->role_id === 1) --}}
                                            @if ($course->id && $lesson->id)
                                                @php
                                                    $courseUser = \App\Models\CourseUser::where('course_id', $course->id)
                                                        ->where('user_id', auth()->user()->id)
                                                        ->first();
                                                    $lessonUser = \App\Models\LessonUser::where('course_user_id', $courseUser->id)
                                                        ->where('lesson_id', $lesson->id)
                                                        ->first();
                                                @endphp

                                                @if ($lessonUser)
                                                    This lessons Is Compleated
                                                @else
                                                    <div>
                                                        <form action="{{ route('lessonUser.store') }}" method="POST"
                                                            style="display: inline;" accept-charset="UTF-8"
                                                            enctype="multipart/form-data">
                                                            @csrf

                                                            <!-- Hidden input fields to pass lesson_id and course_user_id -->
                                                            <input type="hidden" name="lesson_id"
                                                                value="{{ $lesson->id }}">
                                                            <input type="hidden" name="course_user_id"
                                                                value="{{ $courseUser->id }}">
                                                            <input type="checkbox" name="is_best"
                                                                onchange="this.form.submit()" onclick="this.form.submit()">
                                                            Completed
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <!-- Handle the case where $course->id or $lesson->id is missing -->
                                            @endif



                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- tab content -->
        <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== COURSES PART ENDS ======-->
@endsection

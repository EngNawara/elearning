@extends('layouts.app', ['activePage' => 'courses', 'titlePage' => __('Courses'), 'namePage' => 'Courses', 'activePage' => 'courses'])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('courses.lessons.create',['course' => $course->id]) }}">Add
                            Lesson</a>
                        <h4 class="card-title">Lessons </h4>
                        <div class="col-12 mt-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>content</th>
                                    <th>course_id</th>
                                    <th>status</th>
                                    {{-- <th>Image</th> --}}
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            @foreach ($lessons as $lesson)
                                <tbody>
                                    <td>{{ $lesson->title }}</td>
                                    <td>{{ $lesson->content }}</td>
                                    <td>{{ $lesson->course_id }}</td>
                                    <td>{{ $lesson->status }}</td>
                                    {{-- <td>{{ $lesson->status }}</td> --}}
                                    <td class="text-right">
                                        <a type="button" href="{{ route('courses.lessons.edit', ['lesson'=>$lesson->id,'course' => $course->id]) }}" rel="tooltip"
                                            class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                        <form action="{{ route('courses.lessons.destroy',['lesson'=>$lesson->id,'course' => $course->id]) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                            <i class="now-ui-icons ui-1_simple-remove"></i>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
@endsection

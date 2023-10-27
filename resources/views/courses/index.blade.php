@extends('layouts.app', ['activePage' => 'courses', 'titlePage' => __('Courses'), 'namePage' => 'Courses', 'activePage' => 'courses'])

@section('content')
<div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('courses.create') }}">Add
                            Course</a>
                        <h4 class="card-title">Courses</h4>
                        <div class="col-12 mt-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>code</th>
                                    <th>Price</th>
                                    <th>techer name</th>
                                    <th>Category name</th>
                                    <th>duration</th>
                                    <th>status</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if ( $courses )
                            @foreach ($courses as $course)
                            <tbody>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->code }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->teacher_id }}</td>
                                <td>{{ $course->category_id }}</td>
                                <td>{{ $course->duration }}</td>
                                <td>{{ $course->status }}</td>
                                <td class="text-right">
                                    <a type="button" href="{{ route('courses.edit', $course->id) }}" rel="tooltip"
                                        class="btn btn-success btn-icon btn-sm " data-original-title="" title="">
                                        <i class="now-ui-icons ui-2_settings-90"></i>
                                    </a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                            {{-- <i class="now-ui-icons ui-1_simple-remove"></i> --}}
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-twitter" href="{{ route('courses.lessons.index', $course->id) }}">Show Course</a>
                                </td>
                            </tbody>
                        @endforeach
                            @endif

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

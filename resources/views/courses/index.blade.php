@extends('layouts.app', ['activePage' => 'courses', 'titlePage' => __('Courses'), 'namePage' => 'Courses', 'activePage' => 'courses'])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @auth
                            @if (auth()->user()->role_id == 2)
                                <a class="btn btn-primary btn-round text-white pull-right"
                                    href="{{ route('courses.create') }}">Add
                                    Course</a>
                            @endif
                        @endauth

                        <h4 class="card-title">Courses</h4>
                        <div class="col-12 mt-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>code</th>
                                    <th>Price</th>
                                    <th>Teacher</th>
                                    <th>Category</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th> Orders</th>
                                    @auth
                                        @if (auth()->user()->role_id === 1)
                                            <th class="disabled-sorting text-right">IS active</th>
                                            <th class="disabled-sorting text-right">IS Best Course</th>
                                        @endif

                                    @endauth

                                    <th></th>

                                </tr>
                            </thead>
                            @if ($courses)
                                @foreach ($courses as $course)
                                    <tbody>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ $course->code }}</td>
                                        <td>{{ $course->price }}</td>
                                        {{-- <td>{{ $course->teacher_id }}</td> --}}
                                        <td>
                                            {{ \App\Models\User::find($course->teacher_id)->name }} </td>

                                        <td>{{ $course->category->name }}</td>
                                        <td>{{ $course->duration }}</td>
                                        <td>{{ $course->status }}</td>
                                        <td>
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img src="{{ asset($course->image) }}" alt=""
                                                    style="max-width: 80px; border-radiu: 100px">
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('userscourse.index', $course->id) }}"
                                                class=" btn btn-success">Show Order</a>
                                        </td>
                                        @auth
                                            @if (auth()->user()->role_id === 2)
                                                <td class="text-right">
                                                    <a type="button" href="{{ route('courses.edit', $course->id) }}"
                                                        rel="tooltip" class="btn btn-success btn-icon btn-sm "
                                                        data-original-title="" title="">
                                                        <i class="now-ui-icons ui-2_settings-90"></i>
                                                    </a>
                                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @elseif (auth()->user()->role_id === 1)
                                                <td>
                                                    <form action="{{ route('courses.updateIsPopular', $course->id) }}"
                                                        method="POST" style="display: inline;" accept-charset="UTF-8"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="checkbox" name="is_popular" onchange="this.form.submit()"
                                                            onclick="this.form.submit()"
                                                            {{ $course->is_popular == 'on' ? 'checked' : '' }}>
                                                        Mark as Popular
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="{{ route('courses.isActiveSLider', $course->id) }}"
                                                        method="POST" style="display: inline;" accept-charset="UTF-8"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="checkbox" name="is_best" onchange="this.form.submit()"
                                                            onclick="this.form.submit()"
                                                            {{ $course->is_best == 'on' ? 'checked' : '' }}>
                                                        Mark as best
                                                    </form>
                                                </td>
                                            @endif
                                        @endauth

                                        <td>
                                            <a class="btn btn-twitter"
                                                href="{{ route('courses.lessons.index', $course->id) }}">Show Course</a>
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

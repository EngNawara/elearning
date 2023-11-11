@extends('layouts.appfront')

@section('content')
    <div class="container">
        <h1>Your Course Users</h1>
        <div  class="toolbar">
            @if (count($courses) > 0)
            <table class="table table-striped table-bordered" cellspacing="0">
                <thead>
                    <tr>
                        <th>Course Name</th>
                        <th>Enrollment Status</th>
                        <th>Price</th>
                        <th>Teacher Name</th>
                        <th>Duration</th>
                        <th>Enrollment date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $key => $course)

                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $courseUsers[$key]->enrollment_status }}</td>
                            <td>{{ $course->price }}</td>
                          <td>  {{ \App\Models\User::find($course->teacher_id)->name }}</td>
                            <td>{{ $course->duration }}</td>
                            <td>{{ $courseUsers[$key]->enrollment_date }}</td>
                            @if($courseUsers[$key]->enrollment_status === 'Accepted')
                            <td><a href="{{ route('Courses.lessons.index', $course->id) }}" class="btn btn-primary">Show Course</a></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No courses found for the currently authenticated user.</p>
        @endif

        </div>

    </div>
@endsection

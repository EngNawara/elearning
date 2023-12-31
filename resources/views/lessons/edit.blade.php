@extends('layouts.app', ['activePage' => 'CreateCourse', 'titlePage' => __('Edit Category'), 'namePage' => 'Category Update', 'activePage' => 'UpdateCategory'])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $course->name }}</h3>
                            <h2>Edit  {{ $lesson->title }} lessons</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('courses.lessons.index', ['course'=>$course->id]) }}"> Back</a>
                        </div>
                    </div>
                </div>


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

                {!! Form::open([
                    'method' => 'PUT',
                    'route' =>[ 'courses.lessons.update', ['lesson'=>$lesson->id,'course'=>$course->id]],
                    'enctype' => 'multipart/form-data',
                ]) !!}
                 {!! Form::hidden('course_id', $course->id) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Title:</strong>
                            {!! Form::text('title', old('title',$lesson->title), ['placeholder' => 'title', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>content:</strong>
                            {!! Form::text('content', old('content', $lesson->content), ['placeholder' => 'content', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {!! Form::select(
                                'status',
                                [
                                    'enabled' => 'Enabled',
                                    'disable' => 'Disabled',
                                ],
                                old('status', $lesson->status),
                                ['placeholder' => 'status', 'class' => 'form-control'],
                            ) !!}
                        </div>
                    </div>

                </div>

                <div class="row ">
                    <strong>Image</strong>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="image" @error('image') is-invalid @enderror
                            id="selectImage">
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img id="preview" src="#" alt="your image" class="mt-3" style="display:none;" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

@extends('layouts.app', ['activePage' => 'EditCourse', 'titlePage' => __('Edit Category'), 'namePage' => 'Category Update', 'activePage' => 'UpdateCategory'])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>Edit Course</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('courses.index') }}"> Back</a>
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
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

                {!! Form::model($course, [
                    'method' => 'PUT',
                    'route' => ['courses.update', $course->id],
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Code:</strong>
                            {!! Form::text('code', old('code',$course->code), ['placeholder' => 'code', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>description:</strong>
                            {!! Form::text('description', null, ['placeholder' => 'description', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>summary:</strong>
                            {!! Form::text('summary', null, ['placeholder' => 'summary', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>requirement:</strong>
                            {!! Form::text('requirement', null, ['placeholder' => 'requirement', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>price:</strong>
                            {!! Form::number('price', null, ['placeholder' => 'price', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Started at:</strong>
                            {!! Form::date('started_at', old('started_at',$course->started_at), ['placeholder' => 'started_at', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Finished at:</strong>
                            {!! Form::date('finished_at', old('finished_at',$course->started_at), ['placeholder' => 'finished at', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>duration:</strong>
                            {!! Form::text('duration', null, ['placeholder' => 'duration', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Status:</strong>
                            {!! Form::select(
                                'status',
                                [
                                    'enabled' => 'Enabled',
                                    'disabled' => 'Disabled',
                                    'ongoing' => 'Ongoing',
                                    'cancelled' => 'Cancelled',
                                    'completed' => 'Completed',
                                ],
                                null,
                                ['placeholder' => 'status', 'class' => 'form-control'],
                            ) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="form-group">
                            <strong>Category:</strong>
                            {!! Form::select('category_id', $categories->pluck('name', 'id'), $course->category_id, [
                                'placeholder' => 'Select a category',
                                'class' => 'form-control',
                            ]) !!}
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

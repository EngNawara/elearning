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
                            <h2>Edit Order</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('userscourse.index') }}"> Back</a>
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

                {!! Form::model($course, [
                    'method' => 'PUT',
                    'route' => ['userscourse.update', $course->id],
                    'enctype' => 'multipart/form-data',
                ]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
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
                                    'enrolled' => 'Enabled',
                                    'pending' => 'pending',
                                    'completed' => 'Completed',
                                ],
                                null,
                                ['placeholder' => 'status', 'class' => 'form-control'],
                            ) !!}
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection

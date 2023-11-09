@extends('layouts.app', ['activePage' => 'CreateCategoty', 'titlePage' => __('Create User'), 'namePage' => 'User Create', 'activePage' => 'CreateUser', 'activeNav' => ''])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Create New Slider</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('slider.index') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
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



            {!! Form::open(['route' => 'slider.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Title:</strong>
                        {!! Form::text('title', null, ['placeholder' => 'title', 'class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Description:</strong>
                        {!! Form::text('description', null, ['placeholder' => 'description', 'class' => 'form-control']) !!}
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
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        $(function() {
            function showImage(fileInput, imgID) {
                if (fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(imgID).attr('src', e.target.result);
                        $(imgID).attr('alt', fileInput.files[0].name);
                    }
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
            $('#slider-image-btn').on('click', function() {
                $('#slider-image-input').click();
            });
            $('#slider-image-input').on('change', function() {
                showImage(this, '#slider-imgsrc');
            });
        })
    </script>
@endpush

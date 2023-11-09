@extends('layouts.app', ['activePage' => 'categories', 'titlePage' => __('Sliders'), 'namePage' => 'sliders', 'activePage' => 'sliders'])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('slider.create') }}">Add
                            SLider</a>
                        <h4 class="card-title">Sliders</h4>
                        <div class="col-12 mt-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>

                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($sliders)
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $slider->title }}</td>
                                            <td>
                                                <span class="avatar avatar-sm rounded-circle">
                                                    <img src="{{ asset($slider->image) }}" alt=""
                                                        style="max-width: 80px; border-radiu: 100px">
                                                </span>
                                            </td>

                                            <td>{{ $slider->status }}</td>
                                            <td>{{ $slider->description }}</td>
                                            <td class="text-right">
                                                <a type="button" href="{{ route('slider.edit', $slider->id) }}"
                                                    rel="tooltip" class="btn btn-success btn-icon btn-sm "
                                                    data-original-title="" title="">
                                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
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

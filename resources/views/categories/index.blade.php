@extends('layouts.app', ['activePage' => 'categories', 'titlePage' => __('Categories'), 'namePage' => 'categories', 'activePage' => 'categories'])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('category.create') }}">Add
                            Category</a>
                        <h4 class="card-title">Categories</h4>
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

                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Creation date</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>

                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img src="{{ asset('storage') }}/images/{{ $category->image }}"
                                                    alt="" style="max-width: 80px; border-radiu: 100px">
                                            </span>
                                        </td>
                                        <td>{{ $category->created_at }}</td>
                                        <td class="text-right">
                                            <a type="button" href="{{ route('category.edit', $category->id) }}"
                                                rel="tooltip" class="btn btn-success btn-icon btn-sm "
                                                data-original-title="" title="">
                                                <i class="now-ui-icons ui-2_settings-90"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
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

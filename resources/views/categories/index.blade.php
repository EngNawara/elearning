@extends('layouts.app', ['activePage' => 'categories', 'titlePage' => __('Categories'), 'namePage' => 'categories', 'activePage' => 'categories'])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        @auth
                            @if (auth()->user()->role_id === 1)
                                <a class="btn btn-primary btn-round text-white pull-right"
                                    href="{{ route('category.create') }}">Add
                                    Category</a>
                            @endif
                        @endauth

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
                                    @auth
                                        @if (auth()->user()->role_id === 1)
                                            <th class="disabled-sorting text-right">Actions</th>
                                            <th class="disabled-sorting text-right">IS active In Home page</th>
                                        @endif
                                    @endauth

                                </tr>
                            </thead>

                            <tbody>
                                @if ($categories)
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <span class="avatar avatar-sm rounded-circle">
                                                    <img src="{{ asset($category->image) }}" alt=""
                                                        style="max-width: 80px; border-radiu: 100px">
                                                </span>
                                            </td>
                                            <td>{{ $category->created_at }}</td>
                                            @auth
                                                @if (auth()->user()->role_id === 1)
                                                    <td class="text-right">
                                                        <a type="button" href="{{ route('category.edit', $category->id) }}"
                                                            rel="tooltip" class="btn btn-success btn-icon btn-sm "
                                                            data-original-title="" title="">
                                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                                        </a>
                                                        <form action="{{ route('category.destroy', $category->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                                {{-- <i class="now-ui-icons ui-1_simple-remove"></i> --}}
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    {{-- @elseif (auth()->user()->role_id === 1) --}}
                                                    <td>

                                                        <form action="{{ route('category.homecategory', $category->id) }}"
                                                            method="POST" style="display: inline;" accept-charset="UTF-8"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="checkbox" name="is_active_in_home"
                                                                onchange="this.form.submit()"
                                                                {{ $category->is_active_in_home == 'on' ? 'checked' : '' }}>
                                                            Mark as active
                                                        </form>
                                                    </td>
                                                @endif

                                            @endauth
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

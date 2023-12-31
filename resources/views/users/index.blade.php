@extends('layouts.app', ['activePage' => 'EditUser', 'titlePage' => __('Edit User'), 'namePage' => 'User Update', 'activePage' => 'UpdateUser'])
@section('content')
    <div class="panel-header">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('user.create') }}">Add
                            user</a>
                        <h4 class="card-title">Users</h4>
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
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Creation date</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($users)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <span class="avatar avatar-sm rounded-circle">
                                                    <img src="{{ asset('assets') }}/img/default-avatar.png" alt=""
                                                        style="max-width: 80px; border-radiu: 100px">
                                                </span>
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->role }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td class="text-right">
                                                <a type="button" href="{{ route('user.edit', $user->id) }}" rel="tooltip"
                                                    class="btn btn-success btn-icon btn-sm " data-original-title=""
                                                    title="">
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

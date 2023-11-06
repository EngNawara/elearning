@extends('layouts.app', ['activePage' => 'courses', 'titlePage' => __('Courses'), 'namePage' => 'Courses', 'activePage' => 'courses'])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <h4 class="card-title">Order</h4>
                        <div class="col-12 mt-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Enrollment Status</th>
                                    <th>Enrollment Date</th>
                                    @auth
                                        @if (auth()->user()->role_id === 2)
                                            <th></th>
                                        @endif
                                    @endauth
                                </tr>
                            </thead>
                            @foreach ($courseUsers as $courseUser)
                                <tbody>

                                    <td>
                                        @if ($courseUser->user_id)
                                            <?php $user = \App\Models\User::find($courseUser->user_id); ?>
                                            @if ($user)
                                                {{ $user->name }}
                                            @else
                                                User not found
                                            @endif
                                        @else
                                            User ID not available
                                        @endif
                                    </td>
                                    <td>{{ $courseUser->enrollment_status }}</td>
                                    <td>{{ $courseUser->enrollment_date }}</td>

                                    @auth
                                        @if (auth()->user()->role_id === 2)
                                            <td class="text-right">
                                                {{-- <a type="button" href="{{ route('userscourse.edit', $courseUser) }}" rel="tooltip"
                                                    class="btn btn-success btn-icon btn-sm " data-original-title=""
                                                    title="">
                                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                                </a> --}}
                                                <form
                                                    action="{{ route('userscourse.destroy', ['course_id' => $course->id, 'userscourse' => $courseUser->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-icon btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this Course User?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                        @endif
                                    @endauth

                                </tbody>
                            @endforeach
                            {{-- @endif --}}

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

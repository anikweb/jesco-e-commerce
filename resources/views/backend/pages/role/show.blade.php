@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit Role</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $role->name }}</h3>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Name</td>
                                <td>{{$role->name}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Permissions</td>
                                <td>
                                    <ol>
                                        @foreach ($role->permissions as $permission)
                                            <li>{{ Str::title($permission->name) }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Assigned User</td>
                                <td>
                                    <ol>
                                        @forelse ($role->users as $user)
                                            <li>{{ $user->email }}</li>
                                        @empty
                                            <p title="You can assign user to this role" class="text-muted"><i class="fa fa-exclamation-circle"></i> No user Assigned Yet!</p>
                                        @endforelse
                                    </ol>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Created</td>
                                <td>{{$role->created_at->format('d-M-Y, h:i:s A')}}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Last Update</td>
                                <td>{{$role->updated_at->diffForHumans()}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer_js')
    <script>
        @if (session('success'))
            toastr["success"]("{{ session('success') }}")
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}")
        @endif
    </script>
@endsection

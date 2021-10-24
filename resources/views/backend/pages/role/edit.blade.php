@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card-body">
                        <form action="{{ route('role.update',$role->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="card-title font-weight-bold">{{ $role->name }}</p>
                                </div>
                                <div class="col-md-12">
                                    <p class="mb-0">Choose Permissions</p>
                                    @foreach ($permissions as $permission)
                                        <label for="permissions{{ $permission->id }}" class="font-weight-normal">
                                            <input @foreach ($role->permissions as $perm)
                                                @if($perm->name == $permission->name ) checked @endif
                                            @endforeach
                                            type="checkbox" value="{{ $permission->name }}" name="permissions[]" id="permissions{{ $permission->id }}"> {{ Str::title($permission->name) }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
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

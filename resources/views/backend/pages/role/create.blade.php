@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Create Role</li>
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
                        <h3 class="card-title">Add Roles</h3>
                   </div>
                   <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">Enter Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name of Role">
                                    @error('name')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                               <div class="col-md-12 mt-1">
                                    <label class="card-title">Choose Permissions</label>
                               </div>
                                <div class="col-md-12">
                                    @if (session('permissionBlank'))
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ session('permissionBlank') }}
                                        </div>
                                    @endif
                                    @foreach ($permissions as $permission)
                                        <label for="permissions{{ $permission->id }}" class="font-weight-normal">
                                            <input  type="checkbox" name="permissions[]" id="permissions{{ $permission->id }}" class="@error('permissions[]') is-invalid @enderror"  value="{{ $permission->name }}"> {{ Str::title($permission->name) }}
                                        </label>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Add</button>
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
            toastr["success"]("{{ session('success') }}");
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}");
        @endif
    </script>
@endsection

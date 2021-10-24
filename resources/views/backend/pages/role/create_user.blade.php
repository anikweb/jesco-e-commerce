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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create User</li>
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
                        <h3 class="card-title">Create User</h3>
                   </div>
                   <div class="card-body">
                        <form action="{{ route('create.user.post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Enter Full Name <span>*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name">
                                    @error('name')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email">Enter Email <span>*</span></label>
                                    <input type="email" name="email" id="" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email">
                                    @error('email')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="role">Select Role <span>*</span></label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">-Select-</option>
                                        @foreach ($roles as $role)
                                            @if ($role->name != 'Super Admin' && $role->name != 'Customer' )
                                                <option value="{{ $role->name }}">{{ Str::title($role->name) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-1">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create User</button>
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

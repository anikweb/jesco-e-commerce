@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Assign/Sync Role</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">Assign/Sync Role</li>
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
                        <h3 class="card-title">Add/Sync Roles</h3>
                   </div>
                   <div class="card-body">
                        <form id="assign_form" action="{{ route('assign.user.post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Select User</label>
                                    <select name="user" id="" class="form-control @error('user') is-invalid @enderror">
                                        <option value="">-Select-</option>
                                        @foreach ($users as $user)
                                            <option @if(old('user')==$user->id) selected @endif value="{{ $user->id }}">{{ $user->name.' ( '.$user->email.' )' }}</option>
                                        @endforeach
                                    </select>
                                    @error('user')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="">Select Role</label>
                                    <select name="role" id="" class="form-control @error('role') is-invalid @enderror">
                                        <option value="">-Select-</option>
                                        @foreach ($roles as $role)
                                            <option @if(old('role')==$role->name) selected @endif name="role" value="{{ $role->name }}">{{ Str::title($role->name) }}</option>
                                        @endforeach

                                    </select>
                                    @error('role')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mt-1 text-center">
                                    <button type="button" class="btn btn-primary form_submit_btn"> <i class="fa fa-plus-circle"></i> Assign</button>
                                </div>
                            </div>
                        </form>
                   </div>
               </div>
           </div>
       </div>
       <div class="row">
           <div class="col-md-12">
               <div class="card card-primary">
                   <div class="card-header">
                       <h3 class="card-title">Users</h3>
                   </div>
                   <div class="card-body">
                       <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name of user</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Email Verification</th>
                                        <th>Created</th>
                                    </tr>
                                    @foreach ($usersV as $user)
                                        {{--  @if ($user->roles->first()->name != 'Customer')  --}}
                                            <tr>
                                                <td>{{ $usersV->firstItem() +$loop->index }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                        {{ Str::title($role->name) }}
                                                    @endforeach
                                                </td>
                                                <td>{{ $user->email_verified_at ? $user->email_verified_at : 'None'  }}</td>
                                                <td>{{ $user->created_at->format('d-M-Y, h:i:s A') }}</td>
                                            </tr>
                                        {{--  @endif  --}}
                                    @endforeach
                                </thead>
                            </table>
                            <div class="mt-1">
                                {{ $usersV->links()  }}
                            </div>
                       </div>
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
        $('.form_submit_btn').click(function(){

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                // text: 'Invoice No:',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'User Assigned!',
                // 'This voucher is now deleted.',
                // 'success'
                )
                setTimeout(function(){
                    $("#assign_form").submit();
                }, 1000);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                // 'This voucher is safe',
                // 'error',
                )
            }
            })
        });
    </script>
@endsection

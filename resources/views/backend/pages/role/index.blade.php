@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Roles</li>
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
                        <h3 class="card-title">Roles </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30">#</th>
                                        <th>Name</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td>{{ $roles->firstItem() +$loop->index  }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>{{ $role->created_at->format('d-M-Y, h:i:s A') }}</td>
                                            <td>

                                                <a href="{{ route('role.show',$role->name) }}" class="btn btn-info"> <i class="fa fa-eye"></i> Details</a>
                                                <a href="{{ route('role.edit',$role->name) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                                                <button type="button" data-role="{{ $role->id }}" class="btn btn-danger trash_btn"><i class="fa fa-trash"></i> Delete</button>
                                                {{-- Delete By POST Method Start --}}
                                                <form id="role_delete_form{{ $role->id }}" class="d-inline-block" action="{{ route('role.destroy',$role->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                </form>
                                                {{-- Delete By POST Method End  --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{ $roles->links() }}
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
            toastr["success"]("{{ session('success') }}")
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}")
        @endif
        $('.trash_btn').click(function(){
            var role_id = $(this).attr('data-role');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to delete this role?',
                // text: 'Invoice No:',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Delete!',
                'This voucher is now deleted.',
                'success'
                )
                setTimeout(function(){
                    $("#role_delete_form"+role_id).submit();
                }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'This voucher is safe',
                'error',
                )
            }
            })
        });
    </script>
@endsection

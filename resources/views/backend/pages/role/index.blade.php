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
                                                {{-- Delete By POST Method Start --}}
                                                <form class="d-inline-block" action="{{ route('role.destroy',$role->id) }}" method="POST">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
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
    </script>
@endsection

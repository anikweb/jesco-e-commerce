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
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                      <li class="breadcrumb-item active">Orders</li>
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
                        <h3 class="card-title"><i class="fa fa-dolly"></i> Orders</h3>
                   </div>
                   <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th>Invoice No</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Payment Method</th>
                                        <th>Current Status</th>
                                        <th class="text-center" colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($billings as $billing)
                                        <tr>
                                            <td>{{ $billings->firstItem() + $loop->index }}</td>
                                            <td>kfsjfskbfkb354</td>
                                            <td>{{ $billing->user->name }}</td>
                                            <td>{{ $billing->created_at->format('M-D-Y') }}</td>
                                            <td><span class="badge badge-info">{{ $billing->payment_method }}</span></td>
                                            <td><span class="badge badge-info">Shiped</span></td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-primary"><i class="fa fa-eye"></i> Details</a>
                                            </td >
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cencel Order</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="3" class="lead"> <i class="fa fa-exclamation-circle"></i> No Wishlists Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $billings->links() }}
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
    </script>
@endsection

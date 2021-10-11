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
                      <li class="breadcrumb-item active">Vouchers</li>
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
                        <h3 class="card-title"><i class="fa fa-tags"></i> Vouchers</h3>
                   </div>
                   <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Discount</th>
                                        <th>Limit</th>
                                        <th>Used</th>
                                        <th>Min Checkout Price</th>
                                        <th>Expiry Date</th>
                                        <th>Created</th>
                                        @if (auth()->user()->can("voucher edit")||auth()->user()->can("voucher deactivate")||auth()->user()->can("voucher trash"))
                                            <th colspan="3" class="text-center">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($vouchers as $voucher)
                                    <tr>
                                        <td>{{ $vouchers->firstItem() + $loop->index }}</td>
                                        <td>{{ $voucher->name }}</td>
                                        <td>{{ $voucher->discount.'%' }}</td>
                                        <td>{{ $voucher->limit }}</td>
                                        <td>{{ $voucher->used }}</td>
                                        <td>{{ $voucher->min_checkout_price }}</td>
                                        <td>{{ $voucher->expiry_date }}</td>
                                        <td>{{ $voucher->created_at->format('d-M-Y, h:i A') }}</td>
                                        @can('voucher edit')
                                            <td class="text-center">
                                                <a href="{{ route('voucher.edit',$voucher->slug) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                        @endcan
                                        @can('voucher deactivate')
                                            <td class="text-center">
                                                <a href="{{ route('voucher.deactivate',$voucher->id) }}" class="btn btn-danger"> <i class="fab fa-creative-commons-zero"></i> Deactive</a>
                                            </td>
                                        @endcan
                                        @can('voucher trash')
                                            <td class="text-center">
                                                <form action="{{ route('voucher.destroy',$voucher->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Trash </button>
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            <i class="fa fa-exclamation-circle"></i>
                                            No Active Voucher Available
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $vouchers->links() }}
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

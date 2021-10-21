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
                                        <th>Payment Status</th>
                                        <th>Current Status</th>
                                        <th class="text-center" colspan="3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{ $orders->firstItem() + $loop->index }}</td>
                                            <td>{{ $order->invoice_no }}</td>
                                            <td>{{ $order->billing_details->user->name }}</td>
                                            <td>{{ $order->billing_details->created_at->format('M-D-Y') }}</td>
                                            <td><span class="badge badge-info">
                                                @if ($order->billing_details->order_summary->first()->payment_status == 1)
                                                    Unpaid (COD)
                                                @else
                                                    Paid (Online)
                                                @endif
                                            </span></td>
                                            <td><span class="badge badge-info">
                                                Out for Delivery
                                            </span></td>
                                            <td class="text-center">
                                                <a href="{{ route('dashboard.orders.details',$order->invoice_no) }}" class="btn btn-primary"><i class="fa fa-eye"></i> Details</a>
                                            </td >
                                            <td class="text-center">
                                                <button data-invoice="{{ $order->invoice_no }}" class="btn btn-success up-status-btn"><i class="fa fa-truck-loading"></i> Upgrade to Delivered</button>
                                            </td>
                                            <td class="text-center">
                                                <button data-invoice="{{ $order->invoice_no }}" class="btn btn-danger cancel-order-btn"><i class="fa fa-times-circle"></i> Cencel Order</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="8"> <i class="fa fa-exclamation-circle"></i> Not Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $orders->links() }}
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

        $('.up-status-btn').click(function(){
            var data_invoice = $(this).attr('data-invoice');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you upgrading this order to delivered?',
                text: 'Invoice No: '+data_invoice,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, upgrade it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Upgraded!',
                'This order is now in delivered.',
                'success'
                )
                setTimeout(function(){
                    window.location.href = "{{ url('dashboard/orders/out-for-delivered/upgrade/delivered') }}/"+data_invoice;

                }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'This order steel now in out for delivery!',
                'error',
                )
            }
            })
        });
        $('.cancel-order-btn').click(function(){
            var data_invoice = $(this).attr('data-invoice');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you upgrading this order to shipped?',
                text: 'Invoice No: '+data_invoice,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, upgrade it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Upgraded!',
                'This order is now in shipping.',
                'success'
                )
                setTimeout(function(){
                    window.location.href = "{{ url('dashboard/orders/cancel') }}/"+data_invoice;
                }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'This order steel now in Picup in Progress!',
                'error',
                )
            }
            })
        });

    </script>

@endsection

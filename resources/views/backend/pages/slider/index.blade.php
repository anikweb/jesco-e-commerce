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
                      <li class="breadcrumb-item active">Sliders</li>
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
                        <h3 class="card-title"><i class="fa fa-sliders-h"></i> Sliders</h3>
                   </div>
                   <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Promotion</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        @if (auth()->user()->can('slider deactivate')||auth()->user()->can('slider activate')||auth()->user()->can('slider trash'))
                                            <th colspan="3" class="text-center">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sliders as $slider)
                                    <tr>
                                        <td>{{ $sliders->firstItem() + $loop->index }}</td>
                                        <td class="text-center">
                                            <img width="120px" src="{{ asset('assets/images/slider-image/'.$slider->image) }}" alt="{{ $slider->title }}">
                                        </td>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->promotions }}</td>
                                        <td>{{ $slider->url }}</td>
                                        <td>
                                            @if ($slider->status==1)
                                            <span class="badge badge-success">Active</span>
                                            @elseif ($slider->status==2)
                                            <span class="badge badge-danger">Deactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $slider->created_at->format('d-M-Y, h:i A') }}</td>
                                        @can('slider edit')
                                            <td class="text-center">
                                                <a href="{{ route('slider.edit',$slider->id) }}" class="btn btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                        @endcan
                                            @if (auth()->user()->can('slider deactivate')||auth()->user()->can('slider activate'))
                                                <td class="text-center">
                                                    @if ($slider->status == 1)
                                                        @can('slider deactivate')
                                                            <button data-slider="{{$slider->id}}" type="button" class="btn btn-danger slider-deactive_btn"> <i class="fab fa-creative-commons-zero"></i> Deactive</button>
                                                        @endcan
                                                    @elseif ($slider->status == 2)
                                                        @can('slider activate')
                                                            <button type="button"  data-slider="{{$slider->id}}" class="btn btn-success slider-active_btn"> <i class="fa fa-check-circle"></i> Active</button>
                                                        @endcan
                                                    @endif
                                                </td>
                                            @endif

                                        @can('slider trash')
                                            <td class="text-center">
                                                <button data-slider="{{$slider->id}}" type="button" class="btn btn-danger trash_btn"><i class="fa fa-trash"></i> Trash </button>
                                                <form id="slider_trash_form{{ $slider->id }}" action="{{ route('slider.destroy',$slider->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        @endcan
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">
                                            <i class="fa fa-exclamation-circle"></i>
                                            No Active Sliders Available
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $sliders->links() }}
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
        $('.slider-deactive_btn').click(function(){
            var slider_id = $(this).attr('data-slider');
            // alert(slider_id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to deactive this voucher?',
                // text: 'Invoice No:',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, deactive it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Deactivate!',
                'This voucher is now deactivate.',
                'success'
                )
                setTimeout(function(){
                    window.location.href = '{{ url("dashboard/slider/deactivate") }}/'+slider_id;
                }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'This voucher steel now deactivated',
                'error',
                )
            }
            })
        });
        $('.slider-active_btn').click(function(){
            var slider_id = $(this).attr('data-slider');
            // alert(slider_id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to active this voucher?',
                // text: 'Invoice No:',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, active it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Activated!',
                'This voucher is now activated.',
                'success'
                )
                setTimeout(function(){
                    window.location.href = '{{ url("dashboard/slider/active") }}/'+slider_id;
                }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'This voucher steel now deactivated',
                'error',
                )
            }
            })
        });
        $('.trash_btn').click(function(){
            var slider_id = $(this).attr('data-slider');
            // alert(slider_id);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to delete this voucher?',
                // text: 'Invoice No:',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                'Deleted!',
                'This voucher is now in trash box.',
                'success'
                )
                setTimeout(function(){
                    $("#slider_trash_form"+slider_id).submit();
                }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Cancel to delete!',
                'error',
                )
            }
            })
        });
    </script>
@endsection

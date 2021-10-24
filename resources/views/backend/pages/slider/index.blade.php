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
                                                            <a href="{{ route('slider.deactivate',$slider->id) }}" class="btn btn-danger"> <i class="fab fa-creative-commons-zero"></i> Deactive</a>
                                                        @endcan
                                                    @elseif ($slider->status == 2)
                                                        @can('slider activate')
                                                            <a href="{{ route('slider.active',$slider->id) }}" class="btn btn-success"> <i class="fa fa-check-circle"></i> Active</a>
                                                        @endcan
                                                    @endif
                                                </td>
                                            @endif

                                        @can('slider trash')
                                            <td class="text-center">
                                                <form action="{{ route('slider.destroy',$slider->id) }}" method="POST">
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
    </script>
@endsection

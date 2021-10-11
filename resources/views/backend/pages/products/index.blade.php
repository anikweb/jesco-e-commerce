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
                      <li class="breadcrumb-item active">Products</li>
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
                        <h3 class="card-title">Products</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Thumbnail</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Created</th>
                                        <th>Last Update</th>
                                        <th>Status</th>
                                        <th colspan="3" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $products->firstItem() + $loop->index }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td><img width="120px" class="image-responsive rounded" src="{{ asset('assets/images/product/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail) }}" alt="{{ $product->name }}"></td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->subcategory->name }}</td>
                                            <td>{{ $product->created_at->format('d-M-Y, h:i:s A') }}</td>
                                            <td>{{ $product->updated_at->diffForHumans() }}</td>
                                            <td> @if ($product->attribute->sum('quantity') > 0) <span class="badge badge-info">active</span> @else <span class="badge badge-danger">Stock Out</span>@endif</td>
                                            <td>
                                                @can('product edit')
                                                    <a href="{{ route('product.edit',$product->slug) }}" class="btn btn-primary text-center"><i class="fa fa-edit"></i> Edit</a>
                                                @endcan
                                                <a href="{{ route('products.image.gallery',$product->slug) }}" class="btn btn-warning text-center"><i class="fa fa-image"></i> Image Gallery </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.show',$product->slug) }}" class="btn btn-info text-center"><i class="fa fa-eye"></i> Details</a>
                                            </td>
                                            <td>
                                                @can('product edit')
                                                @if ($product->attribute->sum('quantity') > 0) 
                                                    <a href="{{ route('products.stock.out',$product->id) }}" class="btn btn-danger text-center"> <i class="fa fa-shopping-cart"></i> Force Stock Out</a>
                                                @else
                                                    <a href="javascript:void(0)" style="background-color: #e998a0;color:white; border:1px solid #e998a0; cursor:context-menu" class="btn text-center"> <i class="fa fa-shopping-cart"></i> Force Stock Out</a>
                                                @endif    
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                    <tr class="text-center text-muted">
                                        <td colspan="10"><i class="fa fa-exclamation-circle"></i> No Product to show</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $products->links() }}
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
        // Notification
        @if (session('success'))
            toastr["success"]("{{ session('success') }}");
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}");
        @endif
    </script>
@endsection

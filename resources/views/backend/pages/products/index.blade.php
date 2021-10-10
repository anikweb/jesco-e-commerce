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
                                        <th colspan="3" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>{{ $products->firstItem() + $loop->index }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->thumbnail }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->subcategory->name }}</td>
                                            <td>{{ $product->created_at->format('d-M-Y, h:i:s A') }}</td>
                                            <td>{{ $product->updated_at->diffForHumans() }}</td>
                                            <td>
                                                <a href="{{ route('product.edit',$product->slug) }}" class="btn btn-primary text-center"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('product.show',$product->slug) }}" class="btn btn-info text-center"><i class="fa fa-eye"></i> Details</a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger text-center">Force Stock Out</a>
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

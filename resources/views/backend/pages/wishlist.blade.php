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
                      <li class="breadcrumb-item active">Wishlist</li>
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
                        <h3 class="card-title"><i class="fa fa-heart"></i> Wishlist</h3>
                   </div>
                   <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20px">#</th>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Subcategory</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($wishlists as $wishlist)
                                        <tr>
                                            <td>{{ $wishlists->firstItem() + $loop->index }}</td>
                                            <td>
                                                <img width="100px" class="img-responsive ml-15px rounded" src="{{ asset('assets/images/product').'/'.$wishlist->product->created_at->format('Y/m/d/').$wishlist->product->id.'/thumbnail/'.$wishlist->product->thumbnail }}" alt="{{ $wishlist->product->name }}">
                                            </td>
                                            <td>{{ $wishlist->product->name }}</td>
                                            <td>{{ $wishlist->product->category->name }}</td>
                                            <td>{{ $wishlist->product->subcategory->name}}</td>
                                            <td>{{ $wishlist->product->attribute->sum('quantity') }}</td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="3" class="lead"> <i class="fa fa-exclamation-circle"></i> No Wishlists Available</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                {{ $wishlists->links() }}
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

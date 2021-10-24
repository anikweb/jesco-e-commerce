@extends('backend.master')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard {{ $product->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                      <li class="breadcrumb-item active">Image Gallery </li>
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
                        <h3 class="card-title">Image Gallery</h3>
                   </div>
                   <div class="card-body">
                   <div class="row">
                        @foreach ($product->imageGallery as $item)
                            <div class="col-md-1 m-2 text-center">
                               <img style="max-width: 250px;" class="image-responsive rounded w-100" width="150px" src="{{ asset('assets/images/product/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/'.$item->name) }}" alt="Product Image">
                               @can('product delete')
                                    <a href="{{ route('products.image.gallery.delete',$item->id) }}" class="btn btn-danger m-1 d-inline-block"> <i class="fa fa-trash"></i></a>
                               @endcan
                            </div>
                        @endforeach
                   </div>
                   @can('product edit')
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('products.image.gallery.post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="addImage">Add Image</label>
                                    <input value="{{ $product->id }}" type="hidden" name="product_id">
                                    <input multiple="" style="padding:3px 0 0 3px" type="file" name="imageGalleries[]" id="addImage" class="form-control">
                                    <button type="submit" class="btn btn-primary mt-1"><i class="fa fa-upload"></i> Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>

                   @endcan
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

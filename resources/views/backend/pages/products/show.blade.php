@extends('backend.master')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $product->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <!-- Default box -->
         <div class="card card-solid">
            <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                <div class="col-12">
                    <h1></h1>
                    <img src="{{ asset('assets/images/product/'.$product->created_at->format('Y/m/d/').$product->id.'/thumbnail/'.$product->thumbnail) }}" class="product-image" alt="Product Image">
                </div>
                <div class="col-md-12 p-2 bg-info rounded mt-2">
                    <h4 >Image Gallery</h4>
                </div>
                <div class="col-12 product-image-thumbs">
                    @forelse($product->imageGallery as $imageGallery)
                        <div class="product-image-thumb ">
                            <img src="{{ asset('assets/images/product/'.$product->created_at->format('Y/m/d/').$product->id.'/image_galleries/'.$imageGallery->name) }}" alt="Product Image">
                        </div>
                    @empty
                    <div class="product-image-thumb ">
                        <img src="{{ asset('assets/images/image-placeholder.jpg') }}" alt="Product Image">
                    </div>
                    @endforelse
                </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $product->name }}</h3>
                    <h4>Regular Price : <del class="text-danger regular_price">৳{{ $product->attribute->max('regular_price') }}</del>, Offer Price: <span class="text-success offer_price">৳{{ $product->attribute->min('offer_price') }}</span></h4>
                    <p class="m-0 font-weight-bold">Summary</p>
                    <p>{{ $product->summary }}</p>

                    <hr>
                    <h4>Available Colors</h4>
                    @php
                        $data = $product->attribute->unique('color_id');
                    @endphp
                    @foreach ($data as $attribute)
                        <label class="btn btn-default text-center">
                            <span class="colorId" data-product="{{ $product->id }}" data-color="{{ $attribute->color_id }}" class="text-xl">{{ Str::title($attribute->color->name) }}</span>
                            <br>
                        </label>
                    @endforeach
                <h4 class="mt-3">Available Size</h4>
                @php
                    $data1 = $product->attribute->unique('size_id');
                @endphp
                <div class="btn-group btn-group-toggle size_btn" data-toggle="buttons">
                   <div class="row">
                       <div class="col-md-12">
                            @foreach ($data1 as $attribute)
                                <label class="btn btn-default text-center">
                                    <input class="d-none" type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">{{ $attribute->size_id }}</span>
                                    <br>
                                </label>
                            @endforeach
                       </div>
                   </div>
                </div>
                <div class="table-responsive pt-2">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold">Category:</td>
                                <td>{{ $product->category->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Subcategory:</td>
                                <td>{{ $product->subcategory->name }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Gender:</td>
                                <td>{{ Str::title($product->gender) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Warrenty:</td>
                                <td>{{ Str::title($product->warranty_name->warranty) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Return:</td>
                                <td>{{ Str::title($product->return_name->name) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Promotions:</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Main Upper Material:</td>
                                <td>{{ Str::title($product->main_upper_material) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Outsole Material:</td>
                                <td>{{ Str::title($product->outsole_material) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Brand:</td>
                                <td>{{ Str::title($product->brand) }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Authenticity:</td>
                                <td>{{ Str::title($product->authentic).'%' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Rating</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> {{ $product->description }}</div>

                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> Cras ut ipsum ornare, aliquam ipsum non, posuere elit. In hac habitasse platea dictumst. Aenean elementum leo augue, id fermentum risus efficitur vel. Nulla iaculis malesuada scelerisque. Praesent vel ipsum felis. Ut molestie, purus aliquam placerat sollicitudin, mi ligula euismod neque, non bibendum nibh neque et erat. Etiam dignissim aliquam ligula, aliquet feugiat nibh rhoncus ut. Aliquam efficitur lacinia lacinia. Morbi ac molestie lectus, vitae hendrerit nisl. Nullam metus odio, malesuada in vehicula at, consectetur nec justo. Quisque suscipit odio velit, at accumsan urna vestibulum a. Proin dictum, urna ut varius consectetur, sapien justo porta lectus, at mollis nisi orci et nulla. Donec pellentesque tortor vel nisl commodo ullamcorper. Donec varius massa at semper posuere. Integer finibus orci vitae vehicula placerat. </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        {{--  </div>  --}}
        <!-- /.card -->

        </section>
@endsection
@section('footer_js')
<script>
     $(document).ready(function(){
            $('.colorId').click(function(){
                var colorId = $(this).attr('data-color');
                var productId = $(this).attr('data-product');
                // alert(productId);
                $.ajax({
                    type: "GET",
                    url: "{{ url('/dashboard/get/color/size') }}/"+colorId+'/'+productId,
                    success:function(res){
                        if(res){
                            console.log(res);
                                // $('.size').empty();
                                $('.size_btn').empty();
                                // $('.sizeName').append('<div class="badge text-white bg-info">Sizes</div>');
                                // $('.sizeAdd').empty();
                                $('.size_btn').html(res);
                                $('.sizeCheck').change(function(){
                                    var rprice = $(this).attr('data-rprice');
                                    var ofrPrice = $(this).attr('data-ofrPrice');
                                    // alert(ofrPrice);
                                    $('.offer_price').empty();
                                    $('.regular_price').empty();
                                    $('.offer_price').html('৳'+ofrPrice);
                                    $('.regular_price').html('৳'+rprice);
                                });

                        }
                    }
                });
            });
        });
</script>
@endsection

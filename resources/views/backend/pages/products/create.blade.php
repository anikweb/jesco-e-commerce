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
                        <li class="breadcrumb-item active">Add Product</li>
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
                        <h3 class="card-title">Add Product</h3>
                   </div>
                   <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="name">Name <span>*</span> </label>
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Product Name">
                                            @error('name')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="category">Category <span>*</span></label>
                                            <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                                                <option value="">-Select-</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="subcategory_id">Subcategory <span>*</span></label>
                                            <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">
                                                <option value="">-Select-</option>
                                            </select>
                                            @error('subcategory_id')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <div class="form-group">
                                            <p class="mb-2 font-weight-bold">Choose Thumbnail <span>*</span>
                                            <div>
                                                <img  class="image-responsive rounded " width="200px" src="{{ asset('assets/images/image-placeholder.jpg') }}" alt="thumbnail" id="thumbnail_preview">
                                            </div>
                                            <label for="thumbnail" class="btn btn-success mt-1"><i class="fa fa-hand-pointer"></i> Choose Thumbnail</label>
                                            <input onchange="document.getElementById('thumbnail_preview').src = window.URL.createObjectURL(this.files[0])" type="file" class="d-none" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror">
                                            @error('thumbnail')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="image_galleries">Image Gallery <span>*</span></label>
                                    <input style="padding:3px 0px 0px 5px" type="file" multiple="" name="image_galleries[]" id="image_galleries" class="form-control">
                                    @error('image_galleries[]')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">Gender <span>*</span></label>
                                    <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                                        <option value="none">-None-</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="both">Both</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="warranty">Warranty</label>
                                    <select name="warranty" id="warranty" class="form-control">
                                        <option value="4">None</option>
                                        @foreach ($warranties as $warranty)
                                            @if ($warranty->warranty != 'none')
                                                <option value="{{ $warranty->id }}">{{ $warranty->warranty }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="return">Return</label>
                                    <select name="return" id="return" class="form-control">
                                        <option value="6">None</option>
                                        @foreach ($returns as $return)
                                            @if ($return->name != 'none')
                                                <option value="{{ $return->id }}">{{ $return->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="promotions">Promotions</label>
                                    <select name="promotions" id="promotions" class="form-control">
                                        <option value="">-None-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_upper_material">Main Upper Material</label>
                                    <input type="text" name="main_upper_material" id="main_upper_material" class="form-control" placeholder="Type Main Upper Material">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="outsole_material">Outsole Material</label>
                                    <input type="text" name="outsole_material" id="outsole_material" class="form-control" placeholder="Enter brand name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" id="brand" class="form-control" placeholder="Enter brand name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="origin">Origin</label>
                                    <input type="text" name="origin" id="origin" class="form-control" placeholder="Enter origin name">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="authentic">Authenticity</label>
                                    <select name="authentic" id="authentic" class="form-control">
                                        <option value="none">-None-</option>
                                        <option value="50">50% Authentic</option>
                                        <option value="60">60% Authentic</option>
                                        <option value="70">70% Authentic</option>
                                        <option value="80">80% Authentic</option>
                                        <option value="90">90% Authentic</option>
                                        <option value="100">100% Authentic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="summary">Summary <span>*</span></label>
                                            <textarea name="summary" id="summary"  rows="5" class="form-control @error('summary') is-invalid @enderror" placeholder="Type Summary"></textarea>
                                            @error('summary')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">Description <span>*</span></label>
                                            <textarea name="description" id="description"  rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Type Description"></textarea>
                                            @error('description')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="multi-field-wrapper">
                                        <div class="multi-fields">
                                            <div class="row multi-field form-group my-2">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="color">Color</label>
                                                                <select name="color[]" class="form-control " id="color">
                                                                    <option value="8">None</option>
                                                                    @foreach ($colors as $color)
                                                                        @if ($color->name !='none')
                                                                            <option value="{{ $color->id }}">{{ Str::title($color->name) }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="size">Size</label>
                                                                <select name="size[]" class="form-control" id="size">
                                                                    <option value="">None</option>
                                                                    @for ($i = 34; $i < 50; $i++)
                                                                        <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="rPrice">Regular Price <span class="text-danger">*</span> </label>
                                                                <input type="text" name="rPrice[]" class="form-control @error('rPrice[]') is-invalid @enderror" id="rPrice">
                                                                @error('rPrice[]')
                                                                    <div class="text-danger">
                                                                        <i class="fa fa-exclamation-circle"></i>
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ofrPrice">Offer Price</label>
                                                                <input type="text" name="ofrPrice[]" class="form-control @error('ofrPrice[]') is-invalid @enderror" id="ofrPrice">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 remove-field outline-danger text-white my-auto">
                                                    <span class="text-danger" style="cursor:pointer"><i class=" fas fa-minus-circle"></i> Remove</span>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="add-field btn-sm btn-primary ">Add new field</button>
                                    </div>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-info"><i class="fa fa-plus-circle"></i> Add Product</button>
                            </div>
                        </div>
                    </form>
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
        $('#category').change(function(){
            var category_id = $('#category').val();

            $.ajax({
                type:"GET",
                url:"{{ url('products/get/subcategory' )}}/"+category_id,
                success:function(res){
                if(res){
                    // alert(res.name);
                    $("#subcategory_id").empty();
                    $("#subcategory_id").append("<option value=''>-Select-</option>");
                    $.each(res,function(key,value){
                        $("#subcategory_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }else{
                    $("#subcategory_id").empty();
                }
                }
            });

        });
        //  Dynamic Field Add/Remove
        $('.multi-field-wrapper').each(function(){
        var $wrapper = $('.multi-fields', this);
        $('.add-field').click(function(){
            $('.multi-field:first-child').clone(true).appendTo($wrapper).find('input').val('');
        });
        $('.remove-field').click(function(){
            if($('.multi-field', $wrapper).length >1){
                $(this).parent('.multi-field').remove();
            }
        });
    });

    </script>
@endsection

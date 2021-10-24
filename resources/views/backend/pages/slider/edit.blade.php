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
                      <li class="breadcrumb-item"><a href="{{ route('slider.index') }}">Sliders</a></li>
                      <li class="breadcrumb-item active">Create Slider</li>
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
                        <h3 class="card-title">Add Slider</h3>
                   </div>
                   <div class="card-body">
                        <form action="{{ route('slider.update',$slider->id) }}" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-9 my-auto">
                                    <div class="custom-file mb-3">
                                        <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" onchange="document.getElementById('image_preview').src = window.URL.createObjectURL(this.files[0])">
                                        <label class="custom-file-label" for="customFile">Choose Slider Image</label>
                                      </div>
                                      @error('image')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <img id="image_preview" width="300px" src="{{ asset('assets/images/slider-image/'.$slider->image) }}" alt="{{ basicSettings()->site_title }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="name">Enter Title</label>
                                    <input type="text" value="{{ $slider->title }}" name="title" value="{{ old('title') }}" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Title">
                                    @error('title')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="promotions">Promotions</label>
                                    <select name="promotions" id="promotions" class="form-control">
                                        <option value="">Select</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="url">URL</label>
                                    <input type="text" value="{{ $slider->url }}" name="url" class="form-control" placeholder="Enter slider button url">
                                </div>
                                <div class="col-md-12 pt-2">
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save Changes</button>
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
        @if (session('success'))
            toastr["success"]("{{ session('success') }}");
        @elseif(session('error'))
            toastr["error"]("{{ session('error') }}");

        @endif

        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script>
@endsection

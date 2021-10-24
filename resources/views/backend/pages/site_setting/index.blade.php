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
                      <li class="breadcrumb-item active">Basic Settings</li>
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
                        <h3 class="card-title">Basic Settings</h3>
                   </div>
                   <div class="card-body">
                    <form action="{{ route('basic-settings.update',1) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th width='1'>1</th>
                                        <th>Site Title</th>
                                        <th>
                                            <input type="text" value="{{$site_info->site_title}}" name="site_title" class="form-control @error('site_title') is-invalid @enderror">
                                            @error('site_title')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width='1'>1</th>
                                        <th>Logo</th>
                                        <th>
                                            <img width="150px" id="logo_preview" src="{{ asset('assets/images/logo').'/'.$site_info->logo; }}" alt="{{$site_info->logo}}">
                                            <label for="logo" class="btn btn-info ml-3">
                                                <input onchange="document.getElementById('logo_preview').src = window.URL.createObjectURL(this.files[0])" class="d-none"  id="logo" type="file" name="logo">
                                              Change
                                            </label>
                                            @error('logo')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width='1'>2</th>
                                        <th>Icon</th>
                                        <th>
                                            <img width="60px" id="icon_preview" src="{{ asset('assets/images/favicon').'/'.$site_info->icon; }}" alt=" {{$site_info->icon}}">
                                            <label for="icon" class="btn btn-info ml-3">
                                                <input onchange="document.getElementById('icon_preview').src = window.URL.createObjectURL(this.files[0])" class="d-none"  id="icon" type="file" name="icon">
                                              Change
                                            </label>
                                            @error('icon')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width='1'>4</th>
                                        <th>Tagline</th>
                                        <th>
                                            <input type="text" value="{{$site_info->tagline}}" name="tagline" class="form-control @error('tagline') is-invalid @enderror">
                                            @error('tagline')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width='1'>4</th>
                                        <th>Keywords</th>
                                        <th>
                                            <input type="text" value="{{$site_info->key_words}}" name="key_words" class="form-control @error('key_words') is-invalid @enderror">
                                            @error('key_words')
                                                <div class="text-danger">
                                                    <i class="fa fa-exclamation-circle"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width='1'>4</th>
                                        <th>New Registration</th>
                                        <th>
                                            <input type="checkbox" value="2" name="new_registration" @if($site_info->new_registration == 2) checked  @endif >
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width='1'>4</th>
                                        <th>New Login</th>
                                        <th>
                                            <input type="checkbox" value="2" name="new_login" @if($site_info->new_login == 2) checked  @endif >
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i> Save Changes</button>
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

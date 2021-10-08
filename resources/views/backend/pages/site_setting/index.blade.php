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
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th width='1'>1</th>
                                    <th>Logo</th>
                                    <th>
                                        <img width="100px" style="border:1px solid rgba(165, 158, 158, 0.774);padding:3px" src="" alt="">
                                    </th>
                                    <th><a href="#" class="btn btn-info"> <span class="icon-note"></span> Edit</a></th>
                                </tr>
                                <tr>
                                    <th width='1'>2</th>
                                    <th>Icon</th>
                                    <th>
                                        <img width="100px" style="border:1px solid rgba(165, 158, 158, 0.774);padding:3px" src="" alt="">
                                    </th>
                                    <th><a href="#" class="btn btn-info"> <span class="icon-note"></span> Edit</a></th>
                                </tr>
                                <tr>
                                    <th width='1'>4</th>
                                    <th>Description</th>
                                    <th></th>
                                    <th><a href="" class="btn btn-info"> <span class="icon-note"></span> Edit</a></th>
                                </tr>
                            </tbody>
                        </table>
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

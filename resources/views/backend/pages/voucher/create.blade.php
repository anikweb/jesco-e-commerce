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
                      <li class="breadcrumb-item active">Create Voucher  </li>
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
                        <h3 class="card-title"><i class="fa fa-tags"></i> Create Voucher </h3>
                   </div>
                   <div class="card-body">
                    <form action="{{ route('voucher.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <span>*</span> </label>
                                    <input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Voucher Name">
                                    @error('name')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="discount">Discount Range <span>*</span> </label>
                                    <select name="discount"  id="discount" class="form-control @error('discount') is-invalid @enderror">
                                        <option value="">-Select-</option>
                                        @for ($i = 1; $i <= 100; $i++)
                                            <option @if (old('discount') == $i) selected @endif value="{{ $i }}">{{  $i.'%' }}</option>
                                        @endfor
                                    </select>
                                    @error('discount')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expiry_date">Expiry Date <span>*</span> </label>
                                    <input type="date" value="{{ old('expiry_date') }}" name="expiry_date" id="expiry_date" class="form-control @error('expiry_date') is-invalid @enderror">
                                    @error('expiry_date')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="limit">Limit <span>*</span> </label>
                                    <input type="number" name="limit" value="{{ old('limit') }}" id="limit" class="form-control @error('limit') is-invalid @enderror" placeholder="Voucher Limit">
                                    @error('limit')
                                        <div class="text-danger">
                                            <i class="fa fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="min_checkout_price">Minimum Checkout Price</label>
                                    <input type="number" value="{{ old('min_checkout_price') }}" name="min_checkout_price" id="min_checkout_price " class="form-control" placeholder="Enter Minimum Checkout Price">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Voucher</button>
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
    </script>
@endsection

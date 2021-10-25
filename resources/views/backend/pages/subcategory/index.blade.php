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
                      <li class="breadcrumb-item active">Subcategories</li>
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
                        <h3 class="card-title">Subategory List</h3>
                   </div>
                   <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Slug</th>
                                                <th>Category</th>
                                                <th>Created</th>
                                                @if (auth()->user()->can('subcategory edit')||auth()->user()->can('subcategory delete'))
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subcategories as $subcategory)
                                                <tr>
                                                    <td>{{$subcategories->firstItem() + $loop->index }}</td>
                                                    <td>{{ $subcategory->name }}</td>
                                                    <td>{{ $subcategory->slug }}</td>
                                                    <td>{{ $subcategory->category->name }}</td>
                                                    <td>{{ $subcategory->created_at->format('d-M-Y, h:i:s A') }}</td>
                                                    @if (auth()->user()->can('subcategory edit')||auth()->user()->can('subcategory delete'))
                                                        <td>
                                                            @can('subcategory edit')
                                                                <a class="btn btn-info" href="{{ route('subcategory.edit',$subcategory->slug) }}"><i class="fa fa-edit"></i></a>
                                                            @endcan
                                                            @can("subcategory delete")
                                                            <button data-id="{{ $subcategory->id }}" type="submit" class="btn btn-danger subcategory_delete_btn"><i class="fa fa-trash"></i></button>
                                                                <form id="subcategory_delete_form{{$subcategory->id}}" class="d-inline-block" action="{{ route('subcategory.destroy',$subcategory->id) }}" method="POST">
                                                                    @csrf
                                                                    @method("DELETE")
                                                                </form>
                                                            @endcan
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $subcategories->links() }}
                                    </div>
                                </div>
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

        $('.subcategory_delete_btn').click(function(){
            var subcategory_id = $(this).attr('data-id');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: true
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure to delete this category?',
                // text: 'Invoice No:',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {

                // setTimeout(function(){
                    $("#subcategory_delete_form"+subcategory_id).submit();
                // }, 1300);
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'This category steel now active',
                'error',
                )
            }
            })
        });
    </script>
@endsection

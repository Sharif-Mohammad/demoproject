@extends('layouts.backend.app')

@section('title', 'Category')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')

        <div class="container-fluid">
            <div class="block-header">
                {{-- <a class="btn btn-primary waves-effect" href="{{route('admin.address.create')}}">
                    <i class="material-icons">add</i>
                    <span>New Address</span>
                </a> --}}
            </div>
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="singalePageView">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MENU
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{route('admin.menu.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label for="category">Select Menu Position</label>
                                        <select name="menu_position_id" class="form-control">
                                            <option disabled selected="true">Select Option</option>
                                            @foreach($menuPositions as $menuPosition)
                                            <option value="{{$menuPosition->id}}">{{$menuPosition->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label for="category">Select Parent</label>
                                        <select name="parent_id" class="form-control">
                                            
                                            <option disabled selected="true">Select Option</option>
                                            @foreach($menus as $menu)
                                            <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control to-display-name" name="title" required="true">
                                        <label class="form-label">Title</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <label for="category">Select Page</label>
                                        <select name="page_id" class="form-control">
                                            <option disabled selected="true">Select Option</option>
                                            @foreach($pages as $page)
                                            <option value="{{$page->id}}">{{$page->title}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="url" class="form-control" name="url">
                                        <label class="form-label">URL</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" id="display_order" class="form-control" name="display_order" required>
                                        <label class="form-label">Display Order</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="description">
                                        <label class="form-label">Description</label>
                                    </div>
                                </div>

                                <div class="form-group form-float">
                                <input type="checkbox" name="is_active" id="md_checkbox_1" value="1" class="chk-col-red" checked />
                                <label for="md_checkbox_1">IsActive</label>
                                </div>

                                <a href="{{route('admin.menu-position.index')}}" type="button" class="btn btn-danger m-t-15 waves-effect">Back</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>


                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ALL MENU POSITIONS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($menus as $key=>$menu)
                                        <tr>
                                           <td>{{ $key +1 }}</td>
                                           <td>{{ $menu->title }}</td>
                                           <td>
                                               @if($menu->is_active == 1)
                                               
                                               <a href="{{route('admin.unpublished.menu', ['id'=>$menu->id])}}" class="btn btn-danger btn-sm">
                                                 <i class="material-icons">clear</i>
                                               </a>
                                               @else
                                               <a href="{{route('admin.published.menu', ['id'=>$menu->id])}}" class="btn btn-info btn-sm">
                                                 <i class="material-icons">done</i>
                                               </a>
                                               @endif
                                           </td>   
                                           <td class="text-center">
                                                <a href="{{route('admin.menu.edit', $menu->id)}}" class="btn btn-info waves-effect"><i class="material-icons">edit</i></a>

                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteMenu( {{$menu->id}} )"><i class="material-icons">delete</i></button>
                                                <form id="delete-form-{{$menu->id}}" action="{{route('admin.menu.destroy', $menu->id)}}" method="POST" style="display: none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                         @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

@endsection

@push('js')

     <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

    

     <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>

     <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

     <script type="text/javascript">
         function deleteMenu(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
     </script>
@endpush

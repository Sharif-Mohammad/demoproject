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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="pageVue">
                    <div class="card">
                        <div class="header">
                            <h2>
                                MENU POSITIONS
                            </h2>
                        </div>
                        <div class="body">
                            <form action="{{route('admin.menu-position.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control form-display-name" name="name" v-model="model.name" required="true">
                                        <label class="form-label">Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="alias" class="form-control to-display-name" name="alias" v-model="model.alias" >
                                        <label class="form-label">Display Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="code" class="form-control" name="code">
                                        <label class="form-label">Code</label>
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
                                <input type="checkbox" name="is_default" id="md_checkbox_2" value="1" class="chk-col-pink" checked />
                                <label for="md_checkbox_2">IsDefault</label>
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
                                            <th>Default</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Default</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($menuPositions as $key=>$menuPosition)
                                        <tr>
                                           <td>{{ $key +1 }}</td>
                                           <td>{{ $menuPosition->name }}</td>
                                           <td>
                                               @if($menuPosition->is_default == 1)
                                               
                                               <a href="{{route('admin.unpublished.menu-position', ['id'=>$menuPosition->id])}}" class="btn btn-danger btn-sm">
                                                 <i class="material-icons">clear</i>
                                               </a>
                                               @else
                                               <a href="{{route('admin.published.menu-position', ['id'=>$menuPosition->id])}}" class="btn btn-info btn-sm">
                                                 <i class="material-icons">done</i>
                                               </a>
                                               @endif
                                           </td>
                                           <td>
                                               @if($menuPosition->is_active == 1)
                                               
                                               <a href="{{route('admin.unpublished.menu-position.active', ['id'=>$menuPosition->id])}}" class="btn btn-danger btn-sm">
                                                 <i class="material-icons">clear</i>
                                               </a>
                                               @else
                                               <a href="{{route('admin.published.menu-position.active', ['id'=>$menuPosition->id])}}" class="btn btn-info btn-sm">
                                                 <i class="material-icons">done</i>
                                               </a>
                                               @endif 
                                           </td>   
                                           <td class="text-center">
                                                <a href="{{route('admin.menu-position.edit', $menuPosition->id)}}" class="btn btn-info waves-effect"><i class="material-icons">edit</i></a>

                                                <button class="btn btn-danger waves-effect" type="button" onclick="deleteMenuPosition( {{$menuPosition->id}} )"><i class="material-icons">delete</i></button>
                                                <form id="delete-form-{{$menuPosition->id}}" action="{{route('admin.menu-position.destroy', $menuPosition->id)}}" method="POST" style="display: none">
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
        var pageVue = new Vue({
            el: '#pageVue',
            data: {
                model: {
                    name: null,
                    alias: null,
                    code: 0,
                    description: null,
                    is_active: 1,
                    is_default: 0,
                }
            },
            mounted(){
                let app = this;
                $('.form-display-name').change(function(a){let n=$('.form-display-name').val();
                        app.model.alias = n;
                });
            }
        });
    </script>



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
         function deleteMenuPosition(id) {
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

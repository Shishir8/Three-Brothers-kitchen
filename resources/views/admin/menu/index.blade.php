@extends('layouts.app')

@section('title','Menu')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
             <a href="{{ route('menu.create') }}" class="btn btn-primary">Add New</a>
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">All Menu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%"> 
                      <thead class=" text-primary">
                      <th>ID</th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Description</th>
                        <th>Menu Price</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                             @foreach($menus as $key=>$menu)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $menu->menu_title }}</td>
                                            <td>{{ $menu->menu_sub_title }}</td>
                                            <td>{{ $menu->menu_description }}</td>
                                            <td>{{ $menu->menu_price }}</td>
                                            <td>{{ $menu->image }}</td>
                                            <td>{{ $menu->created_at }}</td>
                                            <td>{{ $menu->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('menu.edit',$menu->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                                                <form id="delete-form-{{ $menu->id }}" action="{{ route('menu.destroy',$menu->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $menu->id }}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="material-icons">delete</i></button>
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
        </div>
      </div>
@endsection

@push('scripts')
   
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
          $('#table').DataTable();
      } );
        
    </script>
@endpush
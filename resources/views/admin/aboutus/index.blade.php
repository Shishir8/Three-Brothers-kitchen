@extends('layouts.app')

@section('title','About Us')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
             <a href="{{ route('aboutus.create') }}" class="btn btn-primary">Add New</a>
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">All aboutus</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered" style="width:100%"> 
                      <thead class=" text-primary">
                      <th>ID</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                             @foreach($aboutuss as $key=>$aboutus)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $aboutus->title }}</td>
                                            <td>{{ $aboutus->image }}</td>
                                            <td>{{ $aboutus->created_at }}</td>
                                            <td>{{ $aboutus->updated_at }}</td>
                                            <td>
                                                <a href="{{ route('aboutus.edit',$aboutus->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                                                <form id="delete-form-{{ $aboutus->id }}" action="{{ route('aboutus.destroy',$aboutus->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $aboutus->id }}').submit();
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
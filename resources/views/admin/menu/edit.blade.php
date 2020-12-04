@extends('layouts.app')

@section('title','Edit Menu')

@push('css')
   
@endpush

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
                @include('layouts.partial.msg')
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Edit Menu</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <form method="POST" action="{{ route('menu.update',$menu->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Menu Title</label>
                                    <input type="text" class="form-control" name="menu_title" value="{{ $menu->menu_title }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Menu Sub Title</label>
                                    <input type="text" class="form-control" name="menu_sub_title" value="{{ $menu->menu_sub_title }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Menu Description</label>
                                    <input type="text" class="form-control" name="menu_description" value="{{ $menu->menu_description }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group label-floating">
                                    <label class="control-label">Food Price List</label>
                                    <select id="selectNumber" name ="menu_price" class="form-control" value="{{ $menu->menu_price }}">
                                      <?php
                                        for($i=1; $i<=2000; $i++)
                                        {
                                          ?>
                                          <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                          <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Image</label>
                                <input type="file" name="image">
                            </div>
                        </div>
                        <a href="{{ route('menu.index') }}" class="btn btn-danger">Back</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@push('scripts')
        
    </script>
@endpush
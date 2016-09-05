@extends('layouts.backend')
@section('title', 'Item')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Item
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/item') }}">Item</a></li>
    <li class="active">List</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          
          <br><br>
          <div class="table-responsive">
          <!-- 
            Tambahkan style : table-layout fixed untuk bisa atur width column
             -->
            <table id="datatable" style="table-layout: fixed;" width="150%" class="table table-bordered table-striped table-condensed">
              <thead>
                <tr>
                  <th width="40%">Model</th>
                  <th width="10%">Size</th>
                  <th width="10%">Color</th>
                  <th width="10%">Stok</th>
                  <th width="10%">Normal Price</th>
                  <th width="10%">Reseller Price</th>
            
                  <th width="10%">Actions</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                <th>Model</th>
                <th>Size</th>
                <th>Color</th>
                <th>Stok</th>
                <th>Normal Price</th>
                <th>Reseller Price</th>
                
                <th></th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div class="btn-group">
            <a href="{{ url('item/create') }}" class="btn btn-primary">
            <i class="fa fa-plus fa-fw"></i> Add
            </a>
          </div>
</section>
<!-- /.content -->
@include('item.partials.add_modal')
<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){
itemModule.init();
});
</script>
@endsection
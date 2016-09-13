@extends('layouts.backend')
@section('title', 'Reports')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Sales Report
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Report</a></li>
    <li><a href="{{ url('/report') }}">Sales</a></li>
    <li class="active">List</li>
  </ol>
</section>
<!-- Main content -->
<form action="{{ url('transaction') }}" method="post" id="print">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
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
            <table id="datatable" style="table-layout: fixed;" width="100%" class="table table-bReturned table-striped table-condensed">
              <thead>
                <tr>
                  
                  <th>Name</th>
                  <th>Address</th>
                  <th>Source</th>
                  <th class="sum">Total</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                  
                  <th>Name</th>
                  <th>Address</th>
                  <th>Source</th>
                  <th>Total</th>
                  <th>Created at</th>
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
</section>
</form>
<!-- /.content -->
<!-- page script -->

<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){
reportModule.init();
});
</script>

@endsection
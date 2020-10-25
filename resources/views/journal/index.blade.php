@extends('layouts.backend')
@section('title', 'Journal')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Transaction
  <small>List</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Master</a></li>
    <li><a href="{{ url('/journal') }}">Journal</a></li>
    <li class="active">List</li>
  </ol>
</section>
<!-- Main content -->
<form action="{{ url('journal') }}" method="post" id="print">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <div class="btn-group">
            <a href="{{ url('transaction/create') }}" class="btn btn-primary">
            <i class="fa fa-plus fa-fw"></i> Add
            </a>
          </div>
          <div class="btn-group">
            <!-- <a href="{{ url('transaction/print') }}" class="btn btn-warning">
            <i class="fa fa-plus fa-fw"></i> Print
            </a>
 -->
            <button type="button" id="printTransaction" class="btn btn-warning" name="print" value="Print"><i class="fa fa-check fa-fw"></i> Print</button>
          </div>

          <br><br>
          <div class="table-responsive">
            <!--
            Tambahkan style : table-layout fixed untuk bisa atur width column
            -->
            <table id="datatable" style="table-layout: fixed;" width="100%" class="table table-bReturned table-striped table-condensed">
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Source</th>
                  <th>Total</th>
                  <th>Total Margin</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
              <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Source</th>
                  <th>Total</th>
                  <th>Total Margin</th>
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
<script type="text/javascript">

</script>
@endsection
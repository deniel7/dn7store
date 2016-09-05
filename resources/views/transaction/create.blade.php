@extends('layouts.backend')
@section('title', 'Transactions')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Transaction
  <small>Create</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Transaction</a></li>
    <li><a href="{{ url('/transaction') }}">Transaction</a></li>
    <li class="active">Create</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
@include('transaction/partials/new_row')
  <form action="{{ url('transaction') }}" method="post">
    <div class="box">
      <div class="box-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" value="{{ old('name') }}" class="text-left form-control">
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Phone</label>
              <input type="text" name="phone" value="{{ old('phone') }}" class="text-right form-control">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Address</label>
             <textarea class="form-control hresize" name="address">{{ old('address') }}</textarea>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Source</label>
             <input type="text" name="source" class="text-left form-control" value="{{ old('source') }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group text-right">
              
              <input name="jne_yes" type="checkbox" value="1"><label>&nbsp JNE YES</label>
            </div>
          </div>
          </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name Pengirim</label>
              <input type="text" name="name_pengirim" value="{{ old('name_pengirim') }}" class="text-left form-control">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Phone Pengirim</label>
              <input type="text" name="phone_pengirim" value="{{ old('phone_pengirim') }}" class="text-right form-control">
            </div>
          </div>
        </div>

        
</div>

<div class="box">
<div class="box-body">
  <h4>Add Items</h4>
  <button type="button" class="btn btn-success" onclick="transactionModule.addItem();"><i class="fa fa-plus fa-fw"></i> Add</button>
  <br><br>
  <table id="item_table" style="table-layout: fixed;" width="100%" class="table table-bordered table-striped table-condensed">
    <thead>
      <tr>
        <th class="text-center">Item</th>
        <th class="text-center">Quantity</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <tr>
          <td>
          <select name="product_ids[]" class="product_ajax form-control"></select>
        </td>
        <td>
          <input type="number" name="product_quantities[]" class="text-right form-control">
        </td>
        <td class="text-center">
          <button class="btn btn-danger" onClick="transactionModule.removeItem($(this));"><i class="fa fa-trash fa-fw"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
  <br>
  <div class="row">
    <div class="col-md-6">
      <a role="button" href="{{ url('transaction') }}" class="btn btn-info"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
    </div>
    <div class="col-md-6 text-right">
      <div class="btn-group">
        <button class="btn btn-primary" id="haloo"><i class="fa fa-send fa-fw"></i> Save</button>
      </div>
    </div>
  </div>
</div>
</section>
</form>
<!-- /.content -->
<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){
transactionModule.init();
});
</script>
@endsection
@extends('layouts.backend')
@section('title', 'Edit - Transaction')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Transaction
  <small>Edit</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/') }}"><i class="fa fa-tachometer"></i> Dashboard</a></li>
    <li><a href="#">Transaction</a></li>
    <li><a href="{{ url('/transaction') }}">Transaction</a></li>
    <li class="active">List</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <form action="{{ url('transaction').'/'.$transaction->id }}" method="post">
            <input name="_method" type="hidden" value="put">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" id="name"  name="name" value="{{ $transaction->name }}">
              
          </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Phone</label>
              <input type="text" class="form-control" id="phone"  name="phone" value="{{ $transaction->phone }}">
          </div>
          </div>
        </div>
        <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Address</label>
           <textarea class="form-control hresize" name="address">{{ $transaction->address }}</textarea>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label>Source</label>
            <input type="text" class="form-control" id="source"  name="source" value="{{ $transaction->source }}">

          </div>
        </div>
        </div>


        
    <div class="col-lg-12">
    <table id="item_table" style="table-layout: fixed;" width="100%" class="table table-bordered table-striped table-condensed">
        <thead>
          <tr>
            <th class="text-center">Product</th>
            <th class="text-center">Quantity</th>
            <th class="text-right">Subtotal</th>
          </tr>
        </thead>
        <tbody>
        @foreach($transaction_detail as $transaction_detail)
        <tr>
          <td>{{ App\Item::find($transaction_detail->item_id)->model }} - {{ App\Item::find($transaction_detail->item_id)->size }}</td>
          <td><span class="pull-right">{{ $transaction_detail->qty }}</span></td>
          <td><span class="pull-right">{{ number_format($transaction_detail->subtotal ,0,".",",") }}</span></td>
        </tr>
        @endforeach
        <tr>
        <td colspan="2" class="text-right"><b>Total</b></td>
        <td class="text-right">{{ number_format($transaction->total ,0,".",",") }}</td>
        </tr>
        
        </tbody>
        </table>

        </div>
        
            
          </div>
        </form>
        <!-- /.box-body -->
      
        


      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  
  <div class="box">
    <div id="new_row" style="display: none;">
      <table>
        <tbody>
          <tr>
            <td>
            <select name="product_ids[]" class="form-control"></select>
          </td>
          <td>
            <input type="number" value="" name="product_quantities[]" class="text-right form-control">
          </td>
          <td class="text-center">
            <button class="btn btn-danger" onClick="supplierReturnModule.removeItem($(this));"><i class="fa fa-trash fa-fw"></i></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
    <div class="row">
      <div class="col-md-2">
        <a role="button" href="{{ url('transaction') }}" class="btn btn-info"><i class="fa fa-chevron-left fa-fw"></i> Back</a>
      </div>
      <div class="col-md-10 text-right">
        <button type="button" class="btn btn-primary" id="saveItem">Save</button>
        
      </div>
    </div>
  </div>
</div>
</section>
<!-- /.content -->
<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){
transactionModule.init();
});
</script>
@endsection
@extends('layouts.print')

@section('content')
@foreach ($transactions as $transaction)
@if(empty($transaction->name_pengirim))
<table style="table-layout: fixed; color:blue !important;" width="50%" class="table">
<tr>
    <td style="width:10%"><img src="{{ asset('images/logo.jpg') }}" alt="User Image"></td>
    <td><h3>Thanks for Shoping!</h3></td>
    <td>
    
        <table class="table table-bordered table-striped table-condensed">
        <tr>
            <td>www.dn7store.com</td>
            <td>www.tokopedia.com/dn7</td>
            <td>www.bukalapak.com/dn7</td>
        </tr>
        <tr>
            <td>LINE : dn7store</td>
            <td></td>
            <td>IG : @d_niel7</td>
        </tr>
        </table>
    </td>
</tr>
</table> 
@endif

<table style="table-layout: fixed; color:blue !important" width="50%" class="table table-bordered table-striped table-condensed">
        <tr>
            <td>Kode Booking</td>
            <td>{{ $transaction->job }}</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>{{ $transaction->name }}</td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>{{ $transaction->phone }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>{{ $transaction->address }}</td>
        </tr>
        <tr>
        <td>Kurir</td>
        <td>{{ $transaction->jne }}</td>
        </tr>

        @foreach ($transaction->details as $detail) 
        <tr>
            <td>{{ App\Item::find($detail->item_id)->model }} - {{ App\Item::find($detail->item_id)->size }}</td>
            <td>{{ $detail->qty }}</td>
        </tr>
        
        @endforeach
        @if(empty($transaction->name_pengirim))
        <tr>
            <td>Pengirim</td>
            <td>DN7STORE</td>
        </tr>
        @else
        <tr>
            <td>Pengirim</td>
            <td>{{ $transaction->name_pengirim }} {{ $transaction->phone_pengirim }}</td>
        </tr>
        @endif
</table>
<table style="table-layout: fixed; color:blue !important;" width="50%" class="table">
<tr>
    <td style="width:10%"></td>
    <td></td>
    <td>
    
        <table class="table table-bordered table-striped table-condensed">
            <tr>
                <td colspan="2"><p>Dapatkan info Promo Diskon menarik kami di</p></td>
            </tr>
        <tr>

            <td>LINE : @dn7store</td>
            <td><img src="{{ asset('images/line.png') }}" alt="User Image" width="20%">Scan disini</td>
            
        </tr>
        <tr>
            <td>Instagram</td>
            <td>@dn7store</td>
        </tr>
        </table>
    </td>
</tr>
</table>
<hr>
@endforeach
@endsection
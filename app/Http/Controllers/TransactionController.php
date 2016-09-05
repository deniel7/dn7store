<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionDetail;
use App\Item;
use Datatables;
use DB;
use Flash;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        return view('transaction.index');
    }

    public function datatable()
    {
        $items = DB::table('transactions')
        ->select(['id', 'name', 'address', 'source', 'total', 'created_at']);

        return Datatables::of($items)
        ->addColumn('check', '<input type="checkbox" name="selected_transactions[]" value="{{ $id }}">')
        ->editColumn('name', '{{ $name }}')
        ->editColumn('address', '<span class="pull-right">{{ $address }}</span>')
        ->editColumn('source', '<span class="pull-center"><b>{{ $source }}</b></span>')
        ->editColumn('total', '<span class="pull-right">{{ number_format($total,0,".",",") }}</span>')
        ->editColumn('created_at', '<span class="pull-right">{{ $created_at }}</span>')
        ->addColumn('action', function ($item) {
            $html = '<div style="width: 70px; margin: 0px auto;" class="text-center btn-group btn-group-justified" role="group">';
            $html .= '<a role="button" class="btn btn-danger" href="transaction/'.$item->id.'/edit"><i class="fa fa-fw fa-eye"></i></a>';
            $html .= '</div>';

            return $html;
        })
        ->make(true);
    }

    public function create()
    {
        return view('transaction/create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $quantities = $request->input('product_quantities');
        $product_ids = $request->input('product_ids');
        $i = 0;
        //dd($request->input());

         $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'source' => 'required',
            'product_ids' => 'required',
            'product_quantities' => 'required',
         ]);

         if ($validator->fails()) {
             return redirect('transaction/create')
                        ->withErrors($validator)
                        ->withInput();
            }

            DB::beginTransaction();
            $transaction = new Transaction();
            $transaction->name = $request->input('name');
            $transaction->address = $request->input('address');
            $transaction->source = $request->input('source');
            $transaction->total = 0;
            $transaction->phone = $request->input('phone');
            $transaction->name_pengirim = $request->input('name_pengirim');
            $transaction->phone_pengirim = $request->input('phone_pengirim');
            $transaction->save();

            try {
                $total = 0;
                foreach ($product_ids as $product_id) {
                    $items = Item::where('id', '=', $product_ids[$i])->get();
                    if ($items->count() == 1) {
                        $item = $items->first();
                        $transaction_detail = new TransactionDetail();
                        $transaction_detail->item_id = $product_ids[$i];
                        $transaction_detail->transaction_id = $transaction->id;
                        $transaction_detail->qty = $quantities[$i];

                        if (empty($transaction->name_pengirim)) {
                            $transaction_detail->subtotal = $quantities[$i] * $item->normal_price;
                        } else {
                            $transaction_detail->subtotal = $quantities[$i] * $item->reseller_price;
                        }

                        $item->stok -= $quantities[$i];
                        $item->save();

                        $total += $transaction_detail->subtotal;

                        $transaction_detail->save();
                        ++$i;
                    }
                }

                $transaction->total = $total;
                $transaction->save();

                DB::commit();
                Flash::success('Saved');
            } catch (\Exception $e) {
                Flash::error('Unable to save');
                DB::rollback();
            }

            return redirect('transaction');
    }

    public function edit($id)
    {
        $data['transaction'] = Transaction::find($id);
        $data['transaction_detail'] = TransactionDetail::where('transaction_id', '=', $id)->get();

        return view('transaction/edit', $data);
    }

    // public function postPrint(Request $request)
    // {
    //     $transaction_ids = $request->input('selected_transactions');
    //     $i = 0;
    //     //dd($transaction_ids);
    //     foreach ($transaction_ids as $transaction_id) {
    //         $transactions = Transaction::where('id', '=', $transaction_ids[$i])->get();
    //         if ($transactions->count() == 1) {
    //             $transaction = $transactions->first();

    //             //dd($transaction);
    //             $transaction_detail = TransactionDetail::where('transaction_id', '=', $transaction_ids[$i])->get();

    //             dd($transaction_detail);
    //                     // $transaction_detail->item_id = $product_ids[$i];
    //                     // $transaction_detail->transaction_id = $transaction->id;
    //                     // $transaction_detail->qty = $quantities[$i];
    //                     // $transaction_detail->subtotal = $quantities[$i] * $item->normal_price;

    //                     // $item->stok -= $quantities[$i];
    //                     // $item->save();

    //                     // $total += $transaction_detail->subtotal;

    //                     // $transaction_detail->save();
    //                     ++$i;
    //                     //dd($transaction_detail);
    //         }
    //     }

    //     return view('transaction/print');
    // }

    public function printDoc(Request $request)
    {
        $transaction_ids = $request->input('selected_transactions');

        $data['transactions'] = Transaction::whereIn('id', $transaction_ids)->get();

        return view('transaction/print', $data);
    }
}

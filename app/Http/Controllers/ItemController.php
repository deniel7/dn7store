<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Item;
use Datatables;
use Flash;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        return view('item.index');
    }

    public function datatable()
    {
        $items = DB::table('items')
        ->select(['items.id', 'items.model', 'items.size', 'items.color', 'items.stok', 'items.normal_price', 'items.reseller_price']);

        return Datatables::of($items)

        ->editColumn('size', '<span class="pull-right">{{ $size }}</span>')
        ->editColumn('normal_price', '<span class="pull-right">{{ number_format($normal_price,0,".",",") }}</span>')
        ->editColumn('reseller_price', '<span class="pull-right">{{ number_format($reseller_price,0,".",",") }}</span>')
        ->editColumn('color', '{{ strtoupper($color) }}')
        ->addColumn('action', function ($item) {
            $html = '<div style="width: 70px; margin: 0px auto;" class="text-center btn-group btn-group-justified" role="group">';
            $html .= '<a role="button" class="btn btn-warning" href="item/'.$item->id.'/edit"><i class="fa fa-fw fa-pencil"></i> EDIT</a>';
            $html .= '</div>';

            return $html;
        })
        ->make(true);
    }

    public function create()
    {
        // $data['brands'] = Brand::select('id', 'code', 'name')
        // ->get();

        return view('item/create');
    }

    public function store(Request $request)
    {
        $normal_price = str_replace(',', '', $request->input('normal_price'));
        $normal_price_ = str_replace('Rp', '', $normal_price);
        $reseller_price = str_replace(',', '', $request->input('reseller_price'));
        $reseller_price_ = str_replace('Rp', '', $reseller_price);
        $buy_price = str_replace(',', '', $request->input('buy_price'));
        $buy_price_ = str_replace('Rp', '', $buy_price);

        $validator = Validator::make($request->all(), [
            'model' => 'required',
            'size' => 'required',
            'color' => 'required',
            'stok' => 'required|numeric',
            'normal_price' => 'required',
            'reseller_price' => 'required',
            'buy_price' => 'required',
         ]);

        if ($validator->fails()) {
            return redirect('item/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $item = new Item();
        $item->model = $request->input('model');
        $item->size = $request->input('size');
        $item->color = $request->input('color');
        $item->stok = $request->input('stok');

        $item->normal_price = $normal_price_;
        $item->reseller_price = $reseller_price_;
        $item->buy_price = $buy_price_;
        //dd($item->normal_price);
        $item->save();

        DB::commit();
        Flash::success('Saved');

        return redirect('item');
    }

    public function edit(Item $item)
    {
        return view('item/edit', compact('item'));
    }

    public function update(Item $item, Request $request)
    {
        /* Form Validation */
        $this->validate($request, [
        'model' => 'required',
        'stok' => 'required',
        'size' => 'required',
        'color' => 'required',
        'normal_price' => 'required',
        'reseller_price' => 'required',
        ]);

        $normal_price = str_replace(',', '', $request->input('normal_price'));
        $normal_price_ = str_replace('Rp', '', $normal_price);
        $reseller_price = str_replace(',', '', $request->input('reseller_price'));
        $reseller_price_ = str_replace('Rp', '', $reseller_price);
        $buy_price = str_replace(',', '', $request->input('buy_price'));
        $buy_price_ = str_replace('Rp', '', $buy_price);
        $stok = $request->input('stok');
        $model = strtoupper($request->input('model'));
        $size = $request->input('size');
        $color = $request->input('color');

        $item->normal_price = $normal_price_;
        $item->reseller_price = $reseller_price_;
        $item->buy_price = $buy_price_;
        $item->stok = $stok;
        $item->model = $model;
        $item->size = $size;
        $item->color = $color;
        $item->save();

        Flash::success('Saved');
        DB::commit();

        return redirect('item/');
    }

    public function select2(Request $request)
    {
        /* Buat Keyword pencarian menjadi haruf besar semua dulu
         * supaya sesuai di database
         */
        $term = strtoupper($request->term);
        $brand_id = $request->input('brand_id');

        /* Jika tidak ada keyword, maka tampilkan biasa */
        if (is_null($term)) {
            $items = Item::select(['id', 'model', 'size', 'color'])->get();
        } else {
            // Jika ada keyword, buat conditional yang mencari model atau code
            $items = Item::select(['id', 'model', 'size', 'color'])
            ->where('model', 'like', '%'.$term.'%')
            ->orWhere('size', 'like', '%'.$term.'%');

            $items = $items->get();
        }

        /* return dalam bentuk JSON */
        return response()->json($items);
    }
}

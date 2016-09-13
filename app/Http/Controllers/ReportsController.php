<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use Datatables;
use DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('report/index');
    }

    public function datatable()
    {
        $items = DB::table('transactions')
        ->select(['id', 'name', 'address', 'source', 'total', 'created_at']);

        return Datatables::of($items)
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;

class JournalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('journal.index');
    }

    public function datatable()
    {
        $items = DB::table('journal')
        ->select(['id', 'debit', 'kredit', 'saldo', 'created_at'])
        ->orderBy('id', 'desc');

        return Datatables::of($items)
        ->addColumn('check', '<input type="checkbox" name="selected_transactions[]" value="{{ $id }}">')
        ->editColumn('debit', '{{ $debit }}')
        ->editColumn('kredit', '<span class="pull-right">{{ $kredit }}</span>')
        ->editColumn('saldo', '<span class="pull-center"><b>{{ $saldo }}</b></span>')
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

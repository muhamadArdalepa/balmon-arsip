<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class DataSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function masuk()
    {
        $surats = SuratMasuk::orderBy('id', 'desc')->get();

        return datatables()
            ->of($surats)
            ->addColumn('action', function ($surat) {
                return view('components.datatable-action-btn')->with('data', $surat);
            })
            ->addIndexColumn()
            ->make(true);
    }
}

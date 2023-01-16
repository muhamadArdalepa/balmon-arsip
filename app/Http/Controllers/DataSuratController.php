<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class DataSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function semua()
    {
        $surats = Surat::orderBy('id', 'desc')->get();

        return datatables()
            ->of($surats)
            ->addColumn('action', function ($surat) {
                return view('components.datatable-action-btn')->with('data', $surat);
            })
            ->editColumn('jenis', function ($surat) {
                return $surat->jenis == 1 ? 'Surat&nbsp;Masuk' : 'Surat&nbsp;Keluar';
            })
            ->editColumn('tanggal', function ($surat) {
                return str_replace(' ', '&nbsp;', date('d M Y', strtotime($surat->tanggal)));
            })
            ->rawColumns(['jenis', 'tanggal'])
            ->addIndexColumn()
            ->make(true);
    }
    public function masuk()
    {
        $surats = Surat::where('jenis', 1)->orderBy('id', 'desc')->get();

        return datatables()
            ->of($surats)
            ->addColumn('action', function ($surat) {
                return view('components.datatable-action-btn')->with('data', $surat);
            })
            ->editColumn('tanggal', function ($surat) {
                return str_replace(' ', '&nbsp;', date('d M Y', strtotime($surat->tanggal)));
            })
            ->rawColumns(['jenis', 'tanggal'])
            ->addIndexColumn()
            ->make(true);
    }
}

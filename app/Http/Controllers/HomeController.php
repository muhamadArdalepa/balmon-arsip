<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $count_masuk = Surat::where('jenis',1)->count();
        $count_keluar = Surat::where('jenis',2)->count();
        return view('home',compact('count_masuk','count_keluar'));
    }
}

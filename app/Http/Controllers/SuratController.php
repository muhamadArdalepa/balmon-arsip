<?php

namespace App\Http\Controllers;

use Embed\Embed;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function masuk()
    {
        return view('surat.masuk');
    }
    public function keluar()
    {
    }
    public function show($id)
    {
        $surat = Surat::find($id);;
        $fileUrl = '/' . $surat->file; // Path to your file
        $fileExtension = pathinfo($fileUrl, PATHINFO_EXTENSION);


        return view('surat.show', compact('surat', 'fileUrl','fileExtension'));
    }
    function create($jenis)
    {
        return view('surat.form')
            ->with([
                'role' => 'create',
                'jenis' => $jenis,
                'kasubags' => \App\Models\Kasubag::all(),
            ]);
    }
    function store(Request $request, $jenis)
    {
        $jenis = $jenis == 'Masuk' ? 1 : 2;
        $validate_data = $request->validate([
            'nomor' => 'required',
            'from_or_to' => 'required|min:3',
            'perihal' => 'required|min:3',
            'kasubag_id' => 'required',
            'tanggal' => 'required',
            'file' => ['required', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:12288'], // 12 * 1024
        ]);
        $validate_data['jenis'] = $jenis;
        if ($request->file('file')) {
            $path = $request->file('file')->store('public/surat');
            $path = \Illuminate\Support\Str::replaceFirst('public', 'storage', $path);
        }
        $validate_data['file'] = $path;
        $validate_data['status'] = 'Menunggu tindakan';
        if (!Surat::create($validate_data)) {
            return back();
        }

        $request->session()->flash('status', 'Surat masuk berhasil ditambah!');
        return redirect()->route('surat-masuk');
    }
    public function disposisi(Request $request, $id) {
        $surat = Surat::find($id);
        $surat->status = 'Sudah didisposisikan';
        $surat->save();
        $request->session()->flash('status', 'Surat dengan nomor '.$surat->nomor.' '.$surat->status.' ke '.$surat->kasubag->nama);
        return redirect(route('surat-masuk'));
    }
    public function terima(Request $request, $id) {
        $surat = Surat::find($id);
        $surat->status = 'Sudah diterima oleh kasubag';
        $surat->save();
        $request->session()->flash('status', 'Surat dengan nomor '.$surat->nomor.' '.$surat->status);
        return redirect(route('surat-masuk'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('surat.index')->with([
            'page' => 'surat',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('surat.form')->with([
            'page' => 'surat',
            'role' => 'create',
            'jenis' => ['Surat Masuk', 'Surat Keluar'],

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate_data = $request->validate([
            'nomor' => 'required',
            'from_or_to' => 'required|min:3',
            'perihal' => 'required|min:3',
            'tanggal' => 'required',
            'jenis' => 'required',
            'file' => ['required', File::types(['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'])->max(12 * 1024)]
        ]);
        if ($request->file('file')) {
            $validate_data['file'] = $request->file('file')->store('surat');
        }
        Surat::create($validate_data);
        $request->session()->flash('status', 'Surat masuk berhasil ditambah!');
        return redirect()->route('surat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Surat $surat)
    {
        return view('surat.show')->with([
            'page' => 'surat',
            'surat' => $surat,
            'thumb' =>  in_array(pathinfo($surat->file, PATHINFO_EXTENSION), ['png', 'jpg', 'jpeg'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Surat $surat)
    {
        return view('surat.form')->with([
            'page' => 'surat',
            'role' => 'edit',
            'jenis' => ['Surat Masuk', 'Surat Keluar'],
            'surat' => $surat
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surat $surat)
    {
        $validate_data = $request->validate([
            'nomor' => 'required',
            'from_or_to' => 'required|min:3',
            'perihal' => 'required|min:3',
            'tanggal' => 'required',
            'jenis' => 'required',
            'file' => File::types(['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'])->max(12 * 1024)
        ]);
        if ($request->hasFile('file')) {
            $validate_data['file'] = $request->file('file')->store('surat');
            Storage::delete($surat->file);
        }
        $surat->update($validate_data);
        $request->session()->flash('status', 'Surat berhasil diedit!');
        return redirect()->route('surat.index');
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

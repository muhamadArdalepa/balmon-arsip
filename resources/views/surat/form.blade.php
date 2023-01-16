@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ $role=='create'?'Tambah
                    Surat':'Edit Surat'}}
                </div>
                <div class="card-body">
                    <form class="row g-3 need-validation" action="
                    @if ($role=='create')
                        {{route('surat.store')}}
                    @else
                        {{route('surat.update',$surat->id)}}
                    @endif
                    " method="post" novalidate enctype="multipart/form-data">
                        @if ($role=='edit')
                        {{ method_field('PUT') }}
                        @endif
                        @csrf
                        <div class="col-lg-4">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="File" class="form-control @error('file') is-invalid @enderror" id="file"
                                name="file">
                            @error('file')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8">
                            <label for="nomor" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror" id="nomor"
                                name="nomor" value="{{
                                    $role=='edit'?$surat->nomor:old('nomor')
                                }}">
                            @error('nomor')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-lg-4">
                            <label for="pengirim" class="form-label">Jenis</label>
                            <select class="form-control  @error('jenis') is-invalid @enderror" id="jenis" name="jenis"
                                onchange="changeFoTLabel()">
                                <option disabled selected>-- Jenis Surat --</option>
                                @foreach ($jenis as $index => $item)
                                <option value="{{$index+1}}" {{$role=='edit' ?($surat->
                                    jenis==$index+1?'selected':null):(old('jenis')==$index+1?'selected':null)}}>{{$item}}
                                </option>
                                @endforeach
                            </select>
                            @error('jenis')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8">
                            <label for="from_or_to" class="form-label">Pengirim/Penerima</label>
                            <input type="text" class="form-control @error('from_or_to') is-invalid @enderror"
                                name="from_or_to" value="{{
                                    $role=='edit'?$surat->from_or_to:old('from_or_to')
                                }}" required>
                            @error('from_or_to')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                name="tanggal" required value="{{
                                    $role=='edit'? date('Y-m-d', strtotime($surat->tanggal)):old('tanggal')??date_format(now(),'Y-m-d')
                                }}">
                            @error('tanggal')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-lg-8">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" class="form-control @error('perihal') is-invalid @enderror"
                                name="perihal" value="{{
                                    $role=='edit'?$surat->perihal:old('perihal')
                                }}" required>
                            @error('perihal')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    if ($('#jenis').val()!=null) {   
        $('label[for="from_or_to"]').text($('#jenis').val()==1?'Pengirim':'Penerima')
    }
    function changeFoTLabel() {
        $('label[for="from_or_to"]').text($('#jenis').val()==1?'Pengirim':'Penerima')
    }
</script>
@endpush
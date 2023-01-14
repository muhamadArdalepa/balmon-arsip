@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Surat Masuk')
                    }}
                </div>
                <div class="card-body">
                    <form class="row g-3 need-validation" method="post" action="{{route('surat-masuk.store')}}"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-4">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="File" class="form-control @error('file') is-invalid @enderror " id="file"
                                name="file">
                            @error('file')
                            <div id="file-feedback" class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-lg-8">
                            <label for="nomor" class="form-label">Nomor Surat</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror " id="nomor"
                                name="nomor" value="{{old('tanggal')}}">
                            @error('nomor')
                            <div id="nomor-feedback" class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('field') is-invalid @enderror" name="tanggal"
                                value="{{old('tanggal')}}" required>
                            @error('record')
                            <div class="invalid-feedback"></div>
                            @enderror
                        </div>
                        <div class="col-lg-8">
                            <label for="pengirim" class="form-label">Pengirim</label>
                            <input type="text" class="form-control @error('field') is-invalid @enderror" name="pengirim"
                                value="{{old('pengirim')}}" required>
                            @error('record')
                            <div class="invalid-feedback"></div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" class="form-control @error('field') is-invalid @enderror" name="perihal"
                                value="{{old('perihal')}}" required>
                            @error('record')
                            <div class="invalid-feedback"></div>
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
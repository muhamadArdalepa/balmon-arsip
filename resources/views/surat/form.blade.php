@extends('layouts.app')
@push('css')@endpush
@section('content')
<h1 class="mt-4 col-lg-6 offset-lg-3">Tambah Surat {{$jenis}}</h1>

<div class="card mb-4 col-lg-6 offset-lg-3">
    <div class="card-body">
        <form class="row g-3 need-validation" action="
                            @if ($role=='create')
                                {{route('surat.store',$jenis)}}
                            @else
                                {{route('surat.update',$surat->id)}}
                            @endif
                            " method="post" novalidate enctype="multipart/form-data">
            {{ $role == 'edit' ? method_field('PUT') : '' }}
            @csrf
            <div class="col-lg-4">
                <label for="file" class="form-label">Upload File</label>
                <input type="File" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                @error('file')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-lg-8">
                <label for="nomor" class="form-label">Nomor Surat</label>
                <input type="text" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor"
                    value="{{$role=='edit'?$surat->nomor:old('nomor')}}">
                @error('nomor')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col-lg-8">
                <label for="from_or_to" class="form-label">{{$jenis == 'Masuk' ? 'Pengirim' : 'Penerima'}}</label>
                <input type="text" class="form-control @error('from_or_to') is-invalid @enderror" name="from_or_to"
                    value="{{
                                            $role=='edit'?$surat->from_or_to:old('from_or_to')
                                        }}" required>
                @error('from_or_to')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col-lg-4">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" required
                    value="{{
                                            $role=='edit'? date('Y-m-d', strtotime($surat->tanggal)):old('tanggal')??date_format(now(),'Y-m-d')
                                        }}">
                @error('tanggal')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col-lg-12">
                <label for="perihal" class="form-label">Perihal</label>
                <input type="text" class="form-control @error('perihal') is-invalid @enderror" name="perihal"
                    value="{{$role=='edit'?$surat->perihal:old('perihal')}}" required>
                @error('perihal')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            @if($jenis == 'Masuk')
            <div class="col-lg-12">
                <label for="kasubag_id" class="form-label">Disposisikan ke</label>
                <Select class="form-control" name="kasubag_id" id="kasubag_id">
                    <option selected disabled>-- Pilih Kasubag</option>
                    @foreach($kasubags as $kasubag)
                    <option value="{{$kasubag->id}}">{{$kasubag->nama}}</option>
                    @endforeach
                </Select>
                @error('kasubag_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            @endif

            <div class="col-12 text-end">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')

@endpush
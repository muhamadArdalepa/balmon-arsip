@php
use Carbon\Carbon;
use Embed\Embed;
@endphp

@extends('layouts.app')
@push('css')
<style>
    .list-group-item {
        background-color: transparent !important;
    }
</style>
@endpush
@section('content')
<h1 class="mt-4">Detail Surat {{$surat->nomor}}</h1>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                Preview Surat
            </div>
            <div class="card-body">
                @if($fileExtension === 'pdf' || $fileExtension === 'docx')
                {{-- Preview for PDF and DOCX files --}}
                <iframe src="{{ $fileUrl }}" width="100%" height="600px"></iframe>
                @elseif($fileExtension === 'jpg' || $fileExtension === 'jpeg' || $fileExtension === 'png')
                {{-- Preview for image files --}}
                <img src="{{ $fileUrl }}" alt="Preview">
                @else
                {{-- Fallback message for unsupported file types --}}
                <p>Unsupported file type</p>
                @endif

            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                Detail Surat
            </div>
            <div class="card-body p-0 overflow-hidden">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Nomor</div>
                            <div class="col">{{$surat->nomor}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">{{$surat->jenis == 1 ? 'Pengirim' : 'Penerima'}}</div>
                            <div class="col">{{$surat->from_or_to}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Perihal</div>
                            <div class="col">{{$surat->perihal}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Tanggal</div>
                            <div class="col">{{ Carbon::parse($surat->tanggal)->isoFormat('D MMMM Y') }}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Diupload Pada</div>
                            <div class="col">{{ Carbon::parse($surat->created_at)->diffForHumans()}}</div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-4">Diubah Pada</div>
                            <div class="col">{{ $surat->created_at == $surat->updated_at ? '-' :
                                (Carbon::parse($surat->updated_at)->diffForHumans() )}}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

@endsection
@push('js')

@endpush
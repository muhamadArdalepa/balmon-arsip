@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                @if ($thumb)
                <div class="card-img-top"
                    style="width: 100%;height: 300px;  background: transparent url('{{asset('storage/'.$surat->file)}}') no-repeat center ;background-size: cover">
                </div>
                @else
                <div class="card-img-top bg-secondary d-flex justify-content-center align-items-center"
                    style="width: 100%;height: 300px; ;background-size: cover">
                    <h1 class="text-white">No Preview Available</h1>
                </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $surat->nomor }}</h5>
                    <p class="card-text"><span class="text-muted">{{$surat->jenis==1?'Pengirim':'Penerima'}} : </span>
                        <a href="#" class="fw-bold"> {{$surat->from_or_to}}</a>
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$surat->perihal}}</li>
                    <li class="list-group-item">{!!str_replace(' ', '&nbsp;', date('d F Y',
                        strtotime($surat->tanggal)))!!}</li>
                </ul>
                <div class="card-body d-flex justify-content-between">
                    <div class="">
                        <a href="{{route('surat.destroy',$surat->id)}}" class="card-link btn btn-danger">
                            <i class="fa-solid fa-trash"></i>
                            Hapus
                        </a>
                        <a href="{{route('surat.edit',$surat->id)}}" class="card-link btn btn-warning">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </a>
                    </div>
                    <div class="">
                        <a href="{{asset('storage/'.$surat->file)}}" class="card-link btn btn-primary">
                            <i class="fas fa-eye"></i>
                            Baca
                        </a>
                        <a href="{{route('download',$surat->file)}}" class="card-link btn btn-success">
                            <i class="fa-solid fa-download"></i>
                            Download
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
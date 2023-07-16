@extends('layouts.app')
@push('css')
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
<style>
    .whitespace-nowrap {
        white-space: nowrap;
    }
</style>
@endpush
@section('content')
<h1 class="mt-4">Surat Masuk</h1>
@if (session()->has('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="d-inline-block mr-2">
        <i class="fa-solid fa-circle-check"></i>
    </span>
    {{session('status')}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card mb-4">
    <div class="card-header d-flex align-items-center">
        <i class="fas fa-table me-1"></i>
        Tabel surat masuk
        @if(auth()->user()->role == 1)
        <a href="{{route('surat.create','Masuk')}}" class="btn btn-primary ms-auto">Tambah Surat</a>
        @endif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Dari</th>
                        <th scope="col">Perihal</th>
                        @if(auth() -> user() -> role != 3)
                        <th scope="col">Tujuan</th>
                        @endif
                        @if(auth()->user()->role == 1)
                        <th scope="col">Status</th>
                        @endif
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nomor</th>
                        <th scope="col">Dari</th>
                        <th scope="col">Perihal</th>
                        @if(auth() -> user() -> role != 3)

                        <th scope="col">Tujuan</th>
                        @endif
                        @if(auth()->user()->role == 1)
                        <th scope="col">Status</th>
                        @endif
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </tfoot>

            </table>
        </div>

    </div>
</div>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>

    url = `api/surat-masuk<?= auth()->user()->role == 3 ? '?role=3&kasubag='.auth()->user()->kasubag_id : ''?>`
    console.log(url);
    const table = $('#dataTable').DataTable({
        ajax: {
            url: url,
            type: 'GET',
            dataSrc: '',
        },
        columns: [
            {
                data: 'id',
            },
            {
                data: 'nomor',
            },
            {
                data: 'from_or_to',
            },
            {
                data: 'perihal',
            },
            @if(auth() -> user() -> role != 3)

    {
        data: 'kasubag.nama',
            },
    @endif
    @if (auth() -> user() -> role == 1) {
        data: 'status',
            render: function(data, type) {
                if (type === 'display') {
                    var warna
                    switch (data) {
                        case 'Menunggu tindakan':
                            warna = 'warning';
                            break;
                        case 'Sudah didisposisikan':
                            warna = 'primary';
                            break;
                        case 'Sudah diterima oleh Kasubag':
                            warna = 'success';
                            break;
                        default:
                            break;
                    }
                    return `
                        <span class="badge rounded-pill text-bg-`+ warna + `">` + data + `</span>
                        `
                }
                return data;
            }
    },
    @endif
    {
        data: 'tanggal',
            },
    {
        data: 'id',
            render: function (data, type, row) {
                if (type === 'display') {
                    @if (auth() -> user() -> role == 1)
                        return `
                        <div class="btn-group">
                            <a href="/surat/show/`+ data + ` " class="btn btn-info btn-sm" style="width: 30px">
                                <i class="fas fa-info"></i>
                            </a>
                            <a href="/`+ row.file + `" class="btn btn-primary btn-sm" style="width: 30px">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="/surat/edit/" class="btn btn-warning btn-sm" style="width: 30px">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </div>
                        `
                    @elseif(auth() -> user() -> role == 2)
                    if (row.status == 'Menunggu tindakan') {

                        return `
                        <div class="btn-group">
                            <a href="/surat/edit/" class="btn btn-warning btn-sm" style="width: 30px">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>    
                            <a href="/surat/disposisi/`+ data + `" class="btn btn-primary btn-sm" >
                                Disposisikan
                            </a>
                        </div>
                        `
                    } else {
                        return `
                        <div class="btn-group">
                            <a href="/surat/show/`+ data + `" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i>
                                `+ row.status + `
                            </a>
                        </div>
                        `
                    }
                    @elseif(auth() -> user() -> role == 3)
                    if (row.status == 'Sudah didisposisikan') {
                        return `
                        <div class="btn-group">
                            <a href="/surat/edit/" class="btn btn-info btn-sm" style="width: 30px">
                                <i class="fa-solid fa-info"></i>
                            </a>    
                            <a href="/surat/terima/`+ data + `" class="btn btn-primary btn-sm" >
                                Terima
                            </a>
                        </div>
                        `
                    } else {
                        return `
                        <div class="btn-group">
                            <a href="/surat/show/`+ data + `" class="btn btn-success btn-sm">
                                <i class="fa-solid fa-check"></i>
                                `+ row.status + `
                            </a>
                        </div>
                        `
                    }
                    @endif
                }
                return data;
            }
    }],
    order: [[0, 'desc']],
    })
</script>
@endpush
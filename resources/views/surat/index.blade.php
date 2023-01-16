@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="d-inline-block mr-2">
                    <i class="fa-solid fa-circle-check"></i>
                </span>
                {{session('status')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif


            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <ul class="nav nav-tabs" style="border: none" id="myTab" role="tablist">
                        <li class="nav-item nav-pills" role="presentation">
                            <button class="nav-link active" id="semua-tab" data-bs-toggle="tab"
                                data-bs-target="#semua-tab-pane" type="button" role="tab" aria-controls="semua-tab-pane"
                                aria-selected="true">Semua Surat</button>
                        </li>

                        <li class="nav-item nav-pills" role="presentation">
                            <button class="nav-link" id="semua-tab" data-bs-toggle="tab"
                                data-bs-target="#masuk-tab-pane" type="button" role="tab" aria-controls="masuk-tab-pane"
                                aria-selected="true">Surat Masuk</button>
                        </li>

                        <li class="nav-item nav-pills" role="presentation">
                            <button class="nav-link" id="semua-tab" data-bs-toggle="tab"
                                data-bs-target="#keluar-tab-pane" type="button" role="tab"
                                aria-controls="keluar-tab-pane" aria-selected="true">Surat Keluar</button>
                        </li>

                    </ul>
                    <a href="{{route('surat.create')}}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body ">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="semua-tab-pane" role="tabpanel"
                            aria-labelledby="semua-tab" tabindex="0">
                            <table id="semua-table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Dari/Kepada</th>
                                        <th scope="col">Perihal</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Jenis</th>
                                        <th scope="col">Dari/Kepada</th>
                                        <th scope="col">Perihal</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="masuk-tab-pane" role="tabpanel" aria-labelledby="masuk-tab"
                            tabindex="0">
                            <table id="masuk-table" class="table" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nomor</th>
                                        <th scope="col">Dari</th>
                                        <th scope="col">Perihal</th>
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
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="keluar-tab-pane" role="tabpanel" aria-labelledby="keluar-tab"
                            tabindex="0">...</div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />
@endpush
@push('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>

<script>
    const semua = $('#semua-table').DataTable({
        serverSide:true,
        processing:true,
        ajax: "{{route('data.semua')}}",
        buttons:[
            'btn'
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false
            },
            {
                data: 'nomor',
                name: 'nomor'
            },
            {
                data: 'jenis',
                name: 'jenis'
            },
            {
                data: 'from_or_to',
                name: 'from_or_to'
            },
            {
                data: 'perihal',
                name: 'perihal'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'action',
                name: 'action',
                sortable: false,
                searchable: false
            }],
        order: [[0, 'asc']],
        language: {
            oPaginate: {
                sNext: '<i class="fa fa-forward"></i>',
                sPrevious: '<i class="fa fa-backward"></i>',
                sFirst: '<i class="fa fa-step-backward"></i>',
                sLast: '<i class="fa fa-step-forward"></i>'
            }
        },
    });
    const masuk = $('#masuk-table').DataTable({
        serverSide:true,
        processing:true,
        ajax: "{{route('data.masuk')}}",
        buttons:[
            'btn'
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false
            },
            {
                data: 'nomor',
                name: 'nomor'
            },
            {
                data: 'from_or_to',
                name: 'from_or_to'
            },
            {
                data: 'perihal',
                name: 'perihal'
            },
            {
                data: 'tanggal',
                name: 'tanggal'
            },
            {
                data: 'action',
                name: 'action',
                sortable: false,
                searchable: false
            }],
        order: [[0, 'asc']],
        language: {
            oPaginate: {
                sNext: '<i class="fa fa-forward"></i>',
                sPrevious: '<i class="fa fa-backward"></i>',
                sFirst: '<i class="fa fa-step-backward"></i>',
                sLast: '<i class="fa fa-step-forward"></i>'
            }
        },
    });

</script>
@endpush
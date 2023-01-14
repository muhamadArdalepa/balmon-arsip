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
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Surat Masuk') }}
                    <a href="{{route('surat-masuk.create')}}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="card-body">
                    <table id="surat-table" class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nomor Surat</th>
                                <th scope="col">Pengirim</th>
                                <th scope="col">Perihal</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>


<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script>

<script>
    const table = $('#surat-table').DataTable({
        serverSide:true,
        processing:true,
        ajax: "{{route('data.surat-masuk')}}",
        buttons:[
            'btn'
        ],
        columns: [
            {
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                sortable: false,
                searchable: false
            },
            {
                data: 'nomor',
                name: 'nomor'
            },
            {
                data: 'pengirim',
                name: 'pengirim'
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
<div class="btn-group">
    <a href="{{asset('storage/'.$data->file)}}" class="btn btn-primary btn-sm" data-toggle="modal"
        data-target="#addCharModal">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{route('download.masuk',$data->file)}}" class="btn btn-outline btn-sm" data-toggle="modal"
        data-target="#addCharModal">
        <i class="fa-solid fa-download"></i>
    </a>
</div>
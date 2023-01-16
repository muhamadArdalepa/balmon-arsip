<div class="btn-group">
    <a href="{{route('surat.show',$data->id)}}" class="btn btn-info btn-sm" style="width: 30px">
        <i class="fas fa-info"></i>
    </a>
    <a href="{{asset('storage/'.$data->file)}}" class="btn btn-primary btn-sm" style="width: 30px">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{route('download',$data->file)}}" class="btn btn-success btn-sm" style="width: 30px">
        <i class="fa-solid fa-download"></i>
    </a>
    <a href="{{route('surat.edit',$data->id)}}" class="btn btn-warning btn-sm" style="width: 30px">
        <i class="fa-solid fa-pen-to-square"></i>
    </a>
</div>
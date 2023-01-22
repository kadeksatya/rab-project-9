@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/rab/work' : '/admin/rab/work/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif

                <div class="form-group mb-2">
                    <label for="">Kode</label>
                    <input type="text" class="form-control" required name="code" value="{{$data->code ?? ''}}" placeholder="ex . 001">
                </div>                
                <div class="form-group mb-2">
                    <label for="">Nama Pekerjaan</label>
                    <input type="text" class="form-control" required name="name" value="{{$data->name ?? ''}}" placeholder="ex . Nembok">
                </div>

                @if ($data != null)
                <div class="form-group mb-2">
                    <label for="">Jenis Pekerjaan</label>
                    <select name="work_category_id" id="" class="form-control select2" style="width: 100%" required>
                        <option value="" selected disabled></option>
                        @foreach ($category as $item)
                            <option value="{{$item->id}}" {{$data->work_category_id == $item->id ? 'selected':''}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="form-group mb-2">
                    <label for="">Jenis Pekerjaan</label>
                    <select name="work_category_id" id="" class="select2" style="width: 100%" required>
                        <option value="" selected disabled></option>
                        @foreach ($category as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div class="form-group mb-2">
                    <label for="">Satuan</label>
                    <input type="text" class="form-control" required name="unit" value="{{$data->unit ?? ''}}" placeholder="ex . Borongan">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/rab/work'
            ])
        </div>
    </form>
    </div>
</div>
@endsection

@push('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.css" />

@endpush

@push('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.2/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
    })

</script>
@endpush
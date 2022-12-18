@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="{{ $data == null ? '/admin/rab/rabs' : '/admin/rab/rabs/'.$data->id.'/update' }}" method="POST">
                @csrf

                @if ($data == null)
                    @method('POST')
                @else
                    @method('PUT') 
                @endif

                <div class="form-group mb-2">
                    <label for="">Nama Proyek</label>
                    <input type="text" class="form-control" name="name" value="{{$data->name ?? ''}}" placeholder="ex . Nembok">
                </div>

                <div class="form-group mb-2">
                    <label for="">Tanggal Proyek</label>
                    <input type="date" class="form-control" name="project_date" value="{{$data->project_date ?? ''}}" placeholder="">
                </div>

                <div class="form-group mb-2">
                    <label for="">Biaya Kontruksi</label>
                    <input type="num" step="any" class="form-control" name="construction_service" value="{{$data->construction_service ?? ''}}" placeholder="ex . 1">
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
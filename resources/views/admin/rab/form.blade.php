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
                    <input type="text" required class="form-control" required name="name" value="{{$data->name ?? ''}}" placeholder="ex . Nembok">
                </div>

                <div class="form-group mb-2">
                    <label for="">Tanggal Proyek</label>
                    @if ($data == null)
                    <input type="date" required class="form-control" required name="project_date" placeholder="">
                        
                    @else
                    <input type="date" required class="form-control" required name="project_date" value="{{Carbon\Carbon::parse($data->project_date)->format('Y-m-d')}}" placeholder="">
                        
                    @endif
                </div>

                <div class="form-group mb-2">
                    <label for="">Biaya Kontruksi</label>
                    <input type="num" step="any" required class="form-control" required name="construction_service" value="{{$data->construction_service ?? ''}}" placeholder="ex . 1">
                </div>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/rab/rabs'
            ])
        </div>
    </form>
    </div>
</div>
@endsection
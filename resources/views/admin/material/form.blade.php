@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-8">
        <div class="card">

            <div class="card-body">
                <form action="/admin/masterdata/material" method="POST">
                @csrf

                <div class="form-group mb-2">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="ex . Semen">
                </div>
                <div class="form-group mb-2">
                    <label for="">Unit</label>
                    <input type="text" class="form-control" name="unit" placeholder="ex . Sak">
                </div>
                <div class="form-group mb-2">
                    <label for="">Price</label>
                    <input type="number" min="1" class="form-control" name="name" placeholder="ex . 100000">
                </div>
                </form>
            </div>
        </div>
        <div class="card-footer">
            @include('components.btnactionform', [
                'url_back' => '/admin/masterdata/material'
            ])
        </div>
    </div>
</div>
@endsection
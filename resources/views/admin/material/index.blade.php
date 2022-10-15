@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @include('components.btnaction', [
            "item" => [
                "url" => "/admin/masterdata/material",
                "name" => "Add Material"
            ]
        ])
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection
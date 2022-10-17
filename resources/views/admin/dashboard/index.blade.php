@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-coffee"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{$project}}</h2>
                        <p class="m-b-0 text-muted">Project</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-team"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{$worker}}</h2>
                        <p class="m-b-0 text-muted">Workers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
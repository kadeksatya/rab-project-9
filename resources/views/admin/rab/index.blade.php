@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/rab/rabs/create",
                "name" => "Add RAB"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <th>Project Name</th>
                        <th>Project Date</th>
                        <th>Construction Service</th>
                        <th>Real Cost</th>
                        <th>Round Up Cost</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($datas as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{\Carbon\Carbon::parse($item->project_date)->format('d-M-Y')}}</td>
                                <td>{{$item->construction_service}}</td>
                                <td>{{$item->real_cost}}</td>
                                <td>{{$item->rounded_up_cost}}</td>

                                <td>
                                    @include('components.btnactionlist', [
                                        "is_detail" => true,
                                        "is_edit" => false,
                                        "is_print" => true,
                                        "is_delete" => false,
                                        "url_detail" => "/admin/rab/rabs/".$item->id."/detail",
                                        "url_print" => "/admin/rab/rabs/".$item->id."/print",
                                        "url_edit" => "/admin/rab/rabs/".$item->id."/edit",
                                        "url_delete" => "/admin/rab/rabs/".$item->id."/delete",
                                    ])
                                </td>
                            </tr>                            
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
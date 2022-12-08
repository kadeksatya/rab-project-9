@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/rab/work/create",
                "name" => "Add Work"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <th>Code</th>
                        <th>Work Name</th>
                        <th>Work Category</th>
                        <th>Unit</th>
                        <th>Total Amount</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($datas as $item)
                            <tr>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category->name ?? '-'}}</td>
                                <td>{{$item->unit}}</td>
                                <td>{{$item->total_amount ?? 0}}</td>
                                <td>
                                    @include('components.btnactionlist', [
                                        "is_detail" => true,
                                        "is_edit" => true,
                                        "is_print" => false,
                                        "is_delete" => true,
                                        "url_detail" => "/admin/rab/work/".$item->id."/detail",
                                        "url_edit" => "/admin/rab/work/".$item->id."/edit",
                                        "url_delete" => "/admin/rab/work/".$item->id."/delete",
                                    ])
                                </td>
                            </tr>                            
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
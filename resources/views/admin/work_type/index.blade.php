@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        @include('components.btnaction', [
            "item" => [
                "url" => "/admin/masterdata/worktype",
                "name" => "Add Work Type"
            ]
        ])
        <div class="card">
            <div class="card-body">
                <table class="table" id="datatable">
                    <thead>
                        <th>Code</th>
                        <th>Name</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($datas as $item)
                            <tr>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @include('components.btnactionlist', [
                                        "is_detail" => false,
                                        "url_detail" => "",
                                        "url_edit" => "/admin/masterdata/worktype/".$item->id."/edit",
                                        "url_delete" => "/admin/masterdata/worktype/".$item->id."/delete",
                                    ])
                                </td>
                            </tr>                            
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
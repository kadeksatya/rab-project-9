@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/masterdata/material/create",
                "name" => "Tambah Bahan"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Satuan</th>
                        <th>Jenis Bahan</th>
                        <th>Harga</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($datas as $item)
                            <tr>
                                <td>{{$item->code}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->unit}}</td>
                                <td>{{$item->material_type}}</td>
                                <td>@currency($item->price)</td>
                                <td>
                                    @include('components.btnactionlist', [
                                        "is_detail" => false,
                                        "is_edit" => true,
                                        "is_delete" => true,
                                        "is_print" => false,

                                        "url_detail" => "",
                                        "url_edit" => "/admin/masterdata/material/".$item->id."/edit",
                                        "url_delete" => "/admin/masterdata/material/".$item->id."/delete",
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
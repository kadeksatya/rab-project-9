@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/masterdata/worktype/create",
                "name" => "Tambah Jenis Pekerjaan"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <th>Kode</th>
                        <th>Nama</th>
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
                                        "is_edit" => true,
                                        "is_delete" => true,
                                        "is_print" => false,

                                        "url_detail" => "",
                                        "url_edit" => "/admin/masterdata/worktype/".$item->id."/edit",
                                        "url_delete" => "/admin/masterdata/worktype/".$item->id."/delete",
                                    ])
                                </td>
                            </tr>                            
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">No Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
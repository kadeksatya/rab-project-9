@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/rab/work/workdetail/".$work_id."/create",
                "name" => "Add Work"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <th>Name Tool/Worker/Material</th>
                        <th>Koefisien</th>
                        <th>Unit</th>
                        <th>Sub Amount</th>
                        <th>Created At</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @forelse ($datas as $item)
                            <tr>
                                <td>
                                    @if ($item->type_data == 1)
                                        {{$item->material->name ?? '-'}}
                                    @elseif ($item->type_data == 2)
                                        {{$item->tool->name ?? '-'}}
                                    @elseif ($item->type_data == 3)
                                        {{$item->worker->name ?? '-'}}
                                    @endif
                                </td>
                                <td>{{$item->koefisien}}</td>
                                <td>{{$item->unit}}</td>
                                <td>{{$item->sub_amount ?? 0}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}</td>
                                <td>
                                    @include('components.btnactionlist', [
                                        "is_detail" => false,
                                        "is_edit" => true,
                                        "is_delete" => true,
                                        "is_print" => false,
                                        "url_detail" => "",
                                        "url_edit" => "/admin/rab/work/workdetail/".$item->id."/edit",
                                        "url_delete" => "/admin/rab/work/workdetail/".$item->id."/delete",
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


@push('script')
    
    <script>
        
    </script>

@endpush
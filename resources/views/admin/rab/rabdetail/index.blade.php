@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/rab/rabs/rabsdetail/".$rab_id."/create",
                "name" => "Add Work"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered" id="datatable">
                    <thead>
                        <th>Work Category</th>
                        <th>Work Name</th>
                        <th>Volume</th>
                        <th>Price</th>
                        <th>Sub Total</th>
                        <th>Created At</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $value)
                        <tr>
                            <td colspan="7">{{$key}}</td>
                        </tr>
                        @foreach ($value as $item)
                        <tr>
                            <td></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->volume}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->sub_amount}}</td>
                            <td>{{\Carbon\Carbon::parse($item->created_at)->format('d-M-Y')}}</td>
                            <td>
                                @if ($item->is_overbudget == 0)
                                @include('components.btnactionlist', [
                                    "is_detail" => false,
                                    "is_edit" => false,
                                    "is_delete" => true,
                                    "is_print" => false,

                                    "url_detail" => "",
                                    "url_edit" => "/admin/rab/rabs/rabsdetail/".$item->detail_id."/edit",
                                    "url_delete" => "/admin/rab/rabs/rabsdetail/".$item->detail_id."/".$item->rab_id."/delete",
                                ])
                                @endif
                            </td>
                        </tr>
                        @endforeach

                        @endforeach

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
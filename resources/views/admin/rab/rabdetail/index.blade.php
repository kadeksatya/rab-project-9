@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-md-12">
        @include('components.btnaction', [
            "item" => (Object)[
                "url" => "/admin/cco/".$rab_id."/create",
                "name" => "Tambah Pekerjaan"
            ]
        ])

        <div class="card">

            <div class="card-body">
                <table class="table table-bordered datatable" id="">
                    <thead>
                        <th>Jenis Pekerjaan</th>
                        <th>Nama Pekerjaan</th>
                        <th>Volume</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $value)
                        <tr>
                            <td colspan="7">{{$key}}</td>
                        </tr>
                        @foreach ($value as $item)
                        @php
                            $totals = $item->volume * $item->total_amount;
                            $jumlah_1 = 0;
                            $jumlah_2 = 0;
                            $jumlah_1 += $totals;
                            $jumlah_2 = $value->where('is_overbudget', 0)->sum('total_amount');
                            
                        @endphp
                        @if ($item->is_overbudget == 0)
                        <tr>
                            <td></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->volume}}</td>
                            <td>@currency($item->total_amount)</td>
                            <td>@currency($totals)</td>
                            <td>
                                

                            </td>
                        </tr>
                        @endif
                        @endforeach

                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Jumlah</strong></td>
                            <td>
                                @if (isset($jumlah_2))
                                    {{-- @currency($jumlah_2) --}}
                                @endif
                            </td>
                            <td>
                                @if (isset($jumlah_1))
                                    @currency($jumlah_1)
                                @endif

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <div class="card">
            <div class="card-header mt-4"><h3>Change Contract Order</h3></div>
            <div class="card-body">
                <table class="table table-bordered datatable" id="">
                    <thead>
                        <th>Jenis Pekerjaan</th>
                        <th>Nama Pekerjaan</th>
                        <th>Volume</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th>Tipe CCO</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($datas as $key => $value)
                        <tr>
                            <td colspan="7">{{$key}}</td>
                        </tr>
                        @foreach ($value as $item)
                        @php
                            $totals_1 = $item->volume * $item->total_amount;
                            $jumlah_12 = 0;
                            $jumlah_12 += $totals;
                            $jumlah_22 = $value->where('is_overbudget', 1)->sum('total_amount');
                        @endphp
                        @if ($item->is_overbudget == 1)
                        <tr>
                            <td></td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->volume}}</td>
                            <td>@currency($item->total_amount)</td>
                            <td>@currency($totals_1)</td>
                            <td>
                                @if ($item->is_add == 1)
                                    <div class="badge badge-success">
                                        Penambahan
                                    </div>
                                @else
                                    <div class="badge badge-danger">
                                        Pengurangan
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if ($item->is_overbudget == 1)
                                @include('components.btnactionlist', [
                                    "is_detail" => false,
                                    "is_edit" => true,
                                    "is_print" => false,
                                    "is_delete" => true,
                                    "url_detail" => "",
                                    "url_edit" => "/admin/cco/".$item->detail_id."/edit",
                                    "url_delete" => "/admin/cco/".$item->detail_id."/".$item->rab_id."/delete",
                                ])
                                @endif


                            </td>
                        </tr>
                        @endif

                        @endforeach

                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Jumlah</strong></td>
                            <td></td>
                            <td>
                                @if (isset($jumlah_2))
                                    {{-- @currency($jumlah_2) --}}
                                @endif
                            </td>
                            <td>
                                @if (isset($jumlah_12))
                                    @currency($jumlah_12)
                                @endif

                            </td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div></div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <table class="table" style="width:100%">
            <tbody>
                <tr>
                    <td width="70%" colspan="5" class="text-right">
                        <ul>
                            <li>REAL COST</li>
                            <li>JASA KONTRAKTOR ( {{$data->construction_service}} %)</li>
                            <li>JUMLAH</li>
                            <li>JUMLAH DIBULATKAN</li>
                        </ul>
                    </td>
                    <td>
                        @php
                        if( !function_exists('ceiling') )
                        {
                            function ceiling($number, $significance = 1)
                            {
                                return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
                            }
                        }
                            $real_cost = $data->real_cost;
                            $total_construection = $data->construction_service / 100;
                            $sub_total = $real_cost * $total_construection;
                            $total = $real_cost + $sub_total;
                            $rounded = ceiling($total, 1000);
    
                        @endphp
                        <ul>
                            <li>@currency($real_cost).00</li>
                            <li>
                                @currency($sub_total).00
                            </li>
                            <li>@currency($total).00</li>
                            <li>@currency($rounded).00</li>
                        </ul>
                    </td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    ul li {
        text-decoration: none !important;
        list-style-type: none;
    }

</style>
@endpush

@push('script')

<script>

</script>

@endpush

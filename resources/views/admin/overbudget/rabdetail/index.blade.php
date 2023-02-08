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
                <button class="btn btn-primary addFiles" type="button"><i class="fa fa-upload"></i> Bukti
                    Laporan</button>
               
            </div>
        </div>

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
                        @foreach ($isOverF as $key => $value)
                        <tr>
                            <td colspan="7">{{$key}}</td>
                        </tr>
                        @foreach ($value as $item)
                        @php

                        $totals = $item->volume * $item->price;
                        $jumlah_1 = 0;
                        $jumlah_1 += $totals;
                        $jumlah_2 = $item->rab_cost


                        @endphp
                        @if ($item->is_overbudget == 0)
                        <tr>
                            <td></td>
                            <td>{{$item->work_names}}</td>
                            <td>{{$item->volume}}</td>
                            <td>@currency($item->price)</td>
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
                            </td>
                            <td>
                                @if (isset($jumlah_2))
                                @currency($jumlah_2)
                                @endif

                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <div class="card">
            <div class="card-header mt-4">
                <h3>Change Contract Order</h3>
            </div>
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
                        @foreach ($isOverT as $key => $value)
                        <tr>
                            <td colspan="7">{{$key}}</td>
                        </tr>
                        @foreach ($value as $item)
                        @php
                        $totals_1 = $item->volume * $item->price;
                        $jumlah_12 = 0;
                        $jumlah_12 += $totals;
                        $jumlah_22 = $item->cco_cost;
                        @endphp
                        @if ($item->is_overbudget == 1)
                        <tr>
                            <td></td>
                            <td>{{$item->work_names}}</td>
                            <td>{{$item->volume}}</td>
                            <td>@currency($item->price)</td>
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
                                @if (Auth::user()->role_id == 1)
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
                                @endif


                            </td>
                        </tr>
                        @endif

                        @endforeach

                        @endforeach

                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <strong>Jumlah</strong>
                            </td>
                            <td></td>

                            <td>
                                @if (isset($total_semuanya))
                                @currency($total_semuanya)
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
                            return ( is_numeric($number) && is_numeric($significance) ) ?
                            (ceil($number/$significance)*$significance) : false;
                            }
                            }
                            $real_cost = $data->rab_cost + $total_semuanya;
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload files</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if (Auth::user()->role_id == 3)
                <form action="{{route('rabs.uploads', $rab_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Dokumen </label>
                        <input type="text" name="name" class="form-control" id="" required>
                    </div>
                    <div class="form-group">
                        <label for="">Upload Dokumen</label>
                        <input type="file" name="files" class="form-control" required id="" accept="PDF">
                    </div>
                    <button class="btn btn-primary" type="submit">Save changes</button>
                </form>
                @endif

                    <hr>
                    <table class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Status Dokumen</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                            $no =1;
                            @endphp
                            @foreach ($files as $item)
                            <tr>
                            <td>{{$no++}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                @if ($item->status == 'REJECTED')
                                <div class="badge badge-danger">DITOLAK</div>
                                @endif
                                @if ($item->status == 'APPROVED')
                                <div class="badge badge-success">DISETUJUI</div>
                                @endif
                                @if ($item->status == 'WAITING_APPROVAL')
                                <div class="badge badge-info">MENUNGGU PERSETUJUAN</div>
                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->role_id == 3)
                                <button class="btn btn-danger delete-item" type="button"
                                    data-url="{{route('rabs.deleteDoc', $item->id)}}"> <i class="fa fa-trash"></i>
                                </button>
                                @endif
                                @if (Auth::user()->role_id == 2)
                                <button class="btn btn-primary updateStatus" type="button"
                                data-url="{{route('rabs.changestatus', $item->id)}}"
                                data-status = {{$item->status}}
                                > <i class="fa fa-info"></i>
                                </button> 
                                @endif

                                <a class="btn btn-info" type="button" href="{{route('rabs.downloads', $item->id)}}"> <i
                                        class="fa fa-eye"></i> </a>
                            </td>
                        </tr>
                            @endforeach
                        </tbody>

                    </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

{{-- Modal Change Status --}}

<!-- Modal -->
<div class="modal fade" id="modalChangeStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Update Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="formPersetujuan" method="post">
                @csrf
              
                <div class="form-group">
                    <label for="">Status Dokumen </label>
                    <select name="status" id="" class="form-control statusField">
                        <option value="" selected disabled></option>
                        <option value="WAITING_APPROVAL">Menunggu Persetujuan</option>
                        <option value="APPROVED">Setujui Dokumen</option>
                        <option value="REJECTED">Tolak Dokumen</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary" type="submit">Save changes</button>

        </div>
    </form>

      </div>
    </div>
  </div>
<script>
    $(document).ready(function () {
        $('.addFiles').click(function () {
            $('#exampleModal').modal('show')
        })

        $('.updateStatus').click(function () {
            $('#modalChangeStatus').modal('show')
            let status = $(this).data('status')
            let url = $(this).data('url');
            $('#formPersetujuan').attr('action', url)
            $('.statusField').val(status)
            $('#exampleModal').modal('hide')

        })
    });

</script>

@endpush

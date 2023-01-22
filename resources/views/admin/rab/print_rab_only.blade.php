<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta name="robots" content="noindex">

    <!-- Favicon -->

    <title>{{$page_name}}</title>
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet">

    <style>
        ul li {
            text-decoration: none !important;
            list-style-type:none;
        }
        @media print {
            th.berkurang {
                background-color: #fbc239 !important;
                print-color-adjust: exact; 
            }
            td.berkurang {
                background-color: #fbc239 !important;
                print-color-adjust: exact; 
            }
            th.bertambah {
                background-color: #56caa8 !important;
                print-color-adjust: exact; 
            }
            td.bertambah {
                background-color: #56caa8 !important;
                print-color-adjust: exact; 
            }
        }

        @media print {
            .berkurang th {
                color: white !important;
            }
            .betambah th {
                color: white !important;
            }
        }
        </style>
</head>

<body>
    <center>
        <h2>{{$title}}</h2>
        <h4>CV. Aditya Bangun Perkasa</h4>
        <h5></h5>

        <hr>
    </center>

    <p>Nama Proyek : <span><strong>{{$data->name}}</strong></span></p>
    <table class="table table-bordered border-dark" style="width: 100%">
        <thead>
            <th width="20px" rowspan="2">Nomor</th>
            <th rowspan="2">Jenis Pekerjaan</th>
            <th rowspan="2">Volume</th>
            <th rowspan="2">Satuan</th>
            <th rowspan="2">Harga Satuan</th>
            <th rowspan="2">Jumlah Satuan</th>
            
        </thead>
        <tbody>
            

            @php
                $huruf = 'A';                
            @endphp

            @foreach ($detail as $key => $value)


            <tr>
                <td>{{$huruf++}}</td>
                <td colspan="12">{{$key}}</td>
            </tr>


            @php
                $number = 1;                
            @endphp

            
            @foreach ($value as $item)


            <tr>
                <td class="text-right">{{$number++}}</td>
                <td>{{$item->name}}</td>

                <td>{{$item->volume}}</td>
                <td>{{$item->unit}}</td>
                <td>@currency($item->price).00</td>
                <td>@currency($item->sub_amount).00</td>
               
                
                
            </tr>
            
 
            @endforeach

            @endforeach

            <tr>
                <td colspan="2"><strong>JUMLAH</strong></td>
                <td></td>
                <td></td>
                <td></td>
                <td>@currency($getDataRab)</td>
            </tr>

            <tr>
                <td width="70%" colspan="5 " class="text-right">
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
                        $real_cost = $getDataRab;
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
            <tr>
                <td colspan="5">
                    <u><i><strong>Terbilang :</strong></i></u>
                    <p class="mt-2"><i class="text-capitalize">{{Terbilang::make($rounded)}}</i></p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex flex-row-reverse">
        <div class="p-2 text-center">
            <p>Dibuat Oleh,</p>
            <p><strong>CV. Aditya Bangun Perkasa</strong></p>
            <br>
            <br>
            <br>
            <p><u><strong>Ir. I Nyoman Sena Ardana</strong></u></p>
            <p>DIREKTUR</p>
        </div>
      </div>




    
    <!-- Core Vendors JS -->
    <script src="{{asset('assets/js/vendors.min.js')}}"></script>

    <!-- page js -->
    <script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard-default.js')}}"></script>

    <!-- Core JS -->
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- page js -->
    <script src="{{asset('assets/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>


    <script>

        $(document).ready(function () {
            window.print();

            window.onafterprint = function(){
                window.top.close();
            }
        });

    </script>
</body>

</html>

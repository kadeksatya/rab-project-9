@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header m-3">
                <h3>Jumlah Proyek Per tahun</h3>
            </div>
            <div class="card-body">


                <canvas class="chart" id="bar-chart-proyek-pertahun"></canvas>


            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header m-3">
                <h3>Nilai Proyek RAB</h3>
            </div>
            <div class="card-body">


                <canvas class="chart" id="bar-chart-nilai-project"></canvas>


            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-12">
        <div class="card">
            <div class="card-header m-3">
                <h3>Perbandingan RAB & COA</h3>
            </div>
            <div class="card-body">


                <canvas class="chart" id="bar-chart"></canvas>


            </div>
        </div>
    </div>
</div>




@endsection
@push('script')
<script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
<script>
    
    
    $(document).ready(function () {
        // Chart Perbandingan
            const barChart1 = document.getElementById("bar-chart");
            const barCtx1 = barChart1.getContext('2d');
            barChart1.height = 120;
            const barConfig1 = new Chart(barCtx1, {
                type: 'bar',
                data: {
                    labels: {{ Js::from($labels_rabTerr) }},
                    datasets: [
                        {
                            label: 'RAB',
                            backgroundColor: 'blue',
                            stacked:"RAB",
                            borderWidth: 1,
                            data: [@foreach ($rabs_datas as $i){{$i['total_rabs']}}, @endforeach]

                        },
                        {
                            label: 'CCO',
                            backgroundColor: 'rgb(255, 99, 132)',
                            stacked:"CCO",
                            borderWidth: 0,
                            data: [@foreach ($cco_datas as $i){{$i['total_ccos']}}, @endforeach]
                        },
                    ]
                },

                options: {
                    scaleShowVerticalLines: false,
                    responsive: true,
                    scales: {
						xAxes: [{
							ticks: {
								beginAtZero:true,
                                callback: function(value, index, values) {
                                    return value.toLocaleString("id",{style:"currency", currency:"IDR"});
                                }
							},
						}],
						yAxes: [{
							ticks: {
								beginAtZero:true,
                                callback: function(value, index, values) {
                                    return value.toLocaleString("id",{style:"currency", currency:"IDR"});
                                }
							}
						}],
					},
                }
            });

            // ============================ Chart Total Proyek Pertahun ================================

            
            const barChart2 = document.getElementById("bar-chart-proyek-pertahun");
            const barCtx2 = barChart2.getContext('2d');
            var labels_pertahun = {{ Js::from($labels_pertahun) }};
            var data = {{ Js::from($datasets_pertahun) }};

            barChart2.height = 120;
            const barConfig2 = new Chart(barCtx2, {
                type: 'bar',
                data: {
                    labels: labels_pertahun,
                    datasets: [{
                            label: 'Series A',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderWidth: 0,
                            data: data
                        },
                    ]
                },

                options: {
                    scaleShowVerticalLines: false,
                    responsive: true,
                    scales: {
						xAxes: [{
							ticks: {
								beginAtZero:true
							},
						}],
						yAxes: [{
							ticks: {
								beginAtZero:true
							}
						}],
					},
                }
            });


                   // ============================ Chart Nilai Projek ================================

            const barChart3 = document.getElementById("bar-chart-nilai-project");
            const barCtx3 = barChart3.getContext('2d');
            var labels_rabTer = {{ Js::from($labels_rabTerr) }};
            var colors = {{ Js::from($colors) }};
            barChart3.height = 120;
            const barConfig3 = new Chart(barCtx3, {
                type: 'bar',
                data: {
                    labels: labels_rabTer,
                    datasets: [
                        @foreach ($data_rabTertinggi as $item)
                        {
                            label: '{{$item->name}}',
                            backgroundColor: colors,
                            borderWidth: 0,
                            data: [{{$item->totals}}]
                        },
                        @endforeach
                    ]
                },

                options: {
                    scaleShowVerticalLines: false,
                    responsive: true,
                    scales: {
						xAxes: [{
							ticks: {
								beginAtZero:true,
                                callback: function(value, index, values) {
                                    return value.toLocaleString("id",{style:"currency", currency:"IDR"});
                                }
							},
						}],
						yAxes: [{
							ticks: {
								beginAtZero:true,
                                callback: function(value, index, values) {
                                    return value.toLocaleString("id",{style:"currency", currency:"IDR"});
                                }
							}
						}],
					},
                }
            });
    });


</script>
@endpush

<?php

namespace App\Http\Controllers;

use App\Models\RAB;
use App\Models\RABDetail;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        # code...




        $project = RAB::count();
        $worker = Worker::count();


        // Chart Jumlah Proyek Per tahun

        $month = [];
        $healing = [];
        $piutang = [];

        // return RAB::all();

        for ($m=2019; $m <= date('Y'); $m++) { 
            $month[] = date('Y', mktime(0,0,0,1, 1, $m));

            $datas_pertahun = RAB::select(DB::raw("COUNT(*) as totals"))
                ->whereYear('created_at', $m)
                ->groupBy(DB::raw("YEAR(created_at)"))
                ->first();


            $healing[] = $datas_pertahun ? $datas_pertahun->totals : 0;
        }

         $labels_pertahun = $month;
         $datasets_pertahun = $healing;



        //  Chart RAB tertinggi
        $data_label_rabTeringgi = [];
         $label_rabTeringgi = RAB::select('name')->get();
        foreach ($label_rabTeringgi as $item) {
            $data_label_rabTeringgi[] = $item->name;
        }

        $labels_rabTerr = $data_label_rabTeringgi;
        $data_rabTertinggi = RAB::select('name','rab_cost as totals')
        ->get();

        $counts = $data_rabTertinggi->count();
        $colors = [];

        for ($i=0; $i <= $counts ; $i++) { 
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

            $colors[] = $color;
        }

        






        // Perbandingan 
    
        $rabs_datas = [];


   
    $rabs_datas = RABDetail::where('is_overbudget', 0)->select(DB::raw('SUM(sub_amount) as total_rabs'))->groupBy('rab_id')->get();
    $cco_datas = RABDetail::where('is_overbudget', 1)->select(DB::raw('SUM(sub_amount) as total_ccos'))->groupBy('rab_id')->get();

        

        

        return view('admin.dashboard.index', [
            'page_name' => 'Dashboard',
            'project' => $project,
            'worker' => $worker,
            'labels_pertahun' => $labels_pertahun,
            'datasets_pertahun' => $datasets_pertahun,
            'labels_rabTerr' => $labels_rabTerr,
            'data_rabTertinggi' => $data_rabTertinggi,
            'rabs_datas' => $rabs_datas,
            'cco_datas' => $cco_datas,
            'colors' => $colors
        ]);
    }
}

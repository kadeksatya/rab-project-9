<?php

namespace App\Http\Controllers;

use App\Models\RAB;
use App\Models\RABDetail;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RABController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = RAB::all();

        return view('admin.rab.index', [
            'page_name' => 'RAB',
            'datas' => $datas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = null;

        return view('admin.rab.form', [
            'page_name' => 'Add RAB',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            //code...
            $form = $request->all();

            RAB::create($form);
            DB::commit();
            return redirect('/admin/rab/rabs')->with('message', 'Data successfully created');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RAB  $RAB
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $datas = RAB::whereId($id)->first();

            $totals = 0;

            $real_cost = RABDetail::where('rab_id', $id)
            ->join('work_types', 'r_a_b_details.work_category_id', '=', 'work_types.id')
            ->join('works', 'r_a_b_details.work_id', '=', 'works.id')
            ->select('work_types.name as category_name','r_a_b_details.*','r_a_b_details.id as detail_id','works.*')
            ->get();

            foreach ($real_cost as $item) {
                $totals += $item->volume * $item->total_amount;
            }


            $construction_service = ($datas->construction_service / 100) * $totals;

            $total = $construction_service + $totals;

            RAB::whereId($id)->update([
                'real_cost' => $totals,
                'rounded_up_cost' => round($total),
                'project_date' => $datas->project_date
            ]);


        $datas = DB::table('r_a_b_details')
        ->where('rab_id', $id)
        ->join('work_types', 'r_a_b_details.work_category_id', '=', 'work_types.id')
        ->join('works', 'r_a_b_details.work_id', '=', 'works.id')
        ->select('work_types.name as category_name','r_a_b_details.*','r_a_b_details.id as detail_id','works.*')
        ->get()
        ->groupBy('category_name');

        $rab = RAB::whereId($id)->first();

        return view('admin.rab.rabdetail.index', [
            'page_name' => 'Detail RAB',
            'datas' => $datas,
            'data' => $rab,
            'rab_id' => $id
        ]);
    }


        /**
     * Display the specified resource.
     *
     * @param  \App\Models\RAB  $RAB
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request, $id)
    {


        $titles = $request->title;


        if($titles == 1){
           $details = DB::table('r_a_b_details')
            ->where('rab_id', $id)
            ->where('is_overbudget', 0)
            ->join('work_types', 'r_a_b_details.work_category_id', '=', 'work_types.id')
            ->join('works', 'r_a_b_details.work_id', '=', 'works.id')
            ->where('r_a_b_details.is_overbudget', 0)
            ->select('work_types.name as category_name','r_a_b_details.*','r_a_b_details.id as detail_id','works.*')
            ->get()
            ->groupBy('category_name');

            $titles = 'Rencana Anggaran Biaya';

            $datas = RAB::whereId($id)->first();
            return view('admin.rab.print_rab_only', [
                'page_name' => 'Print RAB'.' '.$datas->name,
                'title' => $titles,
                'data' => $datas,
                'detail' => $details,
            ]);
        }else{
            $titles = 'CHANGE CONTRACT ORDER';
            $details = DB::table('r_a_b_details')
            ->where('rab_id', $id)
            ->where('is_overbudget', 1)
            ->join('work_types', 'r_a_b_details.work_category_id', '=', 'work_types.id')
            ->join('works', 'r_a_b_details.work_id', '=', 'works.id')
            ->select('work_types.name as category_name','r_a_b_details.*','r_a_b_details.id as detail_id','works.*')
            ->get()
            ->groupBy('category_name');

            $datas = RAB::whereId($id)->first();
            return view('admin.rab.print_rab', [
                'page_name' => 'Print RAB'.' '.$datas->name,
                'title' => $titles,
                'data' => $datas,
                'detail' => $details,
            ]);
        }

        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RAB  $RAB
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = RAB::find($id);
        $category = RABDetail::all();

        return view('admin.rab.form', [
            'page_name' => 'Edit RAB',
            'data' => $datas,
            'category' => $category,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RAB  $RAB
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...
            $form = $request->except('_method', '_token');

            RAB::whereId($id)->update($form);
            
            DB::commit();
            return redirect('/admin/rab/rabs')->with('message', 'Data successfully created');

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RAB  $RAB
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       RAB::whereId($id)->delete();
    
       return response([
        'message' => 'Data successfully deleted !'
       ]);

    }
}

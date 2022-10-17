<?php

namespace App\Http\Controllers;

use App\Models\RAB;
use App\Models\RABDetail;
use App\Models\Work;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverBudgetController extends Controller
{
    public function index(Request $request)
    {
        $data = null;
        if($request->values != ''){
            $data = RAB::whereId($request->values)->get();
        }

        $rab = RAB::all();

        return view('admin.overbudget.index', [
            'datas' => $data,
            'rab' => $rab,
            'page_name' => 'Over Budget'
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RAB  $RAB
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = DB::table('r_a_b_details')
        ->where('rab_id', $id)
        ->join('work_types', 'r_a_b_details.work_category_id', '=', 'work_types.id')
        ->join('works', 'r_a_b_details.work_id', '=', 'works.id')
        ->select('work_types.name as category_name','r_a_b_details.*','r_a_b_details.id as detail_id','works.*')
        ->get()
        ->groupBy('category_name');


        return view('admin.overbudget.rabdetail.index', [
            'page_name' => 'Detail RAB',
            'datas' => $datas,
            'rab_id' => $id
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data = null;
        $workcategory = WorkType::all();
        $work = Work::all();
        

        return view('admin.overbudget.rabdetail.form', [
            'page_name' => 'Add RAB Detail',
            'data' => $data,
            'workcategory' => $workcategory,
            'work' => $work,
            'rab_id' => $id
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

            RABDetail::create($form);

            $datas = RAB::whereId($request->rab_id)->first();


            $real_cost = RABDetail::where('rab_id', $request->rab_id)->sum('sub_amount');

            $construction_service = ($datas->construction_service / 100) * $real_cost;

            $total = $construction_service + $real_cost;


            RAB::whereId($request->rab_id)->update([
                'real_cost' => $real_cost,
                'rounded_up_cost' => round($total)
            ]);

            DB::commit();
            return redirect('/admin/overbudget/'.$request->rab_id.'/detail')->with('message', 'Data successfully created');

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
     * @param  \App\Models\RABDetail  $RABDetail
     * @return \Illuminate\Http\Response
     */
    public function getDatas($id)
    {
        $data = Work::where('work_category_id', $id)->get();

        return response()->json([
            'message' => 'data found',
            'datas' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RABDetail  $RABDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = RABDetail::find($id);
        $workcategory = WorkType::all();
        $work = Work::all();
        

        return view('admin.overbudget.rabdetail.form', [
            'page_name' => 'Add RAB Detail',
            'data' => $data,
            'workcategory' => $workcategory,
            'work' => $work,
            'rab_id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RABDetail  $RABDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...
            $form = $request->except('_method', '_token', 'work_id');

            RABDetail::whereId($id)->update($form);
            $datas = RABDetail::find($id);

            $sum = RABDetail::where('work_id', $datas->work_id)->sum('sub_amount');


            Work::whereId($datas->work_id)->update([
                'total_amount' => $sum
            ]);
            DB::commit();


            return redirect('/admin/rab/rabs/'.$datas->work_id.'/detail')->with('message', 'Data successfully created');

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
     * @param  \App\Models\RABDetail  $RABDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $rab_id)
    {


       RABDetail::whereId($id)->delete();

       $datas = RAB::whereId($rab_id)->first();


       $real_cost = RABDetail::where('rab_id', $rab_id)->sum('sub_amount');

       $construction_service = ($datas->construction_service / 100) * $real_cost;

       $total = $construction_service + $real_cost;


       RAB::whereId($rab_id)->update([
           'real_cost' => $real_cost,
           'rounded_up_cost' => round($total)
       ]);

    
       return response([
        'message' => 'Data successfully deleted !'
       ]);

    }
}

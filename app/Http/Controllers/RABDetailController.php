<?php

namespace App\Http\Controllers;

use App\Models\RAB;
use App\Models\RABDetail;
use App\Models\Work;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RABDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        

        return view('admin.rab.rabdetail.form', [
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
                'rounded_up_cost' => round($total),
                'project_date' => $datas->project_date,
                'rab_cost' => $real_cost,
                'cco_cost' => $datas->cco_cost
            ]);

            DB::commit();
            return redirect('/admin/rab/rabs/'.$request->rab_id.'/detail')->with('message', 'Data successfully created');

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
        $data = RABDetail::with(['work'])->find($id);
        $workcategory = WorkType::all();
        $work = Work::all();    

        return view('admin.rab.rabdetail.form', [
            'page_name' => 'Add RAB Detail',
            'data' => $data,
            'workcategory' => $workcategory,
            'work' => $work,
            'rab_id' => $data->rab_id
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

            DB::commit();


            return redirect('/admin/rab/rabs/'.$datas->rab_id.'/detail')->with('message', 'Data successfully created');

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

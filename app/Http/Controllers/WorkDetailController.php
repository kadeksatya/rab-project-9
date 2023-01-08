<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Tool;
use App\Models\Work;
use App\Models\WorkDetail;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkDetailController extends Controller
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
        $material = Material::all();
        $tool = Tool::all();
        $worker = Worker::all();

        return view('admin.work.workdetail.form', [
            'page_name' => 'Tambah Detail Pekerjaan',
            'data' => $data,
            'material' => $material,
            'tool' => $tool,
            'worker' => $worker,
            'work_id' => $id
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

            WorkDetail::create($form);

            $sum = WorkDetail::where('work_id', $request->work_id)->sum('sub_amount');

            Work::whereId($request->work_id)->update([
                'total_amount' => $sum
            ]);

            DB::commit();
            return redirect('/admin/rab/work/'.$request->work_id.'/detail')->with('message', 'Data successfully created');

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
     * @param  \App\Models\Workdetail  $Workdetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workdetail  $Workdetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = WorkDetail::whereId($id)->with(['worker','material','tool'])->first();
        $material = Material::all();
        $tool = Tool::all();
        $worker = Worker::all();

        return view('admin.work.workdetail.form', [
            'page_name' => 'Edit Detail Pekerjaan',
            'data' => $data,
            'material' => $material,
            'tool' => $tool,
            'worker' => $worker,
            'work_id' => null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workdetail  $Workdetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...
            $form = $request->except('_method', '_token', 'work_id');
            Workdetail::whereId($id)->update($form);
            $datas = WorkDetail::find($id);

            $sum = WorkDetail::where('work_id', $datas->work_id)->sum('sub_amount');

            Work::whereId($datas->work_id)->update([
                'total_amount' => $sum
            ]);
            DB::commit();


            return redirect('/admin/rab/work/'.$datas->work_id.'/detail')->with('message', 'Data successfully created');

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
     * @param  \App\Models\Workdetail  $Workdetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Workdetail::whereId($id)->delete();
    
       return response([
        'message' => 'Data successfully deleted !'
       ]);

    }
}

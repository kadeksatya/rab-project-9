<?php

namespace App\Http\Controllers;

use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = WorkType::all();

        return view('admin.worktype.index', [
            'page_name' => 'Work Type',
            'datas' => $datas
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
        return view('admin.worktype.form', [
            'page_name' => 'Add Work Type',
            'data' => $data
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

            WorkType::create($form);
            DB::commit();
            return redirect('/admin/masterdata/worktype')->with('message', 'Data successfully created');

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
     * @param  \App\Models\WorkType  $WorkType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkType  $WorkType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = WorkType::find($id);

        return view('admin.worktype.form', [
            'page_name' => 'Edit Work Type',
            'data' => $datas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WorkType  $WorkType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...
            $form = $request->except('_method', '_token');

            WorkType::whereId($id)->update($form);
            
            DB::commit();
            return redirect('/admin/masterdata/worktype')->with('message', 'Data successfully created');

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
     * @param  \App\Models\WorkType  $WorkType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       WorkType::whereId($id)->delete();
    
       return response([
        'message' => 'Data successfully deleted !'
       ]);

    }
}

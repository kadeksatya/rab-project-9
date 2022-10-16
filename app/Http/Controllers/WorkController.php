<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\WorkDetail;
use App\Models\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Work::with('category')->get();

        return view('admin.work.index', [
            'page_name' => 'Work',
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
        $category = WorkType::all();

        return view('admin.work.form', [
            'page_name' => 'Add Work',
            'data' => $data,
            'category' => $category,
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

            Work::create($form);
            DB::commit();
            return redirect('/admin/rab/work')->with('message', 'Data successfully created');

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
     * @param  \App\Models\Work  $Work
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = WorkDetail::where('work_id', $id)->get();

        return view('admin.work.workdetail.index', [
            'page_name' => 'Detail Work',
            'datas' => $datas,
            'work_id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $Work
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = Work::find($id);
        $category = WorkType::all();

        return view('admin.work.form', [
            'page_name' => 'Edit Work',
            'data' => $datas,
            'category' => $category,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $Work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...
            $form = $request->except('_method', '_token');

            Work::whereId($id)->update($form);
            
            DB::commit();
            return redirect('/admin/rab/work')->with('message', 'Data successfully created');

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
     * @param  \App\Models\Work  $Work
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Work::whereId($id)->delete();
    
       return response([
        'message' => 'Data successfully deleted !'
       ]);

    }
}

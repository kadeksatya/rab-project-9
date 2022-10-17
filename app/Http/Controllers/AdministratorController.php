<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = User::all();

        return view('admin.administrator.index', [
            'page_name' => 'User',
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
        $role = Roles::all();
        return view('admin.administrator.form', [
            'page_name' => 'Add User',
            'data' => $data,
            'role' => $role,
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
            $form = array(
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'role_id' => $request->role_id
            );

            User::create($form);
            DB::commit();
            return redirect('/admin/administrator')->with('message', 'Data successfully created');

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
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = User::find($id);
        $role = Roles::all();

        return view('admin.administrator.form', [
            'page_name' => 'Edit User',
            'data' => $datas,
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            //code...

            if($request->password != ''){
                $form = array(
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make('password'),
                    'role_id' => $request->role_id
                );
    
            }else{
                $form = array(
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'role_id' => $request->role_id
                );
    
            }

            User::whereId($id)->update($form);
            
            DB::commit();
            return redirect('/admin/administrator')->with('message', 'Data successfully created');

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
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       User::whereId($id)->delete();
    
       return response([
        'message' => 'Data successfully deleted !'
       ]);

    }
}


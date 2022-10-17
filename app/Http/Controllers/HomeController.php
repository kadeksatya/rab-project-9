<?php

namespace App\Http\Controllers;

use App\Models\RAB;
use App\Models\Worker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        # code...

        $project = RAB::count();
        $worker = Worker::count();

        return view('admin.dashboard.index', [
            'page_name' => 'Dashboard',
            'project' => $project,
            'worker' => $worker,

        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select(['id', 'name', 'email'])->get();

            return DataTables::of($data)->make(true);
        }

        return abort(404);
    }
}

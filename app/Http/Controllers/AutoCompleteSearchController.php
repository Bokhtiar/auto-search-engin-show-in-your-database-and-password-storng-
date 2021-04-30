<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AutoCompleteSearchController extends Controller
{
    public function index()
    {
        return view('auto_complete_search');
    }

    // return search results
    public function query(Request $request)
    {
        $input = $request->all();

        $data = User::select("name")
            ->where("name", "LIKE", "%{$input['query']}%")
            ->get();

        return response()->json($data);
    }
}

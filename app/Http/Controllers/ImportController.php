<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CallsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Calls;

class ImportController extends Controller
{
    public function index()
    {
        return view('import-form');
    }

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required',
        ]);

        Excel::import(new CallsImport,$request->file('file'));

        return redirect('/')->with('status', 'The records are inserted into database');
    }
}

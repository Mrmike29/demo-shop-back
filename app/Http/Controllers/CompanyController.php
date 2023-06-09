<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    // Get all Companies
    public function all() { 
        return DB::table('company AS COM')
            ->join('country AS COU', 'COM.id_country', '=', 'COU.id')
            ->where('COM.state', 'Active')
            ->select(
                'COM.NIT', 
                'COM.NIT-DV AS dv', 
                'COM.name', 
                'COU.name AS country', 
                'COM.address', 
                'COM.phone', 
            )->get();
    }

    // Create new Company
    public function store(Request $request) {
        try {
            $query = DB::table('company')->insert(
                [
                    'id_country' => $request->country,
                    'NIT' => $request->nit,
                    'NIT-DV' => $request->dv,
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'state' => 'Active'
                ]
            );
    
            if ($query) {
                return response()->json(['success' => true]);
            }
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }

    // Delete Company
    public function delete(Request $request) {
        $query = DB::table('company')
            ->where('NIT', $request->NIT)
            ->update(['state' => 'Disabled']);

        if ($query) {
            return response()->json(['success' => true]);
        }
    }
}

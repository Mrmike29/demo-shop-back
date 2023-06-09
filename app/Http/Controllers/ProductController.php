<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Get all products or one by id
    public function all(Request $request) {
        $prods = DB::table('product AS PRO')
            ->leftJoin('company AS COM', 'PRO.id_company', '=', 'COM.NIT')
            ->leftJoin('country AS COU', 'COM.id_country', '=', 'COU.id')
            ->where('PRO.state', 'Active')
            ->select(
                'PRO.*', 
                'COM.name AS company',
                'COU.local-currency AS currency' 
            );
        
        $catProds = DB::table('product_category AS PC')
            ->leftJoin('category AS CAT', 'PC.id_category', '=', 'CAT.id')
            ->select('CAT.name AS category', 'PC.id_product as prod');
        
        if (isset($request->id)) {
            $prods = $prods->where('PRO.id', $request->id);
            $catProds = $catProds->where('PC.id_product', $request->id);
        }
        
        $prods = $prods->get();
        $catProds = $catProds->get();

        return response()->json(['success' => true, 'data' => ['products' => $prods, 'categories' => $catProds]]);
    }

    // Create new Product
    public function store(Request $request) {
        try {
            $array = $request->category;
            $cPData = [];

            $id = DB::table('product')->insertGetId(
                [
                    'id_company' => $request->company,
                    'name' => $request->name,
                    'description' => $request->description,
                    'stock' => $request->stock,
                    'price' => $request->price,
                    'state' => 'Active'
                ]
            );
    
            if ($id) {
                foreach ($array as $value) {
                    if(isset($value['id'])) {
                        array_push($cPData, ['id_category' => $value['id'], 'id_product' => $id ]);
                    }
                }
    
                $query = DB::table('product_category')->insert($cPData);
    
                if ($query) {
                    return response()->json(['success' => true, 'product' => ['id' => $id]]);
                }
            }
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }

    // Delete Product
    public function delete(Request $request) {
        $query = DB::table('product')
            ->where('id', $request->id)
            ->update(['state' => 'Disabled']);

        if ($query) {
            return response()->json(['success' => true]);
        }
    }
}

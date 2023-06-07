<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Get all products or one by id
    public function all(Request $request) {
        $prods = DB::table('product AS PRO')
            ->leftJoin('product_category AS PC', 'PC.id_product', '=', 'PRO.id')
            ->leftJoin('category AS CAT', 'PC.id_category', '=', 'CAT.id')
            ->leftJoin('company AS COM', 'PRO.id_company', '=', 'COM.NIT')
            ->leftJoin('country AS COU', 'COM.id_country', '=', 'COU.id')
            ->where('PRO.state', 'Active')
            ->select(
                'PRO.*', 
                'CAT.name AS category', 
                'COM.name AS company',
                'COU.local-currency AS currency' 
            );
        
            if (isset($request->id)) {
            $prods = $prods->where('PRO.id', $request->id);
        }
        
        $prods = $prods->get();

        return $prods;
    }

    // Create new Product
    public function store(Request $request) {
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
            $query = DB::table('product_category')->insertGetId(
                [
                    'id_category' => $request->category,
                    'id_product' => $id
                ]
            );

            if ($query) {
                return response()->json(['success' => true, 'product' => ['id' => $id]]);
            }
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

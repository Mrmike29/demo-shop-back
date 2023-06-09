<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Get all Orders or one by id
    public function all(Request $request) {
        $orders = DB::table('order AS ORD')
            ->leftJoin('order_product AS OP', 'OP.id_order', '=', 'ORD.id')
            ->leftJoin('product AS PRO', 'OP.id_product', '=', 'PRO.id')
            ->leftJoin('user AS US', 'ORD.id_user', '=', 'US.id')
            ->select(
                'OP.id',
                'ORD.number', 
                'US.email', 
                'PRO.name AS product',
                'OP.quantity' 
            );
        
        if (isset($request->id)) {
            $orders = $orders->where('US.id', $request->id);
        }
        
        $orders = $orders->get();

        return $orders;
    }

    // Create new Order
    public function store(Request $request) {
        try {
            $array = json_decode($request->cartData, true);
            $oPData = [];
            
            $number = 'ORD-' . $request->idUser . date("Ymdhis");
            $id = DB::table('order')->insertGetId(
                [
                    'id_user' => $request->idUser,
                    'number' => $number
                ]
            );

            foreach ($array as $value) {
                if(isset($value['id'])) {
                    array_push($oPData, ['id_order' => $id, 'id_product' => $value['id'], 'quantity' => $value['quan']]);

                    $prods = DB::table('product AS PRO')
                        ->where('PRO.id', $value['id'])
                        ->select('PRO.stock')
                        ->get();

                    $query = DB::table('product')
                        ->where('id', $value['id'])
                        ->update(['stock' => $prods[0]->stock - $value['quan']]);
                }
            }

            if ($id) {
                $query = DB::table('order_product')->insert($oPData);

                if ($query) {
                    return response()->json(['success' => true, 'order' => ['id' => $id]]);
                }
            }
        } catch (\Throwable $th) {
            print_r($th->getMessage());
        }
    }
}

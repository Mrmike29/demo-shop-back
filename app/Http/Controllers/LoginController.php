<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function getUser(Request $request) { // fetch all todos
        
        // print_r(Crypt::encrypt($request->password));
        $user = DB::table('user')
            ->where('email', $request->email)
            ->where('password', sha1($request->password))
            ->get();

        
        if (isset($user[0])) {
            return response()->json(['success' => true, 'user' => ['id' => $user[0]->id, 'id_rol' => $user[0]->id_rol]]);
        }

        return response()->json(['success' => false]);
    }
     

    public function store(Request $request) { // fetch all todos
        $id = DB::table('user')->insertGetId(
            [
                'id_rol' => 2,
                'id_country' => $request->country,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'cell_phone' => $request->cell_phone,
                'password' => sha1($request->password)
            ]
        );

        if ($id) {
            return response()->json(['success' => true, 'user' => ['id' => $id]]);
        }
    }

    //
}

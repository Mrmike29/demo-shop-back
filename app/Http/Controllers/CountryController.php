<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountryController extends Controller
{
    // Get all Countries
    public function all() {
        return DB::select("SELECT * FROM country");
    }
}

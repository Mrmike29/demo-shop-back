<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Get all Categories
    public function all() {
        return DB::select("SELECT * FROM category");
    }
}

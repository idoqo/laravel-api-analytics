<?php
namespace App\Http\Controllers\Api;

use App\Hit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HitsController extends Controller
{
    public function index() {
        $hits = Hit::orderBy('created_at', 'desc')->get();
        return response()->json($hits);
    }
}

<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecipesController extends Controller
{
    public function index() {
        $recipes = Recipe::orderBy('created_at', 'desc')->get();
        return response()->json($recipes);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $recipe = new Recipe([
            'name' => $request->name,
            'body' => $request->body
        ]);
        $recipe->save();
        return response()->json($recipe, 201);
    }

    public function show($id) {
        $recipe = Recipe::findOrFail($id);
        return response()->json($recipe);
    }

    public function update(Request $request, $id) {
        $recipe = Recipe::findOrFail($id);
        $recipe->update(['name' => $request->name, 'body' => $request->body]);

        return response()->json($recipe);
    }

    public function destroy($id) {
        Recipe::findOrFail($id)->delete();
        return response()->json();
    }
}

<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        return view('backend.category.index');
    }

    public function store(Request $request) {
        $data = $this->validateCategory();

          // Generate the slug from the category name
         $data['category_slug'] = Str::slug($request->category_name);

        try {
            DB::beginTransaction();
            Category::create($data);
            DB::commit();
        } catch(QueryException $ex) {
            DB::rollBack();
            dd($ex);
        }
        return redirect(route('category.index'))->with('success', 'category added successfully');
    }

    private function validateCategory() {
        return request()->validate([
            'category_name' => ['required', 'min:3', 'max:50']
        ]);
    }
}

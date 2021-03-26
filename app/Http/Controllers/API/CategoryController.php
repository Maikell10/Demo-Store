<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\MainCategory;
use App\SubCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$cat = new Category();
        $cat->nombre = 'Mujer';
        $cat->slug = 'mujer';
        $cat->descripcion = 'Ropa de Mujer';
        $cat->save();
        return $cat;*/

        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if (Category::where('slug',$slug)->first()) {
            return 'Slug existe';
        }else {
            return 'Slug disponible';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSubCategories(Request $request){
        //return SubCategory::all();
        if ($request->ajax()) {
            $subCategories = SubCategory::where('category_id', $request->category_id)->orderBy('nombre')->get();
            foreach ($subCategories as $subCategory) {
                $subCategoriesArray[$subCategory->id] = $subCategory->nombre;
            }

            if (count($subCategories) != 0) {
                return response()->json($subCategoriesArray);
            }
            $subCategoriesArray = '';
            return response()->json($subCategoriesArray);
        }
    }

    public function getMainCategories(Request $request){
        if ($request->ajax()) {
            $mainCategories = MainCategory::where('sub_category_id', $request->sub_category_id)->orderBy('nombre')->get();
            foreach ($mainCategories as $mainCategory) {
                $mainCategoriesArray[$mainCategory->id] = $mainCategory->nombre;
            }

            if (count($mainCategories) != 0) {
                return response()->json($mainCategoriesArray);
            }
            $mainCategoriesArray = '';
            return response()->json($mainCategoriesArray);
        }
    }
}

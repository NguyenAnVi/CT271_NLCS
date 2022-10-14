<?php
namespace App\Http\Services;
use App\Models\Category;

class CategoryService
{
    public function getParent($n = 0)
    {
        return Category::where('parent_id', $n)->get();
    }

    

    public function destroy($request)
    {
        $id = (int) $request->input('id');
        $menu = Category::where('id', $request->input('id'))->first();

        if ($menu){
            return Category::where('id', $id)->orWhere('parent_id')->delete();

        }
        return false;
    }
}
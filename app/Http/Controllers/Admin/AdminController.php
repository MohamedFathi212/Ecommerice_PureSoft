<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $subcategoriesCount = SubCategory::count();
        $productsCount = Product::count();
        $categories = Category::all();
        $subcategories = SubCategory::all();

        return view('admin.dashboard', compact(
            'usersCount',
            'categoriesCount',
            'subcategoriesCount',
            'productsCount',
            'categories',
            'subcategories'
        ));
    }
}

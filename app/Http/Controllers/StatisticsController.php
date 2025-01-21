<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'invoice' => Invoice::count(),
            'products' => Product::count(),
        ];

        return view('admin.statistics.index', compact('stats'));
    }
}
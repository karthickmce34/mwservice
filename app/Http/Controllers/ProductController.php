<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;


use App\Models\ProductModel;


class ProductController extends Controller
{
    public $modelName       = 'App\Models\ProductModel';
    public $baseRedirect    = 'product.index';
    public $baseName        = 'product';
    public $basePath        = 'product/';
    public $detailName   = 'ProductController@getIndex';
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    
}

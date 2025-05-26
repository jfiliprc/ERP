<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Helpers\View;

class HomeController
{
    public function index()
    {
        View::render('home');
    }
}
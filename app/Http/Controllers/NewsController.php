<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function danhsachtintuc(){
        return view('news.danh_sach_tin_tuc');
    }
    public function chitiettintuc(){
        return view('news.chi_tiet_tin_tuc');
    }
    public function quanlytintuc(){
        return view('news.quan_ly_tin_tuc');
    }
}

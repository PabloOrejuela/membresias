<?php

namespace App\Controllers;

class Home extends BaseController {
    
    public function index(): string {

        $data['title']='Lista de membresías';
        $data['main_content']='membresias/membresias_view';
        //return view('includes/template', $data);
        return view('home/inicio_view');
    }
}

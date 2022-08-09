<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewChatBot extends Controller
{

    public function page(){
        return view('main.main-page');
    }
}

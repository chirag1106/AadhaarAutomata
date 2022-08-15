<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class getRequestController extends Controller
{
    public function getAadharService($menu){
        if(isset($menu)){
            echo $menu;
        }
        else{

        }
    }
}

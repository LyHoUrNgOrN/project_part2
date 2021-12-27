<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AluminiController extends Controller
{
    public function getAlu(){
        $alumini = storage_path('app\alumini\alumini.json');
        $aluminies = json_decode(file_get_contents($alumini),true);
        return $aluminies;
    }
}

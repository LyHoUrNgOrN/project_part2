<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountries(){
        $countriesPath = storage_path('app\country\canbodia.json');
        $countries = json_decode(file_get_contents($countriesPath),true);
        return $countries;
    }
}

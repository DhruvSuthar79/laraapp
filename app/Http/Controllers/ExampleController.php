<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function homepage()
    {
        return view( 'home' );
    }

    public function singlePost()
    {
        $countries = ['India', 'Pakistan', 'Canada', 'Austrelia'];
        return view( 'single-post', [ 'countries' => $countries ] );
    }
}

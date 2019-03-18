<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function show()
    {
        return view( 'profiles.show' );
    }

}

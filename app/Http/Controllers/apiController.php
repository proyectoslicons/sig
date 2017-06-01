<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;


class apiController extends Controller
{
    public function getUsers()
    {
        return Datatables::eloquent(\App\User::query())->make(true);
    }
}

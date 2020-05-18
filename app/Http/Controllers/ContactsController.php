<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function get()
    {
        $contacts =  Auth::user()->friends();
        return response()->json($contacts);
    }
}

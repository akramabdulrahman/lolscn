<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FilesController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    function cover(){
         $filepath = storage_path() . User::find($userID)->cover;
    return Response::download($filepath);
    }
    function avatar(){
        $filepath = storage_path() . User::find($userID)->avatar;
    return Response::download($filepath);
    }
}

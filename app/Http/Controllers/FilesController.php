<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;

class FilesController extends Controller
{
    public function __construct() {
        parent::__construct();
    }
    function cover($userID){
         $filepath = storage_path() . User::find($userID)->cover;
    return response()->download($filepath);
    }
    function avatar($userID){
        $filepath = storage_path() . User::find($userID)->avatar;
    return response()->download($filepath);
    }
}

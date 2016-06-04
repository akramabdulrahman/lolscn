<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Search\Search;
use Helpers;
class SearchController extends Controller {

    public function search($filter = null) {
        $search = Input::get('query');
        $results = $filter ? Search::$filter($search) : Search::all($search);
        return view('partials.search.search')->with(array('search' => array('results' => $results, 'query'=>$search,'filter' => $filter)));
    }

    public function matches() {
        
    }

    public function usersAndSummoners() {
        
    }

}

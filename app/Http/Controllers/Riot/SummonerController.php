<?php

namespace App\Http\Controllers\Riot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Riot\Summoner;

class SummonerController extends Controller {

    public function add() {
        $values = Input::only($user->getFillable());
        $summoner = Summoner::firstOrCreate([
                        //by summoner name and id and server id 
        ]);
       
        //0 =unowned 1 =pending ownership 2 =owned
        if ($summoner->status != 2) {
            $summoner->status = 1;
            $summoner->save();
            Auth::user()->summoners()->attach($summoner->id);
            session()->flash('message', 'nice , now this summoner needs ownership verification');
        } else {
            session()->flash('error', 'this summoner was verified before for  ' . $summoner->owner());
        }
        return redirect()->back();
    }

    public function renew() {
        //get summoner data from the driver , then perform sth similar to this 
        $user = Auth::user();
        try {
            $values = Input::only($user->getFillable());
            $user->update($values);
        } catch (Exception $ex) {
            return response($ex->getMessage(), 400);
        }
    }

    public function detach($id) {
        $summoner = Summoner::firstOrFail($id);
        $summoner->status = 0;
        $summoner->users()->dettach();
        return redirect()->back();
    }

}

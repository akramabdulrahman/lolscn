<?php

namespace App\Http\Controllers\Riot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Riot\Summoner;
use App\Mailers\SummonerVerificationMailer;
use App\Models\Riot\Servers;
use Riot\Facades\Api as R_API;
use Riot\Facades\EndPoints;
use Auth;
use URL;

class SummonerController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('verified');
    }

    public function index() {
        return 'asdas';
    }

    protected function SummonerExists($region, $summonerName) {
        $obj;
//make a request to riot driver with summoner name  
        try {
            $sum = new EndPoints\SummonerByName();

            $summoner = R_API::get($sum->buildUrl(array(
                                'summonerNames' => strtolower($summonerName),
                                'region' => $region
            )));
            $SummonerObject = $sum->store('\App\Models\Riot\Summoner', $summoner, $region, $summonerName);
        } catch (WrongHttpResponse $ex) {
            session()->flash($ex);
            redirect()->back();
        }

        return $SummonerObject;
        // if it doesnt exist redirect back with errors that the summoner doesnt exist 
        //if exists  return summoner model object containing summoner details 
    }

    public function add() {

        Summoner::firstOrCreate(Input::only(Summoner::getFillable()));

//        $values = Input::only($user->getFillable());
//        $summoner = Summoner::firstOrCreate([
//                        //by summoner name and id and server id 
//        ]);
//
//        //0 =unowned 1 =pending ownership 2 =owned
//        if ($summoner->status != 2) {
//            $summoner->status = 1;
//            $summoner->save();
//            Auth::user()->summoners()->attach($summoner->id);
//            session()->flash('message', 'nice , now this summoner needs ownership verification');
//        } else {
//            session()->flash('error', 'this summoner was verified before for  ' . $summoner->owner());
//        }
//        return redirect()->back();
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

    public function verify($region, $summonerName, SummonerVerificationMailer $mailer) {
        $summoner = $this->SummonerExists($region, $summonerName);
        if ($summoner->exists) {

            if (is_null($summoner->users()->first())) {
                $mailer->sendEmailConfirmationTo(Auth::user(), $summoner);
                return redirect('/')->with('status', 'an email was sent to '.Auth::user()->email.' containing the token');
            } else {

                return redirect('/')->with('error', 'this summoner is already verified for another user');
            }
        }
    }

    public function check($summonerId) {
        $sum = new EndPoints\SummonerByIdRunes();
        $summoner = Summoner::whereToken(Auth::user()->token)->firstOrFail();

        $data = R_API::get($sum->buildUrl(array(
                            'summonerIds' => $summoner->riot_id,
                            'region' => $summoner->server
        )));
        $riotId = $summoner->riot_id;
        $runes = json_decode($data->getContents())->$riotId->pages;
        $flag = -1;
        for ($i = count($runes) - 1; $i >= 0; $i--) {
            if ($runes[$i]->name == $summoner->token) {
                $flag = $i;
                break;
            }
        }
        $flash = [];
        if ($flag != -1) {
            Auth::user()->summoners()->attach($summoner->id);
            Auth::user()->token = '';
            Auth::user()->save();
            $summoner->token = '';
            $summoner->save();
            $flash = array('status' => 'summoner is verified');
        } else {
            $flash = array('error' => "summoner is not yet verified");
        }
        return redirect('/')->with($flash);
    }

}

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
        $summoners = Auth::user()->summoners()->get()->all();
        return view('summoners', compact('summoners'));
    }

    protected function SummonerExists($summonerName, $region) {
//make a request to riot driver with summoner name  
        return Summoner::getSummonerFromRiot($summonerName, $region);
        // if it doesnt exist redirect back with errors that the summoner doesnt exist 
        //if exists  return summoner model object containing summoner details 
    }

    public function show($id) {

        $summoner = Summoner::find($id);
        dd($summoner->ingame());
        return view('summoner', compact('summoner'));
    }

    public function add() {
        
    }

    public function refresh($summonerId) {
        $summoner = Summoner::find($summonerId);
        $summoner->UpdateSummonerProps();
        return redirect()->back()->with(array('status' => "summoner info updated "));
    }

    public function detach($id) {
        $summoner = Summoner::firstOrFail($id);
        $summoner->status = 0;
        $summoner->users()->dettach();
        return redirect()->back();
    }

    public function verify($region, $summonerName, SummonerVerificationMailer $mailer) {
        $summoner = $this->SummonerExists($summonerName, $region);
        if ($summoner->exists) {

            if (is_null($summoner->users()->first())) {
                $mailer->sendEmailConfirmationTo(Auth::user(), $summoner);
                return redirect('/summoners/' . $summoner->id)->with('status', 'an email was sent to ' . Auth::user()->email . ' containing the token');
            } else {

                return redirect('/summoners/' . $summoner->id)->with('error', 'this summoner is already verified for another user');
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

    public function champions($id, $season) {
        $summoner = Summoner::find($id);

        if (!in_array($season, config('ritoseasons'))) {
            return redirect()->back()->with(array('error' => 'the season you forged wont work'));
        }
        $champ = $summoner->championsStatsFromRiot($season);
        if (!is_null($champ)) {
            $wariors = json_decode($champ->getContents(), true);
            return view('champions', compact('wariors', 'summoner', 'season'));
        } else {
            return redirect()->back()->with(array('error' => 'summoner wasnt playing at ' . $season));
        }
    }

}

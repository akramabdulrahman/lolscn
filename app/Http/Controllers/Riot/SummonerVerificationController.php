<?php

namespace App\Http\Controllers\Riot;

use App\Http\Controllers\Controller;
use App\Mailers\SummonerVerificationMailer;
use App\Models\Riot\Summoner;
use Auth;
use Riot\Facades\Api as R_API;
use Riot\Facades\EndPoints;
use function GuzzleHttp\json_decode;
use function redirect;
use function session;
use function view;
use Illuminate\Support\Facades\Input;
class SummonerVerificationController extends Controller
{
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
        if (strlen($summonerName) >= 4) {
            return Summoner::getSummonerFromRiot($summonerName, $region);
        } else {
            session()->flash('error', 'invalid summoner name');
            return null;
        }
        //// if it doesnt exist redirect back with errors that the summoner doesnt exist 
        //if exists  return summoner model object containing summoner details 
    }
     public function verify($region, $summonerName, SummonerVerificationMailer $mailer) {
        $summoner = $this->SummonerExists($summonerName, $region);
        if (!is_null($summoner) && $summoner->exists) {
            if (!($summoner->hasUser())) {
                $mailer->sendEmailConfirmationTo(Auth::user(), $summoner);
                return redirect('/summoners/' . $summoner->id)->with('status', 'an email was sent to ' . Auth::user()->email . ' containing the token');
            } else {

                return redirect('/summoners/' . $summoner->id)->with('error', 'this summoner is already verified for another user');
            }
        }
        return redirect('/');
    }
    
        public function post_verify( SummonerVerificationMailer $mailer){
            dd(Input::get('name'),Input::get('server'));
            return $this->verify(Input::get('name'), Input::get('server'),$mailer);
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

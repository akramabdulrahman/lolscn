<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Social\Clan;
use Auth;

class ClansController extends Controller {

    public function index() {
        $clans = Auth::user()->clans()->all();
        return view('clans', compact('clans'));
    }

    public function show($id) {
        $clan = Clan::findOrFail($id);
        
        $membersIds = $clan->users->map(function ($user) {
             return $user->id;
        })->toArray();
        
        return view('clan', compact('clan','membersIds'));
    }

    public function add() {
        return implode(',', Input::get('members'));
    }

    public function join($id) {
        $clan = Clan::findOrFail($id);
        Auth::user()->clans()->attach($clan);
        session()->flash('status', 'successfully joined ' . $clan->name);
        return redirect('clans/' . $clan->id);
    }

    public function abandon($id) {
        $clan = Clan::findOrFail($id);
        Auth::user()->clans()->detach($clan);
        session()->flash('status', 'successfully abandoned ' . $clan->name);
        return redirect('/');
    }

}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class UserController extends Controller {

    use ResetsPasswords;

    public function __construct() {
        $this->middleware('auth');
    }

    public function newPassword(Request $request) {


        if (Auth::user()->hasPassword()) {
            $rules = array(
                'old_password' => 'required',
                'new_password' => 'required|different:old_password|confirmed',
                'new_password_confirmation' => 'required'
            );

            $validator = Validator::make($request->input(), $rules);

            if (!Auth::validate(array('email' => Auth::user()->email, 'password' => $request->input('old_password')))) {

                $validator->getMessageBag()->add('password', 'That password is incorrect.');
                return redirect()->back()->withErrors($validator);
            }

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $user = Auth::user();
            $user->password = Hash::make($request->input('new_password'));
            if ($user->save()) {
                return redirect()->back();
            }
        } else {
//            Auth::logout();
//            return redirect('/');

            $broker = $this->getBroker();

            $response = Password::broker($broker)->sendResetLink(
                    array('email' => Auth::user()->email), $this->resetEmailBuilder()
            );

            switch ($response) {
                case Password::RESET_LINK_SENT:
                    $user = Auth::user();
                    session()->flash('message', trans('flashmessages.mail_sent', ['email' => $user->email]));

                    return $this->getSendResetLinkEmailSuccessResponse($response);
                case Password::INVALID_USER:
                default:
                    return $this->getSendResetLinkEmailFailureResponse($response);
            }
        }
    }

    public function updateDetails(Request $request) {
        Auth::user()->update(Input::only(['name', 'nickname', 'email', 'mobile', 'email', 'country_id']));
    }

}

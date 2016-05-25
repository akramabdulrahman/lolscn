<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index() {

        $currentUserId = Auth::user()->id;

        // All threads, ignore deleted/archived participants
        // $threads = Thread::getAllLatest()->get();
        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();

        // All threads that user is participating in, with new messages
        // $threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        $threads = Thread::forUser(Auth::user()->id)->latest('updated_at')->distinct('id')->get();
        $activeThreadMessages = [];
        $activethread = '';
        if (count($threads) > 0) {
            $activeThreadMessages = $threads[0]->messages()->get();
            $activethread = $threads[0]->id;
            $threads[0]->markAsRead($currentUserId);
        }

        return view('messages', compact('threads', 'activeThreadMessages', 'activethread'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id) {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();
        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);
        $threads = Thread::forUser(Auth::user()->id)->latest('updated_at')->distinct('id')->get();
        $activeThreadMessages = $thread->messages()->get();
        $activethread = $thread->id;
        return view('messages', compact('threads', 'activeThreadMessages', 'activethread'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create() {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function messageToUser($id) {

        $thread = Thread::where('subject', '=', Auth::user()->id . "_" . $id)->orWhere('subject', '=', $id . "_" . Auth::user()->id)->first();
        if ($thread === null) {
            $thread = Thread::firstOrCreate(
                            [
                                'subject' => Auth::user()->id . "_" . $id,
            ]);
            $thread->addParticipants([$id]);
        }
        return redirect('messages/' . $thread->id);
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store() {
        $input = Input::all();
        $thread = Thread::firstOrCreate(
                        [
                            'subject' => Auth::user()->id . "_" . $input['to'],
                        ]
        );

        // Message
        Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id' => Auth::user()->id,
                    'body' => $input['body'],
                ]
        );

        // Sender
        Participant::create(
                [
                    'thread_id' => $thread->id,
                    'user_id' => Auth::user()->id,
                    'last_read' => new Carbon,
                ]
        );

        // Recipients
        if (Input::has('to')) {
            $to = [];
            if (Is_String($input['to'])) {
                $to = explode(',', $input['to']);
            } else if (is_array($input['to'])) {
                $to = $input['to'];
            }
            $thread->addParticipants($to);
        }

        return redirect('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id) {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
                [
                    'thread_id' => $thread->id,
                    'user_id' => Auth::id(),
                    'body' => Input::get('body'),
                ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
                        [
                            'thread_id' => $thread->id,
                            'user_id' => Auth::user()->id,
                        ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants(Input::get('recipients'));
        }

        return redirect('messages/' . $id);
    }

}

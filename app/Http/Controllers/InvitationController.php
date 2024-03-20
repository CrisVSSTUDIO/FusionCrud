<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInvitationRequest;
use Illuminate\Hashing\BcryptHasher;

class InvitationController extends Controller
{
    //
    public function index()
    {
        $invitations = Invitation::where('registered_at', null)->orderBy('created_at', 'desc')->get();
        return view('invitations.index', compact('invitations'));
    }
    public function store(StoreInvitationRequest $request)
    {
        //
        $invitation = new Invitation([
            'email' => $request->get('email'),
            'invitation_token' => bcrypt( $request->get('email') . time())

        ]);
        $invitation->save();

        return redirect()->route('requestInvitation')
            ->with('success', 'Invitation to register successfully requested. Please wait for registration link.');
    }
}

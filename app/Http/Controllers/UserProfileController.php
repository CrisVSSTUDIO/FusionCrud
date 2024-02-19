<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    //
    public function index()
    {
        return view('auth.profile');
    }
    public function update(Request $request) //updates the user data
    {
        try {
            $validador = Validator::make(
                $request->all(),

                [
                    'name' => 'required|max:255',
                    'password' => 'sometimes|nullable|confirmed|min:8',

                ]
            );
            if ($validador->fails()) {
                return back()->withErrors($validador)->withInput();
            } else {

                if (!is_null($request->input('password'))) {
                    User::whereId(Auth::user()->id)->update([
                        'password' => Hash::make($request->input('password')),
                    ]);
                }
                /*  if ($request->hasFile('upload')) {
                    //if the user wants to update the file
                    $oldPath = User::findOrFail(Auth::user()->id)->upload;
                    if ($oldPath) {
                        Storage::delete($oldPath);
                    }
                    $path = $request->file('upload')->storeAs('public', time() . '_' . $request->file('upload')->getClientOriginalName());
                    User::whereId(Auth::user()->id)->update([
                        'upload' => $path,
                    ]);
                } */
                User::whereId(Auth::user()->id)->update([
                    'name' => $request->get('name'),
                ]);
                return back()->with('success', 'Conta editada com sucesso!');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }
}

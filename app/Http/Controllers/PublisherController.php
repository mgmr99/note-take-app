<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function publisherRegister(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'min:3','max:20'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5','max:20']
        ]);
        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);
        $user->assignRole('publisher');
        auth()->login($user);
        return redirect()->route('publisher.dashboard');
    }
    public function publisherLogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5','max:20']
        ]); 
        $publishercred = Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);
        $user = auth()->user();
        if($publishercred  && $user->hasRole('publisher')){
            $request->session()->regenerate();
            return redirect()->intended(route('publisher.dashboard'));          
        }else{
            return redirect()->route('publisher.login')->withErrors([
                'matcherror' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function publisherDashboard(){
        $users = User::all();
        $notes = Note::all();
        return view('publisher.dashboard', compact(['users', 'notes']));
    }

    public function userNotes(User $user){
        $notes = $user->userNotes()->latest()->get();
        return view('publisher.userNotes', compact(['notes']));
    }

    public function changeStatus(Note $note){
        $note->status = !$note->status;
        $note->save();
        return redirect()->route('publisher.userNotes', $note->user_id);
    }

    public function deleteUser(User $user){
        $user->delete();
        return redirect()->route('publisher.dashboard');
    }
     public function publisherLogout()
    {
        auth()->logout();
        session()->flush();
        return redirect('/');
    }
}

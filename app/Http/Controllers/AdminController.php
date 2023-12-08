<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function adminRegister(Request $request){
        $credentials = $request->validate([
            'name' => ['required', 'min:3','max:20'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5','max:20']
        ]);
        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);
        $user->assignRole('admin');
        auth()->login($user);
        return redirect()->route('admin.dashboard');
    }
    public function adminLogin(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5','max:20']
        ]); 
        $admincred = Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]);
        $user = auth()->user();
        if($admincred  && $user->hasRole('admin')){
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));          
        }else{
            return redirect()->route('admin.login')->withErrors([
                'matcherror' => 'The provided credentials do not match our records.',
            ]);

        }
    }

    public function adminDashboard(){
        $users = User::all();
        $notes = Note::all();
        return view('admin.dashboard', compact(['users', 'notes']));
    }
    public function deleteUser(User $user){
        $user->delete();
        return redirect()->route('admin.dashboard');
    }

    public function makeAdmin(User $user){
        if(!$user->hasRole('admin')){
            $user->assignRole('admin');
        }
        $user->assignRole('user');
        return redirect()->route('admin.dashboard');
    }
    public function userNotes(User $user){
        $notes = $user->userNotes()->latest()->get();
        return view('admin.userNotes', compact(['notes']));
    }

    public function editNotes(Note $note){
        return view('admin.edituserNotes', compact(['note']));
    }

    public function updateNotes(Request $request, Note $note){
        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();
        return redirect()->route('admin.dashboard');
    }

    public function deleteNote(Note $note){
        $note->delete();
        return redirect()->back();
    }

    public function adminLogout(){
        auth()->logout();
        session()->flush();
        return redirect()->route('admin.login');
    }
}

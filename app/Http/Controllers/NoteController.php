<?php

namespace App\Http\Controllers;
use App\Models\Note;

use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function createNote(Request $request)
    {
        $incomingFields = $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['content']=strip_tags($incomingFields['content']);


        $incomingFields['user_id'] = auth()->user()->id;
        Note::create($incomingFields);  
        return redirect('/home');
    }   

    public function editNote(Note $note)
    {
        if(auth()->user()->id !== $note['user_id']  ){
            return redirect('/home');
        }
        return view('edit-note', ['note' => $note]);
    }

    public function updateNote(Note $note,Request $request)
    {
        if(auth()->user()->id !== $note['user_id']  ){
            return redirect('/home');
        }

        $incomingFields = $request->validate([
            'title' => ['required'],
            'content' => ['required']
        ]);

        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['content']=strip_tags($incomingFields['content']);

        $note->update($incomingFields);
        return redirect('/home');
    }

    public function deleteNote(Note $note)
    {
        if(auth()->user()->id !== $note['user_id']  ){
            return redirect('/home');
        }
        $note->delete();
        return redirect('/home');
    }
    public function deleteNoteAdmin(Note $note)
    {
        $note->delete();
        return redirect()->route('admin.dashboard');
    }
}

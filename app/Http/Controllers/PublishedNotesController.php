<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class PublishedNotesController extends Controller
{
    public function index()
    {
        $notes = Note::where('status', true)->latest()->get();
        return view('publishedNotes', compact('notes'));
    }
}

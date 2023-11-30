<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Auth, Str;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user_id = Auth::id();
        $notes = Note::where('user_id', $user_id)->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());÷
        //
        $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);

        $note = new Note([
            'uuid' => Str::uuid(),
            'user_id' => Auth::id(),
            'title' => $request->title,
            'text' => $request->text
        ]);

        $note->save();
        return to_route('notes.index')->with('success', 'Note Deleted Successfully!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort('403');
        }
        //
        // $note = Note::where(['uuid'=>$note->uuid, 'user_id'=>÷Auth::id()])->firstOrFail();
        return view('notes.show')->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view( 'notes.edit' )->with( 'note', $note );
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'text' => 'required'
        ]);

        $note->update([
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('notes.show', $note)->with('success', 'Note Deleted Successfully!');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return to_route('notes.index')->with('success', 'Note Moved to Trash Successfully!');
    }

}

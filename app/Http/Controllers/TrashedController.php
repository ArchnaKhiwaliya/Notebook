<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Auth; 

class TrashedController extends Controller
{
    //

    public function index(){
        $notes = Note::where([ 'user_id' => Auth::id() ])->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('notes.index')->with('notes', $notes);
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


    public function restore(Note $note){
        if($note->user_id != Auth::id()){
            return abort('403');
        }

        $note->restore();
        return to_route('notes.index')->with('success', 'Note restore successfully!');
    }

    public function destroy(Note $note){
        if($note->user_id != Auth::id()){
            return abort('403');
        }

        $note->forceDelete();
        return to_route('notes.index')->with('success', 'Note deleted permanantly successfully!');
    }


}

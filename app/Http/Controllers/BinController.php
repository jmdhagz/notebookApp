<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Bin;
use App\Models\Notebook;
use App\Models\Note;
use App\Models\NoteList;
use App\Models\NoteColor;
use App\User;
use Auth;
use App\Http\Controllers\Controller;

class BinController extends Controller
{
	public function __construct() {
		$this->middleware('auth');
	}

    public function index() {
    	return view('bin.index');
    }

    public function getNotes() {
    	$bin_note_list = Bin::join('note', 'bin.note_id', '=', 'note.id')
    						->join('note_color', 'note.note_color_id', '=', 'note_color.id')
    						->join('notebook', 'note.notebook_id', '=', 'notebook.id')
    						->where('note.binned', '=', 1)
    						->where('notebook.users_id', '=', Auth::user()->id)
    						->select(['bin.id', 'note.id as note_id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
							  'note.note_type_id', 'note_color.color_code', 
							  'note_color.nb_label_color', 'notebook.nb_name'])->get();

    	$lists = NoteList::join('note', 'note_list.note_id', '=', 'note.id')
                            ->join('notebook', 'note.notebook_id', '=', 'notebook.id')
                            ->select(['note_list.id', 'note_list.note_id', 'note_list.list_desc', 'note_list.is_completed'])
                            ->get();

        return response()->json(['bin_note_list' => $bin_note_list, 'lists' => $lists]);
    }

    public function restoreNote(Request $request) {
    	$bin_note_id = $request -> binNoteId;
    	$note_id = $request -> noteId;

    	$restore_note = Bin::find($bin_note_id);
    	$restore_note -> delete();

    	$update_note = Note::find($note_id);
    	$update_note -> binned = 0;
    	$update_note -> save();

    	return response()->json($update_note);
    }

    public function deleteNote(Request $request) {
    	$bin_note_id = $request -> binNoteId;
    	$note_id = $request -> noteId;

    	$delete_from_bin = Bin::find($bin_note_id);
    	$delete_from_bin -> delete();

    	$delete_from_note = Note::find($note_id);
    	$delete_from_note -> delete();

    	return response()->json($delete_from_note);
    }

    public function emptyBin() {
    	$bin_list = Bin::all();

    	foreach ($bin_list as $bin) {
    		$delete_bin = Bin::find($bin -> id);
    		$delete_bin -> delete();
    	}

    	return response()->json($delete_bin);
    }
}

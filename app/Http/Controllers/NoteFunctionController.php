<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Bin;
use App\Models\Note;
use App\Models\NoteList;
use App\Models\Notebook;
use App\Models\NoteColor;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteEditRequest;
use App\User;
use Auth;
class NoteFunctionController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}

	public function getColors() {
		$note_color = NoteColor::all();
        return response()->json($note_color);
	}

	public function changeColor(Request $request) {
		$note_id = $request->noteId;
    	$color_id = $request->colorId;

    	$save_color = Note::find($note_id);
    	$save_color -> note_color_id = $color_id;
    	$save_color -> save();

    	return response()->json($save_color);
	}

	public function postEditNote(Request $request) {
		$note_id = $request -> noteId;
    	$note_name = $request -> noteName;
    	$note_desc = $request -> noteDesc;

    	$edit_note = Note::find($note_id);
    	$edit_note -> note_name = $note_name;
    	$edit_note -> note_desc = $note_desc;
    	$edit_note -> save();

    	return response()->json($edit_note);
	}

	public function postCheckList(Request $request) {
		$list_id = $request->listId;
    	$status = $request->status;

    	if ($status == 'checked') {
    		$save_list = NoteList::find($list_id);
    		$save_list -> is_completed = 1;
    		$save_list -> save();
    	}
    	else {
    		$save_list = NoteList::find($list_id);
    		$save_list -> is_completed = 0;
    		$save_list -> save();
    	}

    	return response()->json($save_list);
	}

	public function noteStatus(Request $request) {
		$note_id = $request -> noteId;
        $status = $request -> status;

        if ($status == 'pin') {
            $selected_note = Note::find($note_id);
            $selected_note -> pinned = 1;
            $selected_note -> archived = 0;
            $selected_note -> save();
        }
        elseif ($status == 'unpin') {
            $selected_note = Note::find($note_id);
            $selected_note -> pinned = 0;
            $selected_note -> archived = 0;
            $selected_note -> save();
        }
        else {

        }
    	
    	return response()->json($selected_note);
	}

	public function archiveNote(Request $request) {
    	$id = $request -> noteId;

        $note_archive = Note::find($id);
        $note_archive -> pinned = 0;
        $note_archive -> archived = 1;
        $note_archive -> save();

        $archive = new Archive();
        $archive -> note_id = $id;
        $archive -> date = date('Y-m-d');
        $archive -> save();

        return response()->json($archive);
    }

    public function unarchiveNote(Request $request) {
    	$id = $request -> id;

    	$get_archive = Archive::where('note_id', '=', $id)
    							->get()->last();

    	$note_archive = Note::find($id);
        $note_archive -> pinned = 0;
        $note_archive -> archived = 0;
        $note_archive -> save();

        $unarchiveNote = Archive::find($get_archive -> id);
        $unarchiveNote -> delete();

        return response()->json($unarchiveNote);
    }

    public function binNote(Request $request) {
    	$note_id = $request -> noteId;

    	$selected_note = Note::find($note_id);
        $selected_note -> archived = 0;
        $selected_note -> pinned = 0;
        $selected_note -> binned = 1;
    	$selected_note -> save();

        $bin_note = new Bin();
        $bin_note -> note_id = $note_id;
        $bin_note -> date_binned = date('Y-m-d');
        $bin_note -> expiration_date = date('Y-m-d');
        $bin_note -> save();

    	return response()->json($selected_note);
    }

    public function undoBinnedNote(Request $request) {
        $note_id = $request -> noteId;
        $bin_id = Bin::where('note_id', '=', $note_id)->get()->last();

        $selected_note = Note::find($note_id);
        $selected_note -> pinned = 0;
        $selected_note -> binned = 0;
        $selected_note -> save();

        $bin_note = Bin::find($bin_id -> id);
        $bin_note -> delete();

        return response()->json($bin_note);
    }

    public function undoArchivedNote(Request $request) {
        $note_id = $request -> noteId;

        $selected_note = Note::find($note_id);
        $selected_note -> pinned = 0;
        $selected_note -> archived = 0;
        $selected_note -> binned = 0;
        $selected_note -> save();

        return response()->json($selected_note);
    }
}

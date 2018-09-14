<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NoteList;
use App\Models\Notebook;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}

	public function postDelete(Request $request) {
		$list_id = $request -> listId;

		$list = NoteList::find($list_id);
		$list -> delete();

		return response()->json($list);
	}

	public function postEdit(Request $request) {
		$list_id = $request -> listId;
		$list_desc = $request -> listDesc;

		$list = NoteList::find($list_id);
		$list -> list_desc = $list_desc;
		$list -> save();

		return response()->json($list);
	}

	public function postNewListForEdit(Request $request) {
		$note_id = $request -> noteId;
		$list_desc = $request -> listDesc;

		$new_list = new NoteList();
		$new_list -> note_id = $note_id;
		$new_list -> list_desc = $list_desc;
		$new_list -> is_completed = 0;
		$new_list -> save();

		return response()->json($new_list);
	}

	public function editNoteListName(Request $request) {
		$note_id = $request -> noteId;
		$noteName = $request -> noteName;

		$note_name = Note::find($note_id);
		$note_name -> note_name = $noteName;
		$note_name -> save();

		return response()->json($note_name);
	}
}

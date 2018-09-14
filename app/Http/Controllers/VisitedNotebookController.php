<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\NoteList;
use App\Models\Notebook;
use App\Http\Controllers\Controller;
use App\Http\Requests\NoteEditRequest;
use App\User;
use Auth;

class VisitedNotebookController extends Controller
{

	public function __construct() {
		$this->middleware('auth');
	}

    public function index($id) {
    	$notebook = Notebook::where('id', '=', $id)->get()->last();
    	$pinned_notes = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.pinned', '=', 1)
                    ->where('note.archived', '=', 0)
                    ->where('note.binned', '=', 0)
                    ->where('note.notebook_id', '=', $id)
                    // ->where('note.note_type_id', '=', 1)
					->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
							  'note.note_type_id', 'note.pinned', 'note_color.color_code', 
							  'note_color.nb_label_color', 'notebook.nb_name'])
					->get();

		$note_list = NoteList::join('note', 'note_list.note_id', '=', 'note.id')
							->select(['note_list.id', 'note_list.note_id', 'note_list.list_desc', 'note_list.is_completed'])->get();
        
    	return view('visited_notebook.index', compact('notebook', 'pinned_notes', 'note_list', 'id'));
    }

    public function newNote(Request $request) {
        $this->validate($request, [
            'noteName' => 'required',
            'noteDesc' => 'required'
        ]);

        $new_note = new Note();
        $new_note -> notebook_id = $request -> notebookId;
        $new_note -> note_name = $request -> noteName;
        $new_note -> note_desc = $request -> noteDesc;
        $new_note -> note_type_id = 1;
        $new_note -> note_color_id = 1;
        $new_note -> pinned = 0;
        $new_note -> binned = 0;
        $new_note -> archived = 0;
        $new_note -> save();

        return response()->json($new_note);
    }

    public function newList(Request $request) {
        $notebook_id = $request -> notebookId;
        $note_name = $request -> listName;
        $list_arr = $request -> listArr;

        $new_note = new Note();
        $new_note -> notebook_id = $notebook_id;
        $new_note -> note_name = $note_name;
        $new_note -> note_desc = '';
        $new_note -> note_color_id = 1;
        $new_note -> note_type_id = 2;
        $new_note -> pinned = 0;
        $new_note -> binned = 0;
        $new_note -> archived = 0;
        $new_note -> save();

        foreach ($list_arr as $list => $value) {
            $new_list = new NoteList();
            $new_list -> note_id = $new_note -> id;
            $new_list -> list_desc = $value['new_list'];
            $new_list -> is_completed = 0;
            $new_list -> save();
        }

        return response()->json($new_note);
    }

    public function getPinnedNotes(Request $request, $id) {
    	// $notebook_id = $request->notebookId;
    	$pinned_notes = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.pinned', '=', 1)
                    ->where('note.archived', '=', 0)
                    ->where('note.binned', '=', 0)
					->where('notebook.users_id', '=', Auth::user()->id)
					->where('notebook.id', '=', $id)
					->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
							  'note.note_type_id', 'note.pinned', 'note_color.color_code', 
							  'note_color.nb_label_color', 'notebook.nb_name'])
					->get();

		$unpinned_notes = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.pinned', '=', 0)
                    ->where('note.archived', '=', 0)
                    ->where('note.binned', '=', 0)
					->where('notebook.users_id', '=', Auth::user()->id)
					->where('notebook.id', '=', $id)
					->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
							  'note.note_type_id', 'note.pinned', 'note_color.color_code', 
							  'note_color.nb_label_color', 'notebook.nb_name'])
					->get();

		$note_list = NoteList::join('note', 'note_list.note_id', '=', 'note.id')
							->join('notebook', 'note.notebook_id', '=', 'notebook.id')
							->select(['note_list.id', 'note_list.note_id', 'note_list.list_desc', 'note_list.is_completed'])
							->get();

		return response()->json(array('pinned_notes' => $pinned_notes, 'unpinned_notes' => $unpinned_notes, 'note_list' => $note_list));
    }
}

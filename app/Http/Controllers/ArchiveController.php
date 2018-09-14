<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Notebook;
use App\Models\Note;
use App\Models\NoteList;
use App\Models\NoteColor;
use App\User;
use Auth;
use App\Http\Controllers\Controller;

class ArchiveController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	return view('archive.index');
    }

    public function noteList()
    {
    	$notebook_list = Notebook::where('users_id', '=', Auth::user()->id)
                                ->get();

    	$archive_notes = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.archived', '=', 1)
					->where('notebook.users_id', '=', Auth::user()->id)
					->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
							  'note.note_type_id', 'note.pinned', 'note_color.color_code', 
							  'note_color.nb_label_color', 'notebook.nb_name'])
					->get();

        $lists = NoteList::join('note', 'note_list.note_id', '=', 'note.id')
                            ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                            ->select(['note_list.id', 'note_list.note_id', 'note_list.list_desc', 
                                      'note.pinned', 'note_list.is_completed'])
                            ->get();

		return response()->json(array('lists' => $lists,
                                      'archive_notes' => $archive_notes, 
                                      'notebook_list' => $notebook_list));

    }

    public function postEditNote(Request $request)
    {
        $note_id = $request->id;
        $note_name = $request->noteName;
        $note_desc = $request->noteDesc;

        $update_note = Note::find($note_id);
        $update_note -> note_name = $note_name;
        $update_note -> note_desc = $note_desc;
        $update_note -> save();

        return response()->json($update_note);
    }

    public function archiveNote(Request $request)
    {
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

    public function unarchiveNote(Request $request)
    {
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
}

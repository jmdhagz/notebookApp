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

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$test = 'test';
		return view('dashboard.index', compact('test'));
	}

    public function getNotebook()
    {
    	$notebook_list = Notebook::where('users_id', '=', Auth::user()->id)
								->get();

		return response()->json($notebook_list);
    }

    public function getPinnedNotes()
    {
        $notebook_list = Notebook::where('users_id', '=', Auth::user()->id)
                                ->get();

    	$pinned_notes = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.pinned', '=', 1)
                    ->where('note.archived', '=', 0)
                    ->where('note.binned', '=', 0)
					->where('notebook.users_id', '=', Auth::user()->id)
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
                    ->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
                              'note.note_type_id', 'note.pinned', 'note_color.color_code', 
                              'note_color.nb_label_color', 'notebook.nb_name'])
                    ->get();

        $lists = NoteList::join('note', 'note_list.note_id', '=', 'note.id')
                            ->join('notebook', 'note.notebook_id', '=', 'notebook.id')
                            ->select(['note_list.id', 'note_list.note_id', 'note_list.list_desc', 'note_list.is_completed'])
                            ->get();

		return response()->json(array('lists' => $lists,
                                      'pinned_notes' => $pinned_notes, 
                                      'notebook_list' => $notebook_list, 
                                      'unpinned_notes' => $unpinned_notes));
    }

    public function getUnpinnedNotes()
    {
        $notebook_list = Notebook::where('users_id', '=', Auth::user()->id)
                                ->get();

        $unpinned_notes = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.pinned', '=', 0)
                    ->where('note.archived', '=', 0)
                    ->where('note.binned', '=', 0)
                    ->where('notebook.users_id', '=', Auth::user()->id)
                    ->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
                              'note.note_type_id', 'note.pinned', 'note_color.color_code', 
                              'note_color.nb_label_color', 'notebook.nb_name'])
                    ->get();

        $unpinned_note_lists = Note::join('notebook', 'note.notebook_id', '=', 'notebook.id')
                    ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                    ->where('note.pinned', '=', 0)
                    ->where('note.archived', '=', 0)
                    ->where('note.binned', '=', 0)
                    ->where('notebook.users_id', '=', Auth::user()->id)
                    ->where('note.note_type_id', '=', 2)
                    ->select(['note.id', 'note.notebook_id', 'note.note_name', 'note.note_desc', 
                              'note.note_type_id', 'note.pinned', 'note_color.color_code', 
                              'note_color.nb_label_color', 'notebook.nb_name'])
                    ->get();

        $unpinned_lists = NoteList::join('note', 'note_list.note_id', '=', 'note.id')
                            ->join('note_color', 'note.note_color_id', '=', 'note_color.id')
                            ->where('note.pinned', '=', 0)
                            ->select(['note_list.id', 'note_list.note_id', 'note_list.list_desc', 
                                      'note.pinned', 'note_list.is_completed'])
                            ->get();

        return response()->json(array('unpinned_lists' => $unpinned_lists,
                                      'unpinned_notes' => $unpinned_notes, 
                                      'notebook_list' => $notebook_list,
                                      'unpinned_note_lists' => $unpinned_note_lists));
    }

    public function newNotebook(Request $request)
    {
    	$notebook_name = $request->notebookName;

    	$new_notebook = new Notebook();
    	$new_notebook -> users_id = Auth::user()->id;
    	$new_notebook -> nb_name = $notebook_name;
    	$new_notebook -> save();

    	return response()->json($new_notebook);
    }

    public function editNotebook(Request $request)
    {
    	$id = $request->id;
    	$nb_name = $request->nb_name;

    	$edit_noteboook = Notebook::find($id);
    	$edit_noteboook -> nb_name = $nb_name;
    	$edit_noteboook -> save();

    	return response()->json($edit_noteboook);
    }

    public function deleteNotebook(Request $request)
    {
    	$id = $request->id;

    	$delete_noteboook = Notebook::find($id);
    	$delete_noteboook -> delete();

        $note_list = Note::where('notebook_id', '=', $id)->select('id')->get();
        // delete all note inside notebook
        foreach ($note_list as $note) {
            $delete_note = Note::find($note -> id);
            $delete_note -> delete();
            // delete list inside note
            $lists = NoteList::where('note_id', '=', $note -> id)->select('id')->get();
            foreach ($lists as $list) {
                $delete_list = NoteList::find($list -> id);
                $delete_list -> delete();
            }
        }

    	return response()->json($delete_noteboook);
    }

}

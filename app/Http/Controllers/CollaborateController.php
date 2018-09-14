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

class CollaborateController extends Controller
{
	protected $owner_id;
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{

	}

    public function getCollaborators()
    {
		$owner = User::where('id', '=', Auth::user()->id)->get()->last();

        $collaborator_list = User::select('id', 'first_name', 'middle_name',
                                          'last_name', 'username', 'email')
        						->where('id', '!=', $owner -> id)
                                ->get();

        return response()->json($collaborator_list);
    }
}

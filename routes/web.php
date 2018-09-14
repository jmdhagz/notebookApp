<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/', 'DashboardController@index');
	Route::get('item/create', 'ItemController@create');

	Route::get('test/', 'ItemController@testIndex');

	Route::get('rfid/', 'RfidController@index');

	Route::get('dashboard/get_notebooks', 'DashboardController@getNotebook');
	Route::get('dashboard/get_pinned_notes', 'DashboardController@getPinnedNotes');
	Route::get('dashboard/get_unpinned_notes', 'DashboardController@getUnpinnedNotes');
	Route::post('dashboard/new_notebook', 'DashboardController@newNotebook');
	Route::post('dashboard/edit_notebook', 'DashboardController@editNotebook');
	Route::post('dashboard/delete_notebook', 'DashboardController@deleteNotebook');

# ARCHIVE NOTE
	Route::get('archive/', 'ArchiveController@index');
	Route::get('archive/get_archive_note', 'ArchiveController@noteList');
	Route::post('archive/post_edit_note', 'ArchiveController@postEditNote');

# VISITED NOTEBOOK
	Route::get('visited_notebook/{id}', 'VisitedNotebookController@index');
	Route::get('visited_notebook/{id}/get_pinned_note', 'VisitedNotebookController@getPinnedNotes');
	Route::get('visited_notebook/get_note_info', 'VisitedNotebookController@getNoteInfo');
	Route::post('visited_notebook/new_note', 'VisitedNotebookController@newNote');
	Route::post('visited_notebook/newList', 'VisitedNotebookController@newList');

# LIST
	Route::post('list/delete_list', 'ListController@postDelete');
	Route::post('list/edit_list', 'ListController@postEdit');
	Route::post('list/new_list_for_edit', 'ListController@postNewListForEdit');
	Route::post('list/edit_notelist_name', 'ListController@editNoteListName');

# BIN
	Route::get('bin/', 'BinController@index');
	Route::get('bin/get_notes', 'BinController@getNotes');
	Route::post('bin/restore_note', 'BinController@restoreNote');
	Route::post('bin/delete_note', 'BinController@deleteNote');
	Route::post('bin/empty_bin', 'BinController@emptyBin');

# NOTE FUNCTIONS
	# Pin / Unpin
	Route::post('pin_unpin_note', 'NoteFunctionController@noteStatus');
	# Colors
	Route::get('get_colors', 'NoteFunctionController@getColors');
	Route::post('change_color', 'NoteFunctionController@changeColor');
	# Archive / Unarchive
	Route::post('archive_note', 'NoteFunctionController@archiveNote');
	Route::post('unarchive_note', 'NoteFunctionController@unarchiveNote');
	# Bin Note
	Route::post('bin_note', 'NoteFunctionController@binNote');
	# Edit Note
	Route::post('edit_note', 'NoteFunctionController@postEditNote');
	Route::post('post_check_list', 'NoteFunctionController@postCheckList');
	# Undo Binned Note
	Route::post('undo_binned_note', 'NoteFunctionController@undoBinnedNote');
	# Undo Archive
	Route::post('undo_archived_note', 'NoteFunctionController@undoArchivedNote');

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

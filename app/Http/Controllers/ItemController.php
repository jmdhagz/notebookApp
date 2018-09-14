<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemCreateRequest;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
    	return view('item.index');
    }

    public function getItems()
    {
    	$items = Item::orderBy('id', 'ASC')->get();
    	return response()->json($items);
    }

    public function create(ItemCreateRequest $item_create_request)
    {
    	$items = new Item();
    	$items -> name = $item_create_request -> name;
    	$items -> description = $item_create_request -> description;
    	$items -> save();

    	return response()->json($items);
    }

    public function edit(ItemCreateRequest $item_create_request)
    {
    	$id = $item_create_request->input('item_id');

    	$items = Item::find($id);
    	$items -> name = $item_create_request -> name;
    	$items -> description = $item_create_request -> description;
    	$items -> save();

    	return response()->json($items);
    }

    public function delete($id)
    {
    	$items = Item::find($id);
    	$items -> delete();

    	return response()->json($items);
    }

    public function testIndex()
    {
    	return view('test.index');
    }
}

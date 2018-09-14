<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemCreateRequest;
use App\Models\Person;
use App\Models\PersonLog;
use Input;

class RfidController extends Controller
{

	protected $first_id;
	protected $first_rfid_no;

    public function index()
    {
    	return view('rfid.index');
    }

    public function postTimeOut(Request $request)
    {
    	$rfid_no = $request->rfidNo;
    	$person = Person::where('rfid_no', '=', $rfid_no)
    					->get()->last();

    	$log = new PersonLog();
    	$log -> person_id = $person -> id;
    	$log -> date = date('y-m-d');
    	$log -> time_in = date('h:i:s');
    	$log -> save();

    	return response()->json($log);
    }

    public function getPerson(Request $request)
    {
    	$rfid_no = $request->rfidNo;
    	$person = Person::where('rfid_no', '=', $rfid_no)
    					->get()->last();

    	return response()->json($person);
    }

    public function getPrevPerson(Request $request)
    {
    	$rfid_no = $request->rfidNo;

    	$person = Person::where('rfid_no', '=', $rfid_no)
    					->get()->last();

    	$get_prev_person = PersonLog::join('person', 'person_log.person_id', '=', 'person.id')
    							->where('person_log.person_id', '!=', $person -> id)
    							->select(['person_log.id', 'person.id as person_id', 'person.firstname',
    									  'person.middlename', 'person.lastname',
    									  'person.rfid_no', 'person.img'])
    							->get()->last();

    	$person_log = PersonLog::join('person', 'person_log.person_id', '=', 'person.id')
    							->where('person_log.person_id', '!=', $person -> id)
    							->where('person_log.person_id', '!=', $get_prev_person -> person_id)
    							->select(['person_log.id', 'person.firstname',
    									  'person.middlename', 'person.lastname',
    									  'person.rfid_no', 'person.img'])
    							->get()->last();

    	return response()->json($person_log);
    }

    public function getThirdPerson(Request $request)
    {
    	$rfid_no = $request->rfidNo;
    	$prev_rfid_no = $request->prevRfidNo;

    	echo $prev_rfid_no;
    	exit();
    	
    	$person = Person::where('rfid_no', '=', $rfid_no)
    					->get()->last();

    	$person_log = PersonLog::join('person', 'person_log.person_id', '=', 'person.id')
    							->where('person_log.person_id', '!=', $person -> id)
    							->select(['person_log.id', 'person.firstname',
    									  'person.middlename', 'person.lastname',
    									  'person.rfid_no', 'person.img'])
    							->get()->last();

    	return response()->json($person_log);
    }
}

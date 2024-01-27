<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Workshop;
use App\Competition;

class AdminController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function index(){
		$app_count = Appointment::get()->count();
		$work_count = Workshop::get()->count();
		$comp_count = Competition::get()->count();

		return view('admin.index', compact('app_count', 'work_count', 'comp_count'));
	}

	public function appointment()
	{
		$appointments = Appointment::get();

		return view('admin.appointment', compact('appointments'));
	}
}

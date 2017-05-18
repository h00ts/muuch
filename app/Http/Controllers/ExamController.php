<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Module;
use Auth;

class ExamController extends Controller
{
    // show {
	//  display one exam from each module on the user's level stitched into one
	// }
	public function index()
	{
		$level = Auth::user()->level;
		$modules = Module::where('level', $level)->with('exams')->get();
		$exams = array();
		foreach($modules as $module){
			($module->exams->first()) ? array_push($exams, $module->exams->first()) : null;
		}

		return dd($exams);
	}
}

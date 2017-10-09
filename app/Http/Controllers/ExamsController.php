<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exam;
use App\Module;
use Auth;

class ExamsController extends Controller
{
    // show {
	//  display one exam from each module on the user's level stitched into one
	// }
	public function index()
	{
		$user = Auth::user();
		$modules = Module::where('level', $user->level)->get();
		$content_count = 0;
        foreach($modules as $module){
            $content_count += count($module->contents);
        }
		
		if(count($user->content) != $content_count)
		{
			return redirect('/');
		}

		$level = Auth::user()->level;
		$modules = Module::where('level', $level)->with('exams')->get();
		$exams = array();
		foreach($modules as $module){
			($module->exams->first()) ? array_push($exams, $module->exams->random()) : null;
		}

		return view('exam')->withExams($exams)->withLevel($level);
	}

	public function show($module)
    {
        $level = Auth::user()->level;
        $module = Module::find($module);
        $exams = array();
        ($module->exams->first()) ? array_push($exams, $module->exams->random()) : null;

        return view('exam')->withExams($exams)->withLevel($level);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Score;
use App\Exam;
use App\Answer;
use Auth;

class ScoresController extends Controller
{
    
	public function store(Request $request)
	{
		$ra=0; $ts=0;
		$user = Auth::user();
		$data = $request->except('_token');

		/*****
		ALGORITHM FOR FINDING THE OVERALL LIVE SCORE OF AN EXAM
		******/
		$keys = array_keys($data);
		$values = array_values($data);
		$user->answers()->attach($values);

		foreach($keys as $key){
			$exams[] = substr($key, 1, 1);
		}
		$exams = collect($exams);
		$tests = $exams->unique();
		foreach($tests as $exam)
		{
			$ua=0;
			$test = Exam::findOrFail($exam);
			foreach($test->answers as $answer)
			{
				if($answer->correct){$ra++;}
			}
			foreach($values as $value)
			{
				$answer = Answer::findOrFail($value);
				if($answer->question->id == $test->id) {
					if($answer->correct){$ua++; $ts++;}
				}
			}
			$score = Score::create([
				'score' => $ua,
				'level' => $user->level,
				'user_id' => $user->id,
				'exam_id' => $test->id
			]);

			//$score->user()->attach($user);
			//$score->exam()->attach($test);
		}

		return $ts;
		/*****
		END ALGORITHM
		******/

		/*****
		ALGORITHM FOR FINDING EACH EXAM SCORE (of a level?)
		******/
		Score::where('exam.level', $level);

		
	}

	public function get_numerics ($str) {
	    preg_match_all('/\d+/', $str, $matches);
	    return $matches[0];
	}
}

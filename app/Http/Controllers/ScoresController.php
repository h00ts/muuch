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
			// not sure why I thought of this, but I'll let it sit here just in case ¯\_(ツ)_/¯

			foreach($values as $value)
			{
				$answer = Answer::findOrFail($value);
				if($answer->exam()->id == $test->id) {
					if($answer->correct){$ua++; ++$ts;}
				}
			}

			$score = Score::create([
				'score' => $ua,
				'level' => $user->level,
				'user_id' => $user->id,
				'exam_id' => $test->id,
                'passed' => 0,
                'status' => 0,
                'percent' => 0
			]);
		}

		$scores = $user->scores->where('level', $user->level);
		$avg = array();
		foreach($scores as $score)
		{
			$avg[] = $score->exam->min_score;
		}
		$avg = (array_sum($avg) / count($avg));
		$total = ($ts) ? number_format((($ts / $ra) * 100),0) : '0';
		$score->percent = $total;
		if($total >= $avg)
		{
			$score->passed = 1;
			$score->save();
		}

		return view('exams.graded')->withScores($scores)->withGrade($ts)->withPossible($ra)->withUser($user)->withAvg($avg)->withTotal($total);
	}

	public function get_numerics ($str) {
	    preg_match_all('/\d+/', $str, $matches);
	    return $matches[0];
	}
}

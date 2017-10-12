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
        $user_answers = 0;
        $user_correct = 0;
        $exam = Exam::findOrfail($request->input('exam_id'));
        $correct = $request->input('correct');

        $user = Auth::user();
        $data = $request->except('_token', 'exam_id', 'correct');
        /**
         * 1. Separate keys and values from our data;
         * 2. Attach the answers (answer ID's in $values) to the logged user
         */
        //$keys = array_keys($data);
        $values = array_values($data);
        $user->answers()->attach($values);

        /*
         * Count all the user's answers and correct ones separately
         */
        foreach($values as $value)
        {
            ++$user_answers;
            $answer = Answer::findOrFail($value);
            if($answer->correct) {
                ++$user_correct;
            }
        }

        $incorrect = $user_answers - $user_correct;

        $percent = ($user_correct) ? number_format((($user_correct / $correct) * 100),0) : 0;
        $percent = $percent - $incorrect;
        ($percent >= $exam->min_score) ? $passed = 1 : $passed = 0;
        /*
         * Create the score
         */
        $score = Score::create([
            'score' => $user_correct,
            'top' => $correct,
            'level' => $user->level,
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'passed' => $passed,
            'status' => 0,
            'percent' => $percent
        ]);

        return view('exams.graded')->withScore($score)->withGrade($percent)->withPossible($correct)->withIncorrect($incorrect)->withUser($user);





        // restar 2 % al calcular el porcentage por cada pregunta erronea (correct=0)
	    /**
		$ra=0; $ts=0;
		$user = Auth::user();
		$data = $request->except('_token');

		$keys = array_keys($data);
		$values = array_values($data);
		$user->answers()->attach($values);

		foreach($keys as $key){
			$exams[] = substr($key, 1, 1);// Extract exam keys (e#) into array
		}
		$exams = collect($exams); // Transform array into collection
		$tests = $exams->unique(); // Consolidate into one field per exam (since fields repeat per answer)
         //Calculate score per exam
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
		}
        $score->save();

		return view('exams.graded')->withScores($scores)->withGrade($ts)->withPossible($ra)->withUser($user)->withAvg($avg)->withTotal($total);
         *
         * **/
	}

	public function get_numerics ($str) {
	    preg_match_all('/\d+/', $str, $matches);
	    return $matches[0];
	}
}

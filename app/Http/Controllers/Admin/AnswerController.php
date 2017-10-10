<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use App\Answer;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module_id = null)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $question = Question::findOrFail($data['question_id']);
        for($i=1;array_key_exists('answer_answer_'.$i, $data);++$i){
            $question->answers()->create(['answer' => $data['answer_answer_'.$i], 'correct' => (array_key_exists('answer_correct_'.$i, $data)) ? 1 : 0]);
        }

        return redirect()
            ->back()->withSuccess('Respuestas creadas correctamente: '.$i-1);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->input();
        $answer = Answer::findOrFail($id);
        $answer->answer = $data['answer-'.$id];
        if(array_key_exists('correct', $data)){
            $answer->correct = 1;
        } else {
            $answer->correct = 0;
        }
        $answer->save();

        return back()->withSuccess('Actualizaste la respuesta: '.$answer->answer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Answer::destroy($id);

        return back()->withSuccess('Eliminaste una respuesta.');
    }
}

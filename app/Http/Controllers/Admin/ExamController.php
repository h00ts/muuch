<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Module;
use App\Exam;

class ExamController extends Controller
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
        $modules = Module::all()->sortBy('level');

        return view('admin.exams.create')->withModules($modules)->withModuleId($module_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $module = Module::findOrFail($request->input('module_id'));
        $exam = $module->exams()->create([
            'name' => $request->input('name'),
            'min_score' => $request->input('min_score'),
        ]);

        return back()->withSuccess('Examen '.$exam->name.' creado para el modulo '.$module->name);
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
        $exam = Exam::findOrFail($id);

        if($exam){
            return view('admin.exams.edit')->withExam($exam);
        }

        return redirect('/admin')->withErrors('No se encontro el nivel que buscas.');
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
        $exam = Exam::findOrFail($id);

        $exam->name = $request->input('exam_name');
        $exam->min_score = $request->input('min_score');
        $exam->save();

        return redirect()->back()->withSuccess('El examen ahora se llama: '.$exam->name.' y se necesita un '.$exam->min_score.'% para pasar.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

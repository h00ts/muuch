<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ilucentro;

class IlucentroController extends Controller
{
	public function index()
	{
		$centros = Ilucentro::all();

		return view('admin.ilucentros.index')->withIlucentros($centros);
	}

	public function create()
	{
		return view('admin.ilucentros.create');
	}

	public function edit(Ilucentro $ilucentro)
    {
        return view('admin.ilucentros.edit', $ilucentro);
    }

    public function store(Request $request)
    {
    	$data = $request->all();
    	$ilucentro = Ilucentro::create($data);

    	return redirect()->back()->withSuccess('ILUCentro '.$ilucentro->name.' creado.');
    }

    public function update(Ilucentro $ilucentro, Request $request)
    {
        //$data = $request->all();
        $ilucentro->update($request->all());

        return redirect()->back()->withSuccess('ILUCentro '.$ilucentro->name.' actualizado.');
    }

    public function destroy(Ilucentro $ilucentro)
    {
        dd($ilucentro->users->count());
        if(count($ilucentro->user))
        {
            return redirect()->back()->withError('¡Imposible! Hay personas en este ILUCentro');
        }
        $ilucentro->delete();

        return redirect()->route('ilucentros.index')->withSuccess('ILUCentro eliminado');
    }
}

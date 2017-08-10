<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Ilucentro;
use App\User;

class DatatablesController extends Controller
{
    public function getSucursales(Datatables $datatables)
    {
        $ilucentros = Ilucentro::all();

        return Datatables::of($ilucentros)->make(true);
    }

    public function getEquipo(Datatables $datatables)
    {
        $user = User::with('ilucentro')->get();

        return Datatables::of($user)->make(true);
    }
        /**
        return $datatables->eloquent($ilucentros)
            ->editColumn('name', function ($ilucentro) {
                return '<a>' . $ilucentro->name . '</a>';
            })
            ->addColumn('action', 'eloquent.tables.users-action')
            ->rawColumns(['name', 'action'])
            ->make(true);
    }**/

}

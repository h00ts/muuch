<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Impacto;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;
use Session;

class ImpactoController extends Controller
{
    public function index()
    {
        $impacto = Impacto::all()->last();

        return view('pages.impacto', $impacto);
    }

    public function store(Request $request)
    {
        try {
            Forrest::authenticate();
            $params = Forrest::get('/services/data/v31.0/analytics/dashboards/01Z160000011IMF');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors('Falló la conexión con Salesforce');
        }

        $impacto = Impacto::create([
            'beneficiarios' => $params['componentData'][1]['reportResult']['factMap']['T!T']['aggregates'][0]['value'],
            'sistemas' => $params['componentData'][0]['reportResult']['factMap']['T!T']['aggregates'][0]['value'],
            'potencia' => $params['componentData'][2]['reportResult']['factMap']['T!T']['aggregates'][0]['value'],
            'energia' => $params['componentData'][3]['reportResult']['factMap']['T!T']['aggregates'][0]['value'] / 1000000,
            'co2' => $params['componentData'][4]['reportResult']['factMap']['T!T']['aggregates'][0]['value'],
            'equipo' => $params['componentData'][6]['reportResult']['factMap']['T!T']['aggregates'][0]['value'],
            'embajadores' => $params['componentData'][7]['reportResult']['factMap']['0!T']['aggregates'][0]['value'],
            'enlaces' => $params['componentData'][7]['reportResult']['factMap']['1!T']['aggregates'][0]['value'],
            'escuelas' => $params['componentData'][8]['reportResult']['factMap']['3!T']['aggregates'][0]['value'],
        ]);

        return redirect()->back()->withSuccess('Se actualizo el impacto correctamente.');
    }
}

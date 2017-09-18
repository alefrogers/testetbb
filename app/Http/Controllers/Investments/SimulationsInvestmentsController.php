<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Model\Investments\InvestmentsSimulation;
use App\Model\Investments\InvestmentsType;
use App\Model\Investments\InvestmentsSimulationApplications;
use App\Http\Requests\Investments\SimulationRequest;
use Illuminate\Http\Request;
use DateTime;

class SimulationsInvestmentsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $investments_simulation = new InvestmentsSimulation();

        if($request->has('id_type')){
            $investments_simulation = $investments_simulation->where('id_type', $request->input('id_type'));
        }
        
        if ($request->has('date_start')) {
            $dateAux = DateTime::createFromFormat('d/m/Y', $request->input('date_start'));
            $investments_simulation = $investments_simulation->whereDate('created_at', '>=', $dateAux->format('Y-m-d') . ' 00:00:00');
        }

        if ($request->has('date_end')) {
            $dateAux = DateTime::createFromFormat('d/m/Y', $request->input('date_end'));
            $investments_simulation = $investments_simulation->whereDate('created_at', '<=', $dateAux->format('Y-m-d') . ' 00:00:00');
        }


        return view('tbb.modules.investments.simulation.list', ['results' => $investments_simulation->orderBy('id', 'ASC')->paginate(5), 'types' => InvestmentsType::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tbb.modules.investments.simulation.create', ['types' => InvestmentsType::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SimulationRequest $request) {
        $investments_simulation = new InvestmentsSimulation();
        $investments_simulation->id_type = $request->input('id_type');
        $investments_simulation->save();

        $json_items = json_decode($request->input('json_items'));

        foreach ($json_items as $value) {
            $simulation_application = new InvestmentsSimulationApplications();
            $value->val_application = str_replace(".", "", $value->val_application);
            $value->date_application = DateTime::createFromFormat('d/m/Y', $value->date_application);

            $simulation_application->id_simulation = $investments_simulation->id;
            $simulation_application->val_application = str_replace(",", ".", $value->val_application);
            $simulation_application->date_application = $value->date_application->format('Y-m-d') . ' 00:00:00';

            $simulation_application->save();
        }

        return redirect()->route('investments.simulation.index')->with('msg-success', 'Registro inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $result = InvestmentsSimulation::findOrFail($id);
        return view('tbb.modules.investments.simulation.edit', ['result' => $result, 'types' => InvestmentsType::get()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SimulationRequest $request, $id) {

        $investments_simulation = InvestmentsSimulation::findOrFail($id);
        $investments_simulation->id_type = $request->input('id_type');
        $investments_simulation->save();

        $json_items = json_decode($request->input('json_items'));

        foreach ($json_items as $value) {
            $simulation_application = new InvestmentsSimulationApplications();

            if (empty($value->id)) {
                $simulation_application->id_simulation = $id;
            } else {
                $simulation_application = $simulation_application->findOrFail($value->id);
            }

            $value->val_application = str_replace(".", "", $value->val_application);
            $value->date_application = DateTime::createFromFormat('d/m/Y', $value->date_application);
            $simulation_application->val_application = str_replace(",", ".", $value->val_application);
            $simulation_application->date_application = $value->date_application->format('Y-m-d') . ' 00:00:00';

            $simulation_application->save();
        }

        return redirect()->route('investments.simulation.index')->with('msg-success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        InvestmentsSimulationApplications::Where('id_simulation', $id)->delete();
        InvestmentsSimulation::findOrFail($id)->delete();


        return redirect()->route('investments.simulation.index')->with('msg-success', 'Registro removido com sucesso!');
    }

}

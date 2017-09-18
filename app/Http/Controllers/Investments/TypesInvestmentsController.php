<?php

namespace App\Http\Controllers\Investments;

use App\Http\Controllers\Controller;
use App\Model\Investments\InvestmentsType;
use App\Model\Investments\InvestmentsSimulation;
use App\Http\Requests\Investments\TypeRequest;
use Illuminate\Http\Request;
use DateTime;

class TypesInvestmentsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {       
        $investments_type = new InvestmentsType();
        
        if($request->has('date_start')){
            $dateAux = DateTime::createFromFormat('d/m/Y', $request->input('date_start'));
           $investments_type = $investments_type->whereDate('created_at', '>=', $dateAux->format('Y-m-d'). ' 00:00:00');
        }
        
        if($request->has('date_end')){            
            $dateAux = DateTime::createFromFormat('d/m/Y', $request->input('date_end'));
           $investments_type = $investments_type->whereDate('created_at', '<=', $dateAux->format('Y-m-d'). ' 00:00:00');
        }
       
        return view('tbb.modules.investments.types.list', ['results' => $investments_type->orderBy('id', 'ASC')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tbb.modules.investments.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request) {     
        $array_insert = $request->except('_token');        
        InvestmentsType::create($array_insert);

      
        return redirect()->route('investments.type.index')->with('msg-success', 'Registro inserido com sucesso!');
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
        $result = InvestmentsType::findOrFail($id);
        return view('tbb.modules.investments.types.edit', ['result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, $id) {
        $investments_type = InvestmentsType::findOrFail($id);
        
        $array_insert = $request->except('_token');        
        $investments_type->update($array_insert);
      
        return redirect()->route('investments.type.index')->with('msg-success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {        
        $simulation = InvestmentsSimulation::where('id_type', $id)->first();
        
        if(isset($simulation)){
            return redirect()->route('investments.type.index')->with('msg-danger', 'Existem simulações neste tipo de investimento!');
        }
        
       $investments_type = InvestmentsType::findOrFail($id);
       $investments_type->delete();
       
       return redirect()->route('investments.type.index')->with('msg-success', 'Registro removido com sucesso!');
    }

}

@extends('tbb.layouts.app')
@section('content-wrapper')
<form id="create-simulation" action="{{route('investments.simulation.update', ['id' => $result->id])}}" method="POST" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT" />

    <section class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Simulação</h3>
        </div>
        <div class="panel-body">

            <div class="alert alert-info" role="alert">Criar simulação de investimento financeiro.</div>

            <div class="row">
                <div class="col-md-12 {{ ($errors->has('id_type') ? ' has-error' : '') }}">                
                    <label>Tipo de investimento</label>
                    <div class="input-group-md">
                        <select class="form-control" name="id_type">
                            @foreach($types as $key => $value)
                            <option {!! $result->id_type == $value->id ? 'selected' : '' !!} value="{{$value->id}}" >{{$value->name}}</option>
                            @endforeach


                        </select>                 
                    </div>
                    <span class="help-block">{{ $errors->first('id_type') }}</span>
                </div>                
            </div>

            <div class="row row-border">
                <div class="border"></div>                
            </div>

            <div class="aplications-group">
                <input type="hidden" name="json_items" value="">

                @foreach($result->applications as $value)                
                <div class="row item">
                    <input type="hidden" class="id-application" value="{{$value->id}}"/> 
                    <div class="col-md-2 val-div">
                        <label>Aplicação</label>
                        <div class="input-group-md">
                            <input class="val_application form-control money" type="text" value="{{ number_format($value->val_application,2,",",".")}}">                     
                        </div>
                        <span class="help-block val-help"></span>
                    </div>

                    <div class="col-md-2 date-div">
                        <label>Data</label>
                        <div class="input-group-md">
                            <input class="date_application form-control date" type="text" value="{{date('d/m/Y',strtotime($value->date_application))}}">                     
                        </div>
                        <span class="help-block date-help"></span>                        
                    </div>                
                </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button onclick="newRow()" type="button" class="btn btn-default">Adicionar</button>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        <div class="col-md-12 text-right">
            <button type="button" onclick="save()" class="btn btn-success">Atualizar Registro</button>
            <a href="{{route('investments.simulation.index')}}" class="btn btn-default">Cancelar</a>
        </div>
    </section>
</form>
@endsection
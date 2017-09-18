@extends('tbb.layouts.app')
@section('content-wrapper')
<form action="{{route('investments.type.update', ['id' => $result->id])}}" method="POST" role="form">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT" />
    
    <section class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Tipos</h3>
        </div>
        <div class="panel-body">

            <div class="alert alert-info" role="alert">Editar tipo de investimento financeiro.</div>

            <div class="row">
                <div class="col-md-12 {{ ($errors->has('name') ? ' has-error' : '') }}">                
                    <label>Nome</label>
                    <div class="input-group-md">
                        <input name="name" type="text" class="form-control" value="{{old('name') ? old('name') : $result->name}}">                     
                    </div>
                    <span class="help-block">{{ $errors->first('name') }}</span>
                </div>                
            </div>

            <div class="row">
                <div class="col-md-2 {{ ($errors->has('profitability') ? ' has-error' : '') }}">
                    <label>Rentabilidade</label>
                    <div class="input-group-md">
                        <input name="profitability" type="number" class="form-control" value="{{old('profitability') ? old('profitability') : $result->profitability}}">                     
                    </div>
                    <span class="help-block">{{ $errors->first('profitability') }}</span>
                </div>
                <div class="col-md-2 {{ ($errors->has('rate') ? ' has-error' : '') }}">
                    <label>Taxa</label>
                    <div class="input-group-md">
                        <input name="rate" type="number" class="form-control" value="{{old('rate') ? old('rate') : $result->rate}}">                     
                    </div>
                    <span class="help-block">{{ $errors->first('rate') }}</span>
                </div>
                <div class="col-md-3 {{ ($errors->has('application_days') ? ' has-error' : '') }}">
                    <label>Período de Aplicação</label>
                    <div class="input-group-md">
                        <input name="application_days" type="number" class="form-control" value="{{old('application_days') ? old('application_days') : $result->application_days}}">                     
                    </div>
                    <span class="help-block">{{ $errors->first('application_days') }}</span>
                </div>
            </div>
        </div>
    </section>

    <section class="row">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success">Atualizar Registro</button>
            <a href="{{route('investments.type.index')}}" class="btn btn-default">Cancelar</a>
        </div>
    </section>
</form>
@endsection
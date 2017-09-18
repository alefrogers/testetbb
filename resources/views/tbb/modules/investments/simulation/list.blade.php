@extends('tbb.layouts.app')
@section('content-wrapper')

<section id="register-section" class="row">
    <div class="col-md-12 text-right">
        <div class="btn-group pull-right">
            <a href="{{route('investments.simulation.create')}}" class="btn btn-default">Novo Registro</a>
            <a href="{{route('investments.simulation.index')}}" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>        
    </div>
</section>


<section id="simulations" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Simulações</h3>
    </div>
    <div class="panel-body">

        @if (session('msg-success'))        
        <div class="alert alert-success" role="alert">{{ session('msg-success') }}</div>        
        @endif

        <div class="alert alert-info" role="alert">Simulações de investimentos financeiros.</div>

        <div class="row">
            <form method="GET" action="{{route('investments.simulation.index')}}">
                <div class="col-md-12">
                    <div class="input-search col-md-5">
                        <label>Tipo de Investimento:</label>
                        <select class="form-control" name="id_type">
                            <option value=''>Selecionar ...</option>
                            @foreach($types as $key => $value)
                            <option {!! isset($_GET['id_type']) ? ($_GET['id_type'] == $value->id ? 'selected' : '') : '' !!} value="{{$value->id}}" >{{$value->name}}</option>
                            @endforeach              
                        </select>    
                    </div>
                    <div class="input-search col-md-3">
                        <label>Data Inicial:</label>
                        <input name="date_start" class="date" type="text" value="{{isset($_GET['date_start']) ? $_GET['date_start'] : ''}}">
                    </div>
                    <div class="input-search col-md-3">
                        <label>Data final:</label>
                        <input name="date_end" class="date" type="text" value="{{isset($_GET['date_end']) ? $_GET['date_end'] : ''}}">
                    </div>
                    <div class="col-md-1 text-right">
                        <button type="submit" class="btn btn-default">Filtrar</button>

                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead>
                <th>#</th>
                <th>Tipo de investimento</th>
                <th>Aplicação Total</th>
                <th>Período Total</th>
                <th>Rendimento Cliente</th>
                <th>Rendimento Agencia</th>
                <th>Rendimento Total</th>
                <th>Data de Cadastro</th>
                <th>Opções</th>
                </thead>
                @if(count($results) > 0)
                <tbody>
                    @foreach($results as $value)
                    <tr>
                        <th>{{$value->id}}</th>
                        <th>{{$value->type->name}}</th>
                        <th>R$ {{ number_format($value->applications->sum('val_application'),2,",",".")}}</th>
                        <th>{{$value->total_period}} Dias</th>
                        <th>R$ {{ number_format($value->client_income,2,",",".")}}</th>
                        <th>R$ {{ number_format($value->agency_income,2,",",".")}}</th>
                        <th>R$ {{ number_format($value->total_income,2,",",".")}}</th>
                        <th>{{$value->created_at->format('d/m/Y')}}</th>
                        <th class="btn-group text-right">
                            <a href="{{route('investments.simulation.edit', ['id' => $value->id])}}" class="btn btn-default">Editar</a>
                            <form action="{{route('investments.simulation.destroy', ['id' => $value->id])}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-default">Remover</button></th>
                        </form>
                    </tr>
                    @endforeach                    
                </tbody>
                @else
                <tfoot>
                    <tr>
                        <td colspan="9" class="text-center msg-no-records">Nenhum registro encontrado!</td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
    </div>
</section>

<div class="row">
    <div class="col-md-12 text-right">
        {{ $results->appends(Request::all())->links() }}
    </div>
</div>
@endsection
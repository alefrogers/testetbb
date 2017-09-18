@extends('tbb.layouts.app')
@section('content-wrapper')

<section id="register-section" class="row">
    <div class="col-md-12 text-right">
        <div class="btn-group pull-right">
            <a href="{{route('investments.type.create')}}" class="btn btn-default">Novo Registro</a>
            <a href="{{route('investments.type.index')}}" class="btn btn-default"><i class="fa fa-refresh" aria-hidden="true"></i></a>
        </div>        
    </div>
</section>


<section id="types" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Tipos</h3>
    </div>
    <div class="panel-body">

        @if (session('msg-success'))        
        <div class="alert alert-success" role="alert">{{ session('msg-success') }}</div>        
        @elseif(session('msg-danger'))
        <div class="alert alert-danger" role="alert">{{ session('msg-danger') }}</div>  
        @endif

        <div class="alert alert-info" role="alert">Tipos de investimentos financeiros.</div>

        <div class="row">
            <form method="GET" action="{{route('investments.type.index')}}">
            <div class="col-md-12">
                <div class="input-search col-md-4">
                    <label>Data Inicial:</label>
                    <input name="date_start" class="date" type="text" value="{{isset($_GET['date_start']) ? $_GET['date_start'] : ''}}">
                </div>
                <div class="input-search col-md-4">
                    <label>Data Final:</label>
                    <input name="date_end" class="date" type="text" value="{{isset($_GET['date_end']) ? $_GET['date_end'] : ''}}">
                </div>
                <div class="col-md-4 text-right">
                    <button type="submit" class="btn btn-default">Filtrar</button>

                </div>
            </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Rentabilidade</th>
                <th>Taxa</th>
                <th>Período da Aplicação</th>
                <th>Data de Cadastro</th>
                <th>Opções</th>
                </thead>
                @if(count($results) > 0)
                <tbody>
                    @foreach($results as $value)
                    <tr>
                        <th>{{$value->id}}</th>
                        <th>{{$value->name}}</th>
                        <th>{{$value->profitability}}%</th>
                        <th>{{$value->rate}}%</th>
                        <th>{{$value->application_days}} dias</th>
                        <th>{{$value->created_at->format('d/m/Y')}}</th>
                        <th class="btn-group text-right">
                            <a href="{{route('investments.type.edit', ['type' => $value->id])}}" class="btn btn-default">Editar</a>
                            <form action="{{route('investments.type.destroy', ['type' => $value->id])}}" method="POST">
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
                        <td colspan="7" class="text-center msg-no-records">Nenhum registro encontrado!</td>
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
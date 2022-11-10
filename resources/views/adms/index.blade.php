@extends('layouts.app')
@section('title','Administradores')
@section('content')
    <h1>Catálogo</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-info">
            {{Session::get('mensagem')}}
        </div>
    @endif
    {{Form::open(['url'=>'adms/buscar','method'=>'GET'])}}
        <div class="row">
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                <div class="col-sm-3">
                    <a class="btn btn-success" href="{{url('adms/create')}}">Adicionar</a>
                </div>
            @endif
            <div class="col-sm-9">
                <div class="input-group ml-5">
                    @if($busca !== null)
                        &nbsp;<a class="btn btn-info" href="{{url('adms/')}}">Todos</a>&nbsp;
                    @endif
                    {{Form::text('busca',$busca,['class'=>'form-control','required','placeholder'=>'buscar'])}}
                    &nbsp;
                    <span class="input-group-btn">
                        {{Form::submit('Buscar',['class'=>'btn btn-secondary'])}}
                    </span>
                </div>
            </div>
        </div>
    {{Form::close()}}
    <br />
    <table class="table table-striped">
        @foreach ($adms as $adm)
            <tr>
                <td>
                    Nome: <a href="{{url('adms/'.$adm->id)}}">{{$adm->nome}}</a>
                </td>
                <td>
                    Telefone:{{$adm->telefone}}
                </td>
                <td>
                    E-Mail:{{$adm->email}}
                </td>
            </tr>
        @endforeach
    </table>
    {{ $adms->links() }}
@endsection
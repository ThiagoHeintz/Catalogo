@extends('layouts.app')
@section('title','Catálogo')
@section('content')
    <h1>Catálogo</h1>
    @if(Session::has('mensagem'))
        <div class="alert alert-info">
            {{Session::get('mensagem')}}
        </div>
    @endif
    {{Form::open(['url'=>'catalogos/buscar','method'=>'GET'])}}
        <div class="row">
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                <div class="col-sm-3">
                    <a class="btn btn-success" href="{{url('catalogos/create')}}">Adicionar</a>
                </div>
            @endif
            <div class="col-sm-9">
                <div class="input-group ml-5">
                    @if($busca !== null)
                        &nbsp;<a class="btn btn-info" href="{{url('catalogos/')}}">Todos</a>&nbsp;
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
        @foreach ($catalogos as $catalogo)
            <tr>
                <td>
                    Nome: <a href="{{url('catalogos/'.$catalogo->id)}}">{{$catalogo->nome}}</a>
                </td>
                <td>
                    Material:{{$catalogo->material}}
                </td>
                <td>
                    Quantidade:{{$catalogo->quantidade}}
                </td>
            </tr>
        @endforeach
    </table>
    {{ $catalogos->links() }}
@endsection
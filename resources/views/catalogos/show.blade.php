@extends('layouts.app')
@section('title',''.$catalogo->nome)
@section('content')
    <div class="card w-50 m-auto">
        @php
            $nomeimagem = "";
            if(file_exists("./img/catalogos/".md5($catalogo->id).".jpg")) {
                $nomeimagem = "./img/catalogos/".md5($catalogo->id).".jpg";
            } elseif (file_exists("./img/catalogos/".md5($catalogo->id).".png")) {
                $nomeimagem = "./img/catalogos/".md5($catalogo->id).".png";
            } elseif (file_exists("./img/catalogos/".md5($catalogo->id).".gif")) {
                $nomeimagem =  "./img/catalogos/".md5($catalogo->id).".gif";
            } elseif (file_exists("./img/catalogos/".md5($catalogo->id).".webp")) {
                $nomeimagem = "./img/catalogos/".md5($catalogo->id).".webp";
            } elseif (file_exists("./img/catalogos/".md5($catalogo->id).".jpeg")) {
                $nomeimagem = "./img/catalogos/".md5($catalogo->id).".jpeg";
            } else {
                $nomeimagem = "./img/catalogos/semfoto.webp";
            }
            //echo $nomeimagem;
        @endphp

        {{Html::image(asset($nomeimagem),'Foto de '.$catalogo->nome,["class"=>"img-thumbnail"])}}

        <div class="card-header">
            <h1>{{$catalogo->nome}}</h1>
        </div>
        <div class="card-body">
                <h3 class="card-title">{{$catalogo->obs}}</h3>
                <p class="text">
                Adm: {{$catalogo->adm->nome}}
                <br/>
                Quantidade: {{$catalogo->quantidade}}
                <br/>
                Valor: R${{$catalogo->valor}}
                <br/>
                Material: {{$catalogo->material}}
                <br/>
                Peso:"{{$catalogo->peso}}"G
                <br/>
                Tamanho: {{$catalogo->tamanho}}
            </p>
        </div>
        <div class="card-footer">
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                {{Form::open(['route' => ['catalogos.destroy',$catalogo->id],'method' => 'DELETE'])}}
                @if ($nomeimagem !== "./img/catalogos/semfoto.webp")
                {{Form::hidden('foto',$nomeimagem)}}
                @endif
                <a href="{{url('catalogos/'.$catalogo->id.'/edit')}}" class="btn btn-success">Alterar</a>
                {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
            @endif
                <a href="{{url('catalogos/')}}" class="btn btn-secondary">Voltar</a>
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                {{Form::close()}}
            @endif

        </div>
    </div>
@endsection
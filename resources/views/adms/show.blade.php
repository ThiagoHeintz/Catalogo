@extends('layouts.app')
@section('title',''.$adm->nome)
@section('content')
    <div class="card w-50 m-auto">
        @php
            $nomeimagem = "";
            if(file_exists("./img/adms/".md5($adm->id).".jpg")) {
                $nomeimagem = "./img/adms/".md5($adm->id).".jpg";
            } elseif (file_exists("./img/adms/".md5($adm->id).".png")) {
                $nomeimagem = "./img/adms/".md5($adm->id).".png";
            } elseif (file_exists("./img/adms/".md5($adm->id).".gif")) {
                $nomeimagem =  "./img/adms/".md5($adm->id).".gif";
            } elseif (file_exists("./img/adms/".md5($adm->id).".webp")) {
                $nomeimagem = "./img/adms/".md5($adm->id).".webp";
            } elseif (file_exists("./img/adms/".md5($adm->id).".jpeg")) {
                $nomeimagem = "./img/adms/".md5($adm->id).".jpeg";
            } else {
                $nomeimagem = "./img/adms/semfoto.webp";
            }
            //echo $nomeimagem;
        @endphp
        <div style="width: 250px;margin:auto;">
            {{Html::image(asset($nomeimagem),'Foto de '.$adm->nome,["class"=>"img-thumbnail"])}}
        </div>
        <div class="card-header">
            <h1>{{$adm->nome}}</h1>
        </div>
        <div class="card-body">
            <p class="text">
                Telefone: {{$adm->telefone}}
                <br/>
                E-Mail: {{$adm->email}}
            </p>
        </div>
        <div class="card-footer">
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                {{Form::open(['route' => ['adms.destroy',$adm->id],'method' => 'DELETE'])}}
                @if ($nomeimagem !== "./img/adms/semfoto.webp")
                {{Form::hidden('foto',$nomeimagem)}}
                @endif
                <a href="{{url('adms/'.$adm->id.'/edit')}}" class="btn btn-success">Alterar</a>
                {{Form::submit('Excluir',['class'=>'btn btn-danger','onclick'=>'return confirm("Confirma exclusão?")'])}}
            @endif
                <a href="{{url('adms/')}}" class="btn btn-secondary">Voltar</a>
            @if ((Auth::check()) && (Auth::user()->isAdmin()))
                {{Form::close()}}
            @endif

        </div>
    </div>
@endsection
@extends('layouts.app')
@section('title','Editar Produto')
@section('content')
<br>
    <h1>Alteração de Produto</h1>
@if(Session::has('mensagem'))
    <div class="alert alert-success">
        {{Session::get('mensagem')}}
    </div>    
@endif
<br>
{{Form::open(['route' => ['catalogos.update', $catalogo->id], 'method' => 'PUT','enctype'=>'multipart/form-data'])}}

{{Form::label('nome', 'Nome')}}
{{Form::text('nome', $catalogo->nome, ['class'=>'form-control', 'required', 'placeholder' =>'Nome'])}}

{{Form::label('idAdm', 'Administrador')}}
{{Form::text('idAdm',$catalogo->isAdm, ['class'=>'form-control', 'required', 'placeholder' =>'Selecione um Adm','list'=>'listadm'])}} 
    <datalist id='listadm'>
        @foreach($adms as $adm)  
            <option value="{{$adm->id}}">{{$adm->nome}}</option>
        @endforeach
    </datalist>

{{Form::label('valor', 'Valor')}}
{{Form::text('valor',$catalogo->valor, ['class'=>'form-control', 'required', 'placeholder' =>'Valor'])}}

{{Form::label('quantidade', 'Quantidade')}}
{{Form::text('quantidade',$catalogo->quantidade,['class'=>'form-control', 'required', 'placeholder' =>'Quantidade', 'rows'=>'8'])}}

{{Form::label('material', 'Material')}}
{{Form::text('material',$catalogo->material, ['class'=>'form-control', 'required', 'placeholder' =>'Material'])}}

{{Form::label('peso', 'Peso')}}
{{Form::text('peso',$catalogo->peso, ['class'=>'form-control', 'required', 'placeholder' =>'Peso em G'])}}

{{Form::label('tamanho', 'Tamanho')}}
{{Form::text('tamanho',$catalogo->tamanho, ['class'=>'form-control', 'required', 'placeholder' =>'Tamanho'])}}

{{Form::label('foto', 'Foto')}}
{{Form::file('foto',['class'=>'form-control','id'=>'foto'])}}
<br>
{{Form::submit('Salvar', ['class'=>'btn btn-success'])}}
{!!Form::button('Cancelar', ['onclick'=>'javascript:history.go(-1)','class'=> 'btn btn-danger'])!!}
{{Form::close()}}
@endsection
@extends('layouts.app')
@section('title','Adicionar Produto')
@section('content')
<br>
    <h1>Adicionar Produto</h1>
<br>
{{Form::open(['route' => 'catalogos.store', 'method' => 'POST', 'enctype'=>'multipart/form-data'])}}  

{{Form::label('nome', 'Nome')}}
{{Form::text('nome', '', ['class'=>'form-control', 'required', 'placeholder' =>'Nome'])}}

{{Form::label('idAdm', 'Administrador')}}
{{Form::text('idAdm', '', ['class'=>'form-control', 'required', 'placeholder' =>'Selecione um Adm','list'=>'listadm'])}} 
    <datalist id='listadm'>
        @foreach($adms as $adm)  
            <option value="{{$adm->id}}">{{$adm->nome}}</option>
        @endforeach
    </datalist>

{{Form::label('valor', 'Valor')}}
{{Form::text('valor', '', ['class'=>'form-control', 'required', 'placeholder' =>'Valor'])}}

{{Form::label('quantidade', 'Quantidade')}}
{{Form::text('quantidade','',['class'=>'form-control', 'required', 'placeholder' =>'Quantidade', 'rows'=>'8'])}}

{{Form::label('material', 'Material')}}
{{Form::text('material', '', ['class'=>'form-control', 'required', 'placeholder' =>'Material'])}}

{{Form::label('peso', 'Peso')}}
{{Form::text('peso', '', ['class'=>'form-control', 'required', 'placeholder' =>'Peso em G'])}}

{{Form::label('tamanho', 'Tamanho')}}
{{Form::text('tamanho', '', ['class'=>'form-control', 'required', 'placeholder' =>'Tamanho'])}}

{{Form::label('foto', 'Foto')}}
{{Form::file('foto',['class'=>'form-control','id'=>'foto'])}}

<br>
{{Form::submit('Salvar', ['class'=>'btn btn-success'])}}
{!!Form::button('Cancelar', ['onclick'=>'javascript:history.go(-1)','class'=> 'btn btn-danger'])!!}
{{Form::close()}}
@endsection
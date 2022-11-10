@extends('layouts.app')
@section('title','Adicionar Adm')
@section('content')
<br>
    <h1>Adicionar Administrador</h1>
<br>
{{Form::open(['route' => 'adms.store', 'method' => 'POST', 'enctype'=>'multipart/form-data'])}}  

{{Form::label('nome', 'Nome')}}
{{Form::text('nome','', ['class'=>'form-control', 'required', 'placeholder' =>'Nome'])}}

{{Form::label('telefone', 'Telefone')}}
{{Form::text('telefone','', ['class'=>'form-control', 'required', 'placeholder' =>'Telefone'])}}

{{Form::label('email', 'E-Mail')}}
{{Form::text('email','', ['class'=>'form-control', 'required', 'placeholder' =>'E-Mail'])}}

{{Form::label('foto', 'Foto')}}
{{Form::file('foto',['class'=>'form-control','id'=>'foto'])}}

<br>
{{Form::submit('Salvar', ['class'=>'btn btn-success'])}}
{!!Form::button('Cancelar', ['onclick'=>'javascript:history.go(-1)','class'=> 'btn btn-danger'])!!}
{{Form::close()}}
@endsection
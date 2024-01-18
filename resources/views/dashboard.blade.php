@extends('layouts.app', ['activePage' => $info['activePage'], 'collapse' => $info['collapse'], 'title' => 'Modulo
Inicial'])

@section('content')
<div class="content">

    @include('shared/message')

    <h3 style="margin-top: 15px">Dashboard del Modulo de Muestra</h3>



</div>
@endsection
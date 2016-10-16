@extends('layouts.app')

@section('content')
	<div class="jumbotron" id="landing">
		<div class="container">
			<div class="page-header">
				<h1>Politika</h1>
				<h3>Porque nuestro deseo, es promover el acceso a ella. ¿Que esperas para unirte y debatir?</h3>
				<button class="btn btn-lg btn-info"><i class="fa fa-user-plus" aria-hidden="true"></i> Quiero Unirme</button>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="text-center">
			<h1>Nuestro deber es informar, debatir para progresar</h1>
			<h4>Conoce las últimas leyes publicadas</h4>
		</div>
		<div class="row">
			@foreach ($laws as $law)
			<div class="col-md-4">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Numero BCN Nº <strong>{{ $law['@attributes']['nro_bcn'] }}</strong></h3>
				  </div>
				  <div class="panel-body fixed-panel">
				    <h3>{{ $law['TIPOS_NUMEROS']['TIPO_NUMERO']['COMPUESTO'] }}</h3>
				    <h4>{{ $law['TITULO'] }}</h4>
				    <p>Fecha publicación: {{ $law ['FECHA_PUBLICACION']}}</p>
				    <p>Fecha promulgación: {{ $law['FECHA_PROMULGACION'] }}</p>
				  </div>
				  <div class="panel-footer"><a href="{{ route('search.law.bcn', ['bcnId' => $law['@attributes']['nro_bcn']]) }}"><button class="btn btn-info">Más Información</button></a></div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection

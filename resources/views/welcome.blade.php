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
	<hr>
	<div class="container-fluid">
		<div class="text-center" id="mensaje-landing">
			<h1>Nuestro <span class="color-destacador">deber</span> es informar, <u>debatir</u> para progresar</h1>
			<h4>¿Quieres conocer las últimas leyes publicadas?</h4>

		</div>
		<hr>
		<div class="row" id="ultimas-leyes">
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
		<div class="row" id="representantes">
			<div class="container-fluid">
				<div class="text-center">
					<h2>¿Interesado en <strong>quién</strong> te representa?</h2>
					<div class="col-md-4">
						<div>
							<h4>¿Que partido político tiene mayor presencia?</h4>
						</div>
					</div>
					<div class="col-md-4">
						<div>
							<h4>¿Quienes representan mi región?</h4>
						</div>
					</div>
					<div class="col-md-4">
						<div>
							<h4>¿Quienes tienen mayor/menor asistencia al congreso?</h4>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

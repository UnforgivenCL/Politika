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
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
				  <!-- Default panel contents -->
				  <div class="panel-heading"><div class="text-center"><h5>ÚLTIMAS LEYES</h5></div></div>

				  <!-- Table -->
				  <table class="table table-responsive table-bordered table-hover table-condensed">
				  	<thead>
				  		<tr>
				  			<td>Número BCN</td>
				  			<td>Ley Nº</td>
				  			<td>Titulo</td>
				  			<td>Fecha Publicación</td>
				  			<td>Fecha Promulgación</td>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		@foreach ($laws as $law)
					  		<tr>
					  			<td><strong>{{ $law['@attributes']['nro_bcn'] }}</strong></td>
					  			<td>{{ $law['TIPOS_NUMEROS']['TIPO_NUMERO']['COMPUESTO'] }}</td>
					  			<td>{{ $law['TITULO'] }}</td>
					  			<td>{{ $law ['FECHA_PUBLICACION']}}</td>
					  			<td>{{ $law['FECHA_PROMULGACION'] }}</td>
					  		</tr>
				  		@endforeach
				  	</tbody>
				  </table>
				</div>
			</div>
		</div>
	</div>
@endsection

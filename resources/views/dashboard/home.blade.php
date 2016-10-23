@extends('layouts.app')

@section('content')
@include('dashboard.partials.sidebar')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-2">
			<h3>Revisa los últimos movimientos</h3>
			<div class="panel panel-default">
				<div class="panel-heading">Inicio - {{ config('app.name', 'Laravel') }}</div>

					<div class="panel-body">
						@foreach ($laws as $law)
							<div>
								<h3>{{ $law['TIPOS_NUMEROS']['TIPO_NUMERO']['COMPUESTO'] }} (BCN: <small>{{ $law['@attributes']['nro_bcn'] }}</small>)</h3>
								<h5>{{ $law['TITULO'] }}</h5>
								<p>Fecha publicación: {{ $law ['FECHA_PUBLICACION']}}</p>
				    			<p>Fecha promulgación: {{ $law['FECHA_PROMULGACION'] }}</p>
				    			<div><a href="{{ route('search.law.bcn', ['bcnId' => $law['@attributes']['nro_bcn']]) }}"><button class="btn btn-info">Más Información</button></a> - <button class="btn btn-success">Ir al debate</button></div>
							</div>
							<hr>
						@endforeach
					 </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

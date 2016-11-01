@extends('layouts.app')

@section('content')
	<div class="jumbotron">
		<div class="container">
			<h2>{{ isset($law['Metadatos']['TituloNorma']) ? $law['Metadatos']['TituloNorma'] : 'Sin información' }}</h2>
			<h2>Norma Nº {{ isset($law['@attributes']['normaId']) ? $law['@attributes']['normaId'] : 'Sin información' }}</h2>
			@if (isset($law['Identificador']['Organismos']['Organismo']) && is_array($law['Identificador']['Organismos']['Organismo']))
				@foreach ($law['Identificador']['Organismos']['Organismo'] as $organism)
					<p>Organismo: {{ $organism }}</p>
				@endforeach
			@else
				<p>Organismo: {{ isset($law['Identificador']['Organismos']['Organismo']) ? $law['Identificador']['Organismos']['Organismo'] : 'Sin información' }}</p>
			@endif
			<p>Fecha de versión norma: {{ isset($law['@attributes']['fechaVersion']) ? $law['@attributes']['fechaVersion'] : 'Sin información' }}</p>
			<div class="text-center">
				<h3>¿Te interesa debatir sobre esta norma?</h3>
				<button class="btn btn-info">Iniciar Debate</button>
			</div>
			<hr>
			<h5>Palabrás mas destacadas:</h5>
			@foreach ($words as $word)
				@if (!$loop->last)
					<strong>{{ isset($word['word']) ? $word['word'].' -' : '' }}</strong>
				@else
					<strong>{{ isset($word['word']) ? $word['word'] : '' }}</strong>
				@endif
			@endforeach
		</div>
	</div>
	<div class="container">
		<div class="col-md-12">
			<h3>Encabezado: </h3>
			<p>{{ isset($law['Encabezado']['Texto']) ? $law['Encabezado']['Texto'] : 'Sin Información'  }}</p>
			<h3>Contenido</h3>
			@if (isset($law['EstructurasFuncionales']['EstructuraFuncional']))
				@foreach ($law['EstructurasFuncionales']['EstructuraFuncional'] as $contenido)
					<p>{{ isset($contenido['Texto']) ? $contenido['Texto'] : 'Sin Información' }}</p>
				@endforeach
			@endif
			<h3>Promulgación:</h3>
			<p>{{ isset($law['Promulgacion']['Texto']) ? $law['Promulgacion']['Texto'] : 'Sin información' }}</p>
		</div>
	</div>
@endsection

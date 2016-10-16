<template>
	<div class="row">
		<div class="col-md-4" v-for="law in laws">
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Numero BCN Nº <strong>{{ law['@attributes']['nro_bcn'] }}</strong></h3>
			  </div>
			  <div class="panel-body fixed-panel">
			    <h3>{{ $law['TIPOS_NUMEROS']['TIPO_NUMERO']['COMPUESTO'] }}</h3>
			    <h4>{{ $law['TITULO'] }}</h4>
			    <p>Fecha publicación: {{ $law ['FECHA_PUBLICACION']}}</p>
			    <p>Fecha promulgación: {{ $law['FECHA_PROMULGACION'] }}</p>
			  </div>
			  <div class="panel-footer"><a href="#"><button class="btn btn-info">Más Información</button></a></div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Latest Laws ready.')
            this.fetchLatest()
        },

        data() {
        	return {
        		'laws': null
        	}
        },

        methods: {
        	fetchLatest() {
				this.$http.get('/api/laws/latests').then((response) => {
					this.laws = response.body['NORMA']
					console.log(this.laws)
			    }, (response) => {

		   	    })
        	}
        }
    }
</script>

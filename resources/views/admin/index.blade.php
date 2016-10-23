@extends('layouts.app')

@section('content')
	<div class="nav-side-menu">
		<div class="brand">Logo</div>
		<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

		    <div class="menu-list">

		        <ul id="menu-content" class="menu-content collapse out">
		            <li>
		              <a href="#">
		              <i class="fa fa-dashboard fa-lg"></i> Inicio
		              </a>
		            </li>


		            <li data-toggle="collapse" data-target="#service" class="collapsed">
		              <a href="#"><i class="fa fa-globe fa-lg"></i> Servicios <span class="arrow"></span></a>
		            </li>
		            <ul class="sub-menu collapse" id="service">
		              <li>Leyes</li>
		              <li>Senadores</li>
		              <li>Diputados</li>
		              <li>Debates</li>
		            </ul>


		            <li data-toggle="collapse" data-target="#new" class="collapsed">
		              <a href="#"><i class="fa fa-car fa-lg"></i> Agregar <span class="arrow"></span></a>
		            </li>
		            <ul class="sub-menu collapse" id="new">
		              <li>Agregar Nueva Entrada</li>
		            </ul>


		             <li>
		              <a href="#">
		              <i class="fa fa-user fa-lg"></i> Estadisticas Detalladas
		              </a>
		              </li>

		             <li>
		              <a href="#">
		              <i class="fa fa-users fa-lg"></i> Usuarios
		              </a>
		            </li>
		        </ul>
		 </div>
		</div>
		<div class="container">
			<div class="col-md-12 col-md-offset-1">
				<div class="text-center">
					<h3>Panel de administración</h3>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<button class="btn btn-lg btn-success">Actualizar Diputados</button>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<h4>asd</h4>
				</div>
				<div class="col-sm-3 col-sm-offset-1">
					<h4>asd</h4>
				</div>

			</div>
		</div>
@endsection

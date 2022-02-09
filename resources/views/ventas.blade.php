@extends('layaouts.master')
@section('titulo','Interface de Ventas')
@section('contenido')
 <!-- INICIO DE VUE -->
 	<div id="apiVenta">
 		<div class="container">
 			<div class="row">
 				<div class="col-md-4">
					<div class="input-group mb-3">
  						<input type="text" class="form-control" placeholder="Introduzca el codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku" v-on:keyup.enter="buscarProducto()">
  							<div class="input-group-append">
    					<button class="btn btn-primary" type="button" @click="buscarProducto()">Buscar</button >
  							</div>
					</div>
				</div>
 					
 			</div> <!--Fin de div row-->

<div class="card">
	<div class="card-body">

 			<div class="row">

 				<div class="col-md-12">

 					<table class="table table-bordered">
 						<thead>
 							<th style="background: #ffff66;">SKU</th>
 							<th style="background: #ffff66;">NOMBRE</th>
 							<th style="background: #ffff66;">PRECIO</th>
 							<th style="background: #ffff66;">CANTIDAD</th>
 							<th style="background: #ffff66;">TOTAL</th>
 						</thead>

 						<tbody>
 							<tr v-for="(venta,index) in ventas">
 								<td>@{{venta.sku}}</td>
 								<td>@{{venta.nombre}}</td>
 								<td>@{{venta.precio}}</td>
 								<td><input type="number" v-model.number="cantidades[index]"></td>
 								<td>@{{totalProducto(index)}}</td>
 								
 							</tr>
 						</tbody>
 						
 					</table>
 					
 				</div>
 				
 			</div>
 			<!-- Fin del ROW -->

 	</div>	
 	<!-- FIN DEL CARD BODY -->
 </div>	
<!-- FIN DE CARD -->

@{{cantidades}}
<hr>
@{{ventas}}

<div class="row">
	<div class="col-md-8"></div>

<div class="col-md-4">	

	<div class="card">
		<div class="card-body">
				<table class="table table-bordered table-condensed">
					<tr>
						<th style="background: #ffff66">Subtotal</th>
						<td>$ @{{subTotal}}</td>
					</tr>

					<tr>
						<th style="background: #ffff66">IVA</th>
						<td>$ @{{iva}}</td>
					</tr>

					<tr>
						<th style="background: #ffff66">TOTAL</th>
						<td><b>$ @{{granTotal}}</b></td>
					</tr>

					<tr>
						<th style="background: #ffff66">Articulos</th>
						<td>@{{noArticulos}}</td>
					</tr>
					
				</table>
		</div>
		<!-- FIN DEL CARD BODY -->
	</div>
	<!-- FIN DEL CARD -->
</div>	
	<!-- FIN DEL COL MD 4 -->	
	
</div>
 				
 		</div> <!--Fin de div container-->
 			
 	</div><!--Fin de VUE-->





@endsection
@push('scripts')
	<script type="text/javascript" src="{{asset('js/apis/apiVenta.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
	@endpush

	<input type="hidden" name="route" value="{{url('/')}}">
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
    					<button class="btn btn-primary" type="button" @click="buscarProducto()"> <i class="fas fa-search"></i> </button >
    					<button class="btn btn-success " @click="mostrarCobro">Cobrar</button>
  							</div>
					</div>
				</div>
 					
 			</div> <!--Fin de div row--> 

<div class="card">
	<div class="card-body">

 			<div class="row">

 				<div class="col-md-12">

 					<p align="right"><h2>Folio: @{{folio}}</h2></p>

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
 								<td>@{{venta.nombre}}
 									<img :src="venta.foto" width="100" height="100">
 								</td>
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

 		<!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asistente de Cobro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-row">
          	<div class="col-md-2">
          		<label> A PAGAR: </label>
          	</div>
          	<div class="col-md-6">
          		<input type="number" class="form-control" disabled :value="granTotal">
          	</div><br>

          	  </div>

          	<div class="form-row">
          		<div class="col-md-2">
          			<label>PAGA CON: </label>
          			
          		</div>

          		<div class="col-md-6">
          			<input type="number" class="form-control" v-model="pagara_con">
          			
          		</div><br>

          		</div>

          		<div class="form-row">
          			<div class="col-md-2">
          				<label>SU CAMBIO ES</label>
          			</div>

          			<div class="col-md-6">
          				<input type="number" class="form-control" disabled :value="cambio">
          			</div>
          			
          		</div>
          		
          	

        
            
          
             
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="vender()">Finalizar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
 			
 	</div><!--Fin de VUE-->





@endsection
@push('scripts')
	<script type="text/javascript" src="{{asset('js/apis/apiVenta.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/moment-with-locales.min.js')}}"></script>
	@endpush

	<input type="hidden" name="route" value="{{url('/')}}">
@extends('layaouts.master')
@section('titulo','Interface de Ventas')
@section('contenido')
 <!-- INICIO DE VUE -->
 <div id="apiProductos">

    <h1>@{{mensaje}}</h1>

        <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h4>CRUD Productos <button class="btn btn-primary btn-sm" @click="showModal()"><i class="fas fa-plus fa-lg"></i></button></h4>
                </div>
                <div class="card-body">
        <!-- INICIO DE LA TABLA -->
            <p :align="alineacion">@{{frase}}</p>
            <table class="table table-bordered table-striped">
                <thead>
                    <th>SKU</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>ACCIONES</th>
                </thead>

                <tbody>
                       <tr v-for="producto in productos">
                                <td>@{{producto.sku}}</td>
                                <td>@{{producto.nombre}}</td>
                                <td>@{{producto.precio}}</td>
                                <td>@{{producto.cantidad}}</td>
                                 <td>
                            <button class="btn btn-sm" @click="editProducto(producto.sku)"> <i class="fas fa-edit fa-lg"></i> </button>

                            <button class="btn btn-sm" @click="deleteProducto(producto.sku)"> <i class="fas fa-trash-alt fa-lg"></i></button>
                        </td>
                       
                    </tr>
                </tbody>
            </table>
        <!-- FIN DE LA TABLA -->
             </div>
         </div>
        <!-- FIN DEL CARD -->
            
       </div>
     <!-- FIN DEL DIV COL-MD-12 -->
        
    </div>
 <!-- FIN DEL DIV.ROW -->

        <!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalPro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">Registro de Productos</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">Editando la Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <input type="text" class="form-control" placeholder="Escriba el SKU" v-model="sku"><br>
        
        <input type="text" class="form-control" placeholder="Nombre del producto" v-model="nombre"><br>

        <input type="number" class="form-control" placeholder="Escriba el precio" v-model="precio"><br>

        <input type="number" class="form-control" placeholder="Escriba la cantidad de productos" v-model="cantidad">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="addProducto()" v-if="agregando==true">Guardar</button>
        <button type="button" class="btn btn-warning" @click="actualizarProducto()" v-if="agregando==false">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->


       @{{productos}}
     
 </div>
 @endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('js/apis/apiProductos.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
    @endpush

    <input type="hidden" name="route" value="{{url('/')}}">
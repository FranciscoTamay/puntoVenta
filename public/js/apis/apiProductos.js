function init(){

	var apiProducto='http://localhost/puntoVenta/public/apiProducto'

new Vue({

	// le asignamos el token 
	 http: {
            headers: {
               'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiProductos',

	data:{
		mensaje:'Hello World',
		//agregando:true,
		sku:'',
		nombre:'',
		precio:null,
		cantidad:null,
		productos:[],
		agregando:true,
		producto:'',
		frase:'Hola Mundo Desde la UTC',
		alineacion:'center',
		find:'',
	},

	//Al crear la pagina se iniciara 
	created:function(){
		 this.obtenerProductos();
	},

	// inicio de los metodos
	methods:{
		
		obtenerProductos:function(){
			this.$http.get(apiProducto).then(function(json){
				this.productos=json.data;
			}).catch(function(json){
				 console.log(json);
			});
		},

		//ventana modal 
		showModal(){
			this.agregando=true;
			this.sku='',
			this.nombre='',
			this.precio='',
			this.cantidad='',
			$('#modalPro').modal('show');
		},

		addProducto(){
			// se contruye el json que se enviara al controlador
			var producto={sku:this.sku,nombre:this.nombre,precio:this.precio,cantidad:this.cantidad};

			// se envian los datos al controlador
			this.$http.post(apiProducto,producto).then(function(j){
				console.log('Inserccion Exitosa');
				this.obtenerProductos();
			}).catch(function(j){
				// console.log(j);
			});

			$('#modalPro').modal('hide');
			console.log(producto);

			

		},
		//fin de addProducto

		deleteProducto(id){
			var confirmacion=confirm('¿Estas seguro de querer borrar el producto?');
			

			if (confirmacion){
				this.$http.delete(apiProducto + '/' + id).then(function(json){
				this.obtenerProductos();
			}).catch(function(json){
				//console.log(json)
			});

			}

		},
		//fin de deleteProducto

		editProducto(id){
		   this.agregando=false;
			this.sku=id;
			this.$http.get(apiProducto + '/' + id).then(function(json){
					this.sku=json.data.sku;
					this.nombre=json.data.nombre;
					this.precio=json.data.precio;
					this.cantidad=json.data.cantidad;
			});

			$('#modalPro').modal('show');
		},
		//fin editProducto

		actualizarProducto(){
			var jsonPro={
				sku:this.sku,
				nombre:this.nombre,
				precio:this.precio,
				cantidad:this.cantidad,
			};

			this.$http.patch(apiProducto + '/' + this.sku,jsonPro).then(function(json){
				this.obtenerProductos();
			});

			$('#modalPro').modal('hide');
		},


	
}, 
// fin de los metodos
computed:{

	filtroProd:function(){
		return this.productos.filter((producto)=>{
			return producto.nombre.toLowerCase().match(this.find.toLowerCase().trim())
		});
	},


},

});

} window.onload = init;
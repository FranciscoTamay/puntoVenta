function init(){

var apiVenta='http://localhost/Pruebas/public/apiProducto'

new Vue({

// le asignamos el token 
	 http: {
            headers: {
               'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
            }
        },

	el:'#apiVenta',

	data:{
		mensaje:'Hola Mundo',
		sku:'',
		ventas:[],
		cantidades:[1,1,1,1,1,1,1,1,1,1],
		cant:1,
		auxSubtotal:0,
		pagara_con:0,
		folio:'',


	},


	//se ejecuta automaticamente cuando la pagina se crea
	created:function(){
		this.foliar();
	},
 	
 	//INICIO DE METHODS
	methods:{

		buscarProducto:function(){
			var encontrado=0;
			if(this.sku)
			{
			var producto = {};

			//rutina de busqueda
			for (var i = 0; i < this.ventas.length; i++) {
				if (this.sku===this.ventas[i].sku) {
					encontrado=1;
					this.ventas[i].cantidad++;
					this.cantidades[i]++;
					this.sku='';
					break;
				}
				//this.ventas[i]
			}

			//fin de la rutina de busqueda

			//Inicio del GET de AJAX

			if (encontrado===0)
			this.$http.get(apiVenta + '/' + this.sku).then(function(json){
				producto = {
					sku:json.data.sku,
					nombre:json.data.nombre,
					precio:json.data.precio,
					cantidad:1,
					total:json.data.precio,
					foto:'prods/' + json.data.foto,
				};

				
				this.ventas.push(producto);
				this.cantidades.push(1);
				this.sku='';

			});

			//Fin de GET de AJAX
		  }

		},

		//Inicio del modal 

		mostrarCobro:function(){
			$('#modalCobro').modal('show');
		},

		foliar:function(){ 
			this.folio="VNT-" + moment().format('YYMMDDhmmss');
		},

		vender:function(){
			var unaVenta={};
			var deta=[];


			//Preparamos un JSON con los detalles
			for (var i = 0; i < this.ventas.length; i++) {
					deta.push(
					{sku:this.ventas[i].sku,
						folio:this.folio,
						cantidad:this.ventas[i].cantidad,
						precio:this.ventas[i].precio,
						total:this.ventas[i].total
					}
					);
			}
			//Fin del JSON de los detalles
			unaVenta={
				folio:this.folio,
				fecha:moment().format('YYYY-MM-DD'),
				num_articulos:this.noArticulos,
				subtotal:this.subTotal,
				iva:this.iva,
				total:this.granTotal,
				detalles:deta,
			};
			$('#modalCobro').modal('hide');
			console.log(unaVenta);
		},


	},
 //FIN DE METHODS

 	computed:{
 		totalProducto(){
 			return (id)=>{
 				var total = 0;
 				if (this.cantidades[id]!=null)
 				total=this.ventas[id].precio*this.cantidades[id];
 				//se actualiza el total de producto en el array de ventas
 				this.ventas[id].total=total;
 				//actualiza la cantidad en el array de ventas
 				this.ventas[id].cantidad=this.cantidades[id];
 				return total.toFixed(1);
 			}
 		},
 		//fin de total producto
 		subTotal(){
 			var total=0;

 			for (var i = this.ventas.length - 1; i >= 0; i--) {
 				total=total+this.ventas[i].total;
 			}

 			//Mando una copia del subTotal a la seccion del data 
 			// para el uso de otros calculos
 			this.auxSubtotal=total.toFixed(1);
 			return total.toFixed(1);
 		},
 		//fin de subtotal de los productos

 		iva(){
 			var auxIva=0;
 			auxIva=this.auxSubtotal*0.16;
 			return auxIva.toFixed(1);

 		},
 		//fin del computed iva

 		granTotal(){
 			var auxTotal=0;
 			auxTotal=this.auxSubtotal*1.16;
 			return auxTotal.toFixed(1);
 		},

 		noArticulos(){
 			var acum=0;
 			for (var i = this.ventas.length - 1; i >= 0; i--) {
 				acum=acum+this.ventas[i].cantidad;
 			}

 			return acum;
 		},

 		cambio(){
 			var camb=0; 
 			camb=this.pagara_con - this.granTotal;
 			camb=camb.toFixed(1);
 			return camb;
 		}
 	},
	


});


} window.onload = init;
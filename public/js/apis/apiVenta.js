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


	},


	//se ejecuta automaticamente cuando la pagina se crea
	created:function(){
		
	},
 	
 	//INICIO DE METHODS
	methods:{

		buscarProducto:function(){
			if(this.sku)
			{
			var producto = {};
			this.$http.get(apiVenta + '/' + this.sku).then(function(json){
				producto = {
					sku:json.data.sku,
					nombre:json.data.nombre,
					precio:json.data.precio,
					cantidad:1,
					total:json.data.precio
				};

				
				this.ventas.push(producto);
				this.cantidades.push(1);
				this.sku='';

			});
		  }	
		}


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
 	},
	


});


} window.onload = init;
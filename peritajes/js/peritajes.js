function nuevoPeritaje(){
    const http=new XMLHttpRequest();
	const url = 'index.php';
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
			console.log(this.responseText);
			document.getElementById("div_resultados_peritajes").innerHTML = this.responseText;
		}
	};
	http.open("POST",url);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("opcion=nuevo");
}

function consultaPeritaje(){
    const http=new XMLHttpRequest();
	const url = 'index.php';
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
			console.log(this.responseText);
			document.getElementById("div_peritajes").innerHTML = this.responseText;
		}
	};
	http.open("POST",url);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("opcion=consultar");
}

function buscarPlacaPeritaje(){
    var placa = document.getElementById("placaPeritaje").value;
    const http=new XMLHttpRequest();
	const url = 'index.php';
	http.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
			console.log(this.responseText);
			document.getElementById("divResultadobusqueda").innerHTML = this.responseText;
		}
	};
	http.open("POST",url);
	http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	http.send("opcion=buscarPlaca"+ "&placa="+placa);
}

function grabarPeritaje(){
    valida = validacionesPeritaje();
    if(valida != 0){
        var idcarro = document.getElementById("idCarroPeritaje").value;
        var kilometraje = document.getElementById("kilometrajeperitaje").value;
        var amortiguadores = document.getElementById("amortiguadores").value;
        var exosto = document.getElementById("exosto").value;
        var arrastre = document.getElementById("arrastre").value;
        var llantas = document.getElementById("llantas").value;
        var sillin = document.getElementById("sillin").value;
        var velocimetro = document.getElementById("velocimetro").value;
        var frenos = document.getElementById("frenos").value;
        var luces = document.getElementById("luces").value;
        var motor = document.getElementById("motor").value;
        var tacometro = document.getElementById("tacometro").value;
        var observaciones = document.getElementById("observacionesPeritaje").value;
        const http=new XMLHttpRequest();
        const url = 'index.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("div_peritajes").innerHTML = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=grabar"
            + "&idcarro="+idcarro
            + "&kilometraje="+kilometraje
            + "&amortiguadores="+amortiguadores
            + "&exosto="+exosto
            + "&arrastre="+arrastre
            + "&llantas="+llantas
            + "&sillin="+sillin
            + "&velocimetro="+velocimetro
            + "&frenos="+frenos
            + "&luces="+luces
            + "&motor="+motor
            + "&tacometro="+tacometro
            + "&observaciones="+observaciones
            );
    }
}

function validacionesPeritaje(){
      if(document.getElementById("kilometrajeperitaje").value == '')
      {
         alert("Digite Kilometraje..") ;  
         document.getElementById("kilometrajeperitaje").focus();
         return 0;
      }
      if(document.getElementById("amortiguadores").value == 0)
      {
         alert("Escoja estado Amortiguadores") ;  
         document.getElementById("amortiguadores").focus();
         return false
      }
      if(document.getElementById("exosto").value == 0)
      {
         alert("Escoja estado exosto") ;  
         document.getElementById("exosto").focus();
         return false
      }
      if(document.getElementById("arrastre").value == 0)
      {
         alert("Escoja estado kit de arrastre") ;  
         document.getElementById("arrastre").focus();
         return false
      }
      if(document.getElementById("llantas").value == 0)
      {
         alert("Escoja estado llantas") ;  
         document.getElementById("llantas").focus();
         return false
      }
      if(document.getElementById("sillin").value == 0)
      {
         alert("Escoja estado sillin") ;  
         document.getElementById("sillin").focus();
         return false
      }
    
      if(document.getElementById("velocimetro").value == 0)
      {
         alert("Escoja estado velocimetro") ;  
         document.getElementById("velocimetro").focus();
         return false
      }
      if(document.getElementById("frenos").value == 0)
      {
         alert("Escoja estado frenos") ;  
         document.getElementById("frenos").focus();
         return false
      }
      if(document.getElementById("luces").value == 0)
      {
         alert("Escoja estado luces") ;  
         document.getElementById("luces").focus();
         return false
      }
    
      if(document.getElementById("motor").value == 0)
      {
         alert("Escoja estado motor") ;  
         document.getElementById("motor").focus();
         return false
      }
      if(document.getElementById("tacometro").value == 0)
      {
         alert("Escoja estado tacometro") ;  
         document.getElementById("tacometro").focus();
         return false
      }
    
      if(document.getElementById("observacionesPeritaje").value == '')
      {
         alert("Digite Observaciones") ;  
         document.getElementById("observacionesPeritaje").focus();
         return 0;
      }
    return 1;
  }

  
function muestreDetallePeritaje(id){
    
    var id = id;
    const http=new XMLHttpRequest();
    const url = 'index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
              console.log(this.responseText);
           document.getElementById("cuerpoModal").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=consultaPeritajeId"
        +'&id='+id);

}
function editarPeritaje(id){
     var id = id;
    const http=new XMLHttpRequest();
    const url = 'index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
           console.log(this.responseText);
           document.getElementById("cuerpoModal1").innerHTML  = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=editarPeritajeId"
        +'&id='+id);
}

function actualizarDatosPeritaje(id){
    var id= id;
    var amortiguadores = document.getElementById("amortiguadores").value;
    var exosto = document.getElementById("exosto").value;
    var arrastre = document.getElementById("arrastre").value;
    var llantas = document.getElementById("llantas").value;
    var sillin = document.getElementById("sillin").value;
    var velocimetro = document.getElementById("velocimetro").value;
    var frenos = document.getElementById("frenos").value;
    var luces = document.getElementById("luces").value;
    var motor = document.getElementById("motor").value;
    var tacometro = document.getElementById("tacometro").value;
    const http=new XMLHttpRequest();
    const url = 'index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("div_resultados_peritajes").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=actualizarPeritaje"
        + "&amortiguadores="+amortiguadores
        + "&id="+id
        + "&exosto="+exosto
        + "&arrastre="+arrastre
        + "&llantas="+llantas
        + "&sillin="+sillin
        + "&velocimetro="+velocimetro
        + "&frenos="+frenos
        + "&luces="+luces
        + "&motor="+motor
        + "&motor="+motor
        + "&tacometro="+tacometro
        );
    }

   function btnNuevoPropietario(){
        const http=new XMLHttpRequest();
        const url = 'index.php';
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status ==200){
                console.log(this.responseText);
                document.getElementById("cuerpoModal3").innerHTML = this.responseText;
            }
        };
        http.open("POST",url);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("opcion=nuevoPropietario"
            );
   }


   function grabarPrpietario()
   {
        valida = validacionesPropietario();
        if(valida != 0)
        {
            var identi =  document.getElementById("identi").value;
            var nombre =  document.getElementById("nombre").value;
            var telefono =  document.getElementById("telefono").value;
            var direccion =  document.getElementById("direccion").value;
            var observaciones =  document.getElementById("observaciones").value;
            const http=new XMLHttpRequest();
            const url = 'index.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    console.log(this.responseText);
                    document.getElementById("cuerpoModal3").innerHTML = this.responseText;
                }
            };

            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=grabarPropietario"
                        + "&identi="+identi
                        + "&nombre="+nombre
                        + "&telefono="+telefono
                        + "&direccion="+direccion
                        + "&observaciones="+observaciones
                );

                //aqui debe llamar otra funcion qque busque el ultimo cliente grabado y
                //lo deje seleccionado en el selec de propietario de la captura de datos de la moto
                setTimeout(function(){ 
                cargarSelectClienteId();
                },500);
                setTimeout(function(){ 
                    document.getElementById("marca").focus();
                },500);
        }     
    }
    
    function cargarSelectClienteId(){
       const http=new XMLHttpRequest();
       const url = 'index.php';
       http.onreadystatechange = function(){
           if(this.readyState == 4 && this.status ==200){
               console.log(this.responseText);
               document.getElementById("selectPropietario").innerHTML = this.responseText;
           }
       };
       http.open("POST",url);
       http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       http.send("opcion=cargarUltimoPropietario");   
   }

   function grabarVehiculo()
   {
        
        valida = validacionesCarro();
        if(valida != 0)
        { 
            // alert('pora aqui va ');
            var placa =  document.getElementById("placaPeritaje").value;
            var propietario =  document.getElementById("selectPropietario").value;
            var marca =  document.getElementById("marca").value;
            var linea =  document.getElementById("linea").value;
            var modelo =  document.getElementById("modelo").value;
            var color =  document.getElementById("color").value;
            var vencisoat =  document.getElementById("vencisoat").value;
            var revision =  document.getElementById("revision").value;
            var chasis =  document.getElementById("chasis").value;
            var motor =  document.getElementById("motor").value;

            const http=new XMLHttpRequest();
            const url = 'index.php';
            http.onreadystatechange = function(){
                if(this.readyState == 4 && this.status ==200){
                    console.log(this.responseText);
                    document.getElementById("divResultadobusqueda").innerHTML = this.responseText;
                }
            };

            http.open("POST",url);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send("opcion=grabarVehiculo1"
                    + "&placa="+placa
                    + "&propietario="+propietario
                    + "&marca="+marca
                    + "&linea="+linea
                    + "&modelo="+modelo
                    + "&vencisoat="+vencisoat
                    + "&revision="+revision
                    + "&chasis="+chasis
                    + "&motor="+motor
                    + "&color="+color
                );
                
        }
    }

  
function validacionesPropietario(){
    if(document.getElementById("identi").value == '')
    {
       alert("Digite Identidad") ;  
       document.getElementById("identi").focus();
       return 0;
    }
    if(document.getElementById("nombre").value == 0)
    {
       alert("Digite nombre ") ;  
       document.getElementById("nombre").focus();
       return false
    }
    if(document.getElementById("telefono").value == 0)
    {
       alert("Digite telefono ") ;  
       document.getElementById("telefono").focus();
       return false
    }
    if(document.getElementById("direccion").value == 0)
    {
       alert("Digite direccion ") ;  
       document.getElementById("direccion").focus();
       return false
    }
    if(document.getElementById("observaciones").value == 0)
    {
       alert("Digite observaciones ") ;  
       document.getElementById("observaciones").focus();
       return false
    }
    return 1;
}
  
function validacionesCarro()
{
    if(document.getElementById("placa").value == '')
    {
       alert("Digite placa") ;  
       document.getElementById("placa").focus();
       return 0;
    }
    if(document.getElementById("selectPropietario").value == 0)
    {
       alert("Escoja o cree propietario ") ;  
       document.getElementById("selectPropietario").focus();
       return false
    }
    if(document.getElementById("marca").value == 0)
    {
       alert("Digite marca ") ;  
       document.getElementById("marca").focus();
       return false
    }
    if(document.getElementById("linea").value == 0)
    {
       alert("Digite linea ") ;  
       document.getElementById("linea").focus();
       return false
    }
    if(document.getElementById("modelo").value == 0)
    {
       alert("Digite modelo ") ;  
       document.getElementById("modelo").focus();
       return false
    }
    if(document.getElementById("color").value == 0)
    {
       alert("Digite color ") ;  
       document.getElementById("color").focus();
       return false
    }
    return 1;
}

function validarIdentidad(identi){
    // alert(identi);
    document.getElementById("infoVerificaciones").innerHTML = '';
    const http=new XMLHttpRequest();
    const url = 'index.php';
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status ==200){
            console.log(this.responseText);
            document.getElementById("infoVerificaciones").innerHTML = this.responseText;
        }
    };
    http.open("POST",url);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("opcion=validarIdenti"
            + "&identi="+identi
        );

}
$("#document").ready(function(){
	//FOMATO PARA EL RUT DIGITADO
    $("#rut").rut({
        formatOn: 'keyup',
        minimumLength: 8,
        validateOn: 'change'
    });

    //VALIDA QUE EL TELEFONO DIGITADO SOLO SEAN NUMEROS
    $("#telefono").keyup(function(){ 
        this.value = this.value.replace(/[^0-9]/g,'');
    });


	$("#guardar").click(function(){
		if($("#rut").val()==""){
			alert("Debe ingresar el RUT del cliente");
			$("#rut").focus();
		}else if($("#nombre").val()==""){
			alert("Debe ingresar el Nombre del cliente");
			$("#nombre").focus();
		}else if($("#ap").val()==""){
			alert("Debe ingresar el Apellido Paterno del cliente");
			$("#ap").focus();
		}else if($("#am").val()==""){
			alert("Debe ingresar el Apellido Materno del cliente");
			$("#am").focus();
		}else if($("#fechaNac").val()==""){
			alert("Debe ingresar la fecha de nacimiento del cliente");
			$("#fechaNac").focus();
		}else if($("#domicilio").val()==""){
			alert("Debe ingresar el domiclio del cliente");
			$("#domicilio").focus();
		}else if($("#telefono").val()==""){
			alert("Debe ingresar el telefono del cliente");
			$("#telefono").focus();
		}else{
            var rut         = $("#rut").val();
            var nombre      = $("#nombre").val();
            var aPaterno    = $("#ap").val();
            var aMaterno    = $("#am").val();
            var fechaNac    = $("#fechaNac").val();
            var domicilio   = $("#domicilio").val();
            var fono        = $("#telefono").val();
            var ejecutivo   = $("#ejecutivo").val();
            var sucursal    = $("#sucursal").val();
            
            var datos = 
                {
                    rut:rut,
                    nombre:nombre,
                    aPaterno:aPaterno,
                    aMaterno:aMaterno,
                    fechaNac:fechaNac,
                    domicilio:domicilio,
                    telefono:fono,
                    ejecutivo:ejecutivo,
                    sucursal:sucursal
                };
            
			$.ajax({
				method:'POST',
				url:'../controlador/php/ajax-controlador.php',
				data: datos,
				success:function(data){
					alert("Cliente registrado exitosamente");
					$("#cliente")[0].reset();
					var deseaOtroRegistro = confirm("Desea agregar otro cliente");
					if(deseaOtroRegistro==false){
						location.reload();
						$("#respuesta").html(data);	
					}else{
						$("#respuesta").html(data);
					}		
				}
			});
		}
	});

	$("#actualizar").click(function(){
		var rut 		= $("#actualizar").val();
		var nombre_a 	= $("#nombre_a").val();
		var ap_a 		= $("#ap_a").val();
		var am_a 		= $("#am_a").val();
		var fechaNac_a 	= $("#fechaNac_a").val();
		var domicilio_a = $("#domicilio_a").val();
		var telefono_a 	= $("#telefono_a").val();
		var ejecutivo_a = $("#ejecutivo_a").val();
		var sucursal_a 	= $("#sucursal_a").val();

		var datos =
			{
				rut:rut,
				nombre_a:nombre_a,
				ap_a:ap_a,
				am_a:am_a,
				fechaNac_a:fechaNac_a,
				domicilio_a:domicilio_a,
				telefono_a:telefono_a,
				ejecutivo_a:ejecutivo_a,
				sucursal_a:sucursal_a
			};

		$.ajax({
			method:'POST',
			url:'../controlador/php/ajax-controlador.php',
			data: datos,
			success:function(data){
				alert("Datos actualizados correctamente");
				location.close();
				//$("#resultado").html(data);
			}
		});

	});
		
});

function eliminar($valor){
	var elimina = confirm("Esta seguro que desea eliminar al cliente");
	if(elimina == true){
		var rutPersona = $valor;
		var datos={rutPersona:rutPersona};

		$.ajax({
			method:'POST',
			url:'../controlador/php/ajax-controlador.php',
			data: datos,
			success:function(data){
				alert("Cliente eliminado");
				location.reload();	
			}
		});
	}
	
}

function ventanaActualizar(valor){
	window.open("actualizar.php?rut="+valor,"Actualizar","menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes,width=500,height=500");
}


$("#document").ready(function(){
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
			alert("Cliente registrado exitosamente");
		}
	});
		
});
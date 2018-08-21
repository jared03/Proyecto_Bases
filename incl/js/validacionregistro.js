function validar_registro()
{
	var vpnombre = document.registro.pnombre;
	var vsnombre = document.registro.snombre;
	var vpapellido = document.registro.papellido;
	var vsapellido = document.registro.sapellido;
	var vcontraseña = document.registro.contraseña;
	var vcorreo = document.registro.correo;
	var vdireccion = document.registro.direccion;
	var vciudad = document.registro.ciudad;
	var vdepartamento = document.registro.departamento;
	var vpais = document.registro.pais;
	var vtelefono = document.registro.telefono;

	if(verificar_nombre(vpnombre,vsnombre,vpapellido,vsapellido))
	{
		if(verificar_contraseña(vcontraseña,6))
		{
			if(verificar_letras(vpnombre,vsnombre,vpapellido,vsapellido))
			{
				if(verificar_telefono(vtelefono))
				{ 
					if(verificar_departamento(vdepartamento))
					{
						if(verificar_pais(vpais))
						{
							if(verificar_correo(vcorreo))
							{
								if(verificar_direccion(vdireccion))
							} 
						}
					} 
				}
			}
		}
	}
	return false;
} 

function verificar_nombre(pnombre,snombre,papellido,sapellido)
{
	var vpnombre = pnombre.value.length;
	var vsnombre = snombre.value.lenght;
	var vpapellido = papellido.value.lenght;
	var vsapellido = sapellido.value.lenght;
	if (vpnombre == 0)
	{
		alert("Ingrese su primer nombre");
		pnombre.focus();
		return false;
	}
	else if (vsnombre == 0)
	{
		alert("Ingrese su segundo nombre");
		snombre.focus();
		return false;
	}
	else if (vpapellido == 0)
	{
		alert("Ingrese su primer apellido");
		papellido.focus();
		return false;
	}
	else if (vsapellido == 0)
	{
		alert("Ingrese su segundo apellido");
		sapellido.focus();
		return false;
	}
	return true;
}

function verificar_contraseña(contraseña,mx)
{
	var passid_len = contraseña.value.length;
	if (passid_len == 0 || passid_len < mx)
	{
		alert("Porfavor verifique su contraseña: Minimo 6 caracteres");
		contraseña.focus();
		return false;
	}
	return true;
}

function verificar_letras(pnombre,snombre,papellido,sapellido)
{ 
	var letras = /^[A-Za-z]+$/;
	if(pnombre.value.match(letras) && snombre.value.match(letras) && papellido.value.match(letras) && sapellido.value.match(letras))
	{
		return true;
	}
	else
	{
		alert('Nombres y apellidos solo deben contener letras');
		pnombre.focus();
		return false;
	}
}

function verificar_telefono(telefono)
{ 
	var letters = /^[0-9]+$/;
	if(telefono.value.match(letters))
	{
		return true;
	}
	else
	{
		alert('Solo numeros aceptados para telefono');
		telefono.focus();
		return false;
	}
}

function verificar_departamento(departamento)
{
	if(departamento.value == "")
	{
		alert('Selecciona tu departamento de la lista');
		departamento.focus();
		return false;
	}
	else
	{
	return true;
	}
}

function verificar_pais(pais)
{
	if(pais.value == "")
	{
		alert('Selecciona tu Pais de la lista');
		pais.focus();
		return false;
	}
	else
	{
	return true;
	}
}


function verificar_correo(correo)
{
	var formato = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(correo.value.match(formato))
	{
		return true;
	}
	else
	{
		alert("El correo electronico no es valido, Porfavor verifica tu correo");
		correo.focus();
		return false;
	}
} 

function verificar_direccion(direccion)
{
	var vdireccion = direccion.value.length;
	if (vdireccion == 0)
	{
		alert("Ingrese su direccion");
		direccion.focus();
		return false;
	}
	return true;
}
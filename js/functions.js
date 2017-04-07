$(document).ready(function(){
	$('a[href="#empresa_ubicaciones"]').on('shown.bs.tab', function (e) {
	  //e.target // newly activated tab
	  //e.relatedTarget // previous active tab
		$('#mapa-ubicaciones').css("visibility","visible");
		el = $('#listado_ubicaciones').find('button.list-group-item.active');
		$('#us2-telefono').val($(el).attr("data-tel"));
		$('#us2-nombre').val($(el).attr("data-nom"));
		$('#mapa-ubicaciones').locationpicker("location", {latitude: $(el).attr("data-lat"), longitude: $(el).attr("data-lon")});
		$('#mapa-ubicaciones').locationpicker("autosize");
	});

	$('a[href="#empresa_ubicaciones"]').on('hide.bs.tab', function (e) {
	  //e.target // newly activated tab
	  //e.relatedTarget // previous active tab
		$('#mapa-ubicaciones').css("visibility","hidden");
	})
});

//Actualiza el mapa de las ubicaciones de la empresa con los datos que tiene el boton sobre la latitud y longitud de la ubicación
function actualizarMapa(el){
	$('#mapa-ubicaciones').locationpicker("location", {latitude: $(el).attr("data-lat"), longitude: $(el).attr("data-lon")});
	$('#us2-telefono').val($(el).attr("data-tel"));
	$('#us2-nombre').val($(el).attr("data-nom"));
	$(el).parent().find('button.list-group-item.active').removeClass('active');
	$(el).addClass('active');
}

function actualizarDatosEmpresa(){
	swal({
	  title: "Esta seguro que desea actualizar los datos de la empresa?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Si!",
	  cancelButtonText: "No!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
	    swal("Actualizado!", "Los datos de la empresa se han actualizado exitosamente.", "success");
	  } else {
	    swal("Cancelado", "Los datos de la empresa no fueron actualizados.", "error");
	  }
	});
}

function actualizarUbicacion(){
	swal({
	  title: "Esta seguro que desea actualizar la ubicación?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Si!",
	  cancelButtonText: "No!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
	    swal("Actualizado!", "Los datos de la ubicación se han actualizado exitosamente.", "success");
	  } else {
	    swal("Cancelado", "Los datos de la ubicación no fueron actualizados.", "error");
	  }
	});
}

function eliminarUbicacion(){
	swal({
	  title: "Esta seguro que desea eliminar la ubicación?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Si!",
	  cancelButtonText: "No!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm){
	  if (isConfirm) {
	  	$( "#listado_ubicaciones button.active").remove();
	  	$( "#listado_ubicaciones button:first-child" ).click();
	    swal("Eliminado!", "La ubicación se ha eliminado exitosamente.", "success");
	  } else {
	    swal("Cancelado", "La ubicación no se ha eliminado.", "error");
	  }
	});
}

function registrarUbicacion(el){
	$(el).parent().find('button.list-group-item.active').removeClass('active');
	btnNuevo = $( "#listado_ubicaciones button:first-child" ).clone();
	btnNuevo.attr('data-tel','');
	btnNuevo.attr('data-nom','Nueva Ubicación');
	btnNuevo.addClass('active');
	btnNuevo.html('<span class="badge"><span class="glyphicon glyphicon-chevron-right"></span></span>Nueva Ubicación');
	btnNuevo.insertBefore("#listado_ubicaciones button:last-child");
	btnNuevo.click();
	swal("Ubicación Agregada", 'Por favor modifique los detalles de la ubicación y presione el botón "Actualizar Ubicación"');
}
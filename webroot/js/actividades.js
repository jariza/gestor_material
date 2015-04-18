function horarioInicioSesion(id) {
	var meses = {Jan: 1, Ene: 1, Feb: 2, Mar: 3, Apr: 4, Abr: 4, May: 5, Jun: 6, Jul: 7, Aug: 8, Ago: 8, Sep: 9, Oct: 10, Nov: 11, Dec: 12, Dic: 12};
	var horas = [];
	$('#tablahorarios input[readonly="readonly"]').each(function() {
		if ((this.value == id) || (id == 0)) {
			elem = '#'+this.id.substr(0,this.id.length-6);
			console.log(elem);
			horas.push(Math.floor(new Date($(elem+'InicioYear').val(), $(elem+'InicioMonth').val(), $(elem+'InicioDay').val(), $(elem+'InicioHour').val(), $(elem+'InicioMin').val(), 0, 0).getTime()/1000));
			if (id != 0) {return false;}
		}
	})

	if (horas.length == 0) {
		$('#tablahorarios tr').each(function() {
			if ((this.id.length > 0) && (($('#'+this.id+' td:eq(1)').text() == id) || (id == 0))) {
				console.log(this.id);
				horas.push(Math.floor(new Date($('#'+this.id+' td:eq(2)').text())/1000));
				if (id != 0) {return false;}
			}
		})
	}
	
	return horas.join(',');
}

function horarioFinSesion(id) {
	var meses = {Jan: 1, Ene: 1, Feb: 2, Mar: 3, Apr: 4, Abr: 4, May: 5, Jun: 6, Jul: 7, Aug: 8, Ago: 8, Sep: 9, Oct: 10, Nov: 11, Dec: 12, Dic: 12};
	var horas = [];
	$('#tablahorarios input[readonly="readonly"]').each(function() {
		if ((this.value == id) || (id == 0)) {
			elem = '#'+this.id.substr(0,this.id.length-6);
			horas.push(Math.floor(new Date($(elem+'FinYear').val(), $(elem+'FinMonth').val(), $(elem+'FinDay').val(), $(elem+'FinHour').val(), $(elem+'FinMin').val(), 0, 0).getTime()/1000));
			if (id != 0) {return false;}
		}
	})
	
	if (horas.length == 0) {
		$('#tablahorarios tr').each(function() {
			if ((this.id.length > 0) && (($('#'+this.id+' td:eq(1)').text() == id) || (id == 0))) {
				horas.push(Math.floor(new Date($('#'+this.id+' td:eq(3)').text())/1000));
				if (id != 0) {return false;}
			}
		})
	}
	
	return horas.join(',');
}

function numSesion() {
	console.log("OLA2222");
	var horario = []; //El índice es el id del elemento en form
	var sesion = 1;
	for (i = 0; i <= lastHorario; i++) {
		datetime = $('#Horario'+i+'InicioYear').val() + $('#Horario'+i+'InicioMonth').val() + $('#Horario'+i+'InicioDay').val() + $('#Horario'+i+'InicioHour').val() + $('#Horario'+i+'InicioMin').val();
		horario[i] = {id:i, hora:datetime}
	}
	horario.sort(function(a,b) {
		return a.hora > b.hora ? 1 : a.hora < b.hora ? -1 : 0;
	});
	for (var v of horario) {
		$('#Horario'+v.id+'Sesion').val(sesion);
		sesion++;
	}
}

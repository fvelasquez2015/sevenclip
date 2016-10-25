window.onload = function() {
		calendario();
	}
//----------- Funciones Generales ----------------------//

function Color(x, a) {
    x.style.backgroundColor="#ABB7B7";
    a.style.color="white";
    a.style.fontWeight="normal";
}

function deColor(x,a){
    x.style.backgroundColor="white";
    a.style.color="black";
    a.style.fontWeight="bold";
}

function opciones() {
    document.getElementById("opc").style.height = "150px";
}
function quitaropciones() {
    document.getElementById("opc").style.height = "0px";
}
//--------------------------------------------------------//

//----------- Funciones de CALENDARIO ----------------------//
function calendario(){
	miFecha = new Date();
	var nombreDia = ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'];
	var nodoDia = document.getElementsByClassName('dia');
	var nodoNombre = document.getElementsByClassName('nDia');
	var diaSemana = getDiaDeInicio(miFecha);
	var diasEnMes = getDiasPorMes(miFecha.getMonth(), miFecha.getFullYear());
	rellenaMesYAnno(miFecha);
	rellenaTabla(nodoDia, nodoNombre, diasEnMes, diaSemana, nombreDia);
				
	}
function rellenaMesYAnno(miFecha){
	document.getElementById('mesYAnno').innerHTML = getMes(miFecha.getMonth()) + ' ' +  miFecha.getFullYear();
	}
function rellenaTabla(nodoDia, nodoNombre, diasEnMes, diaSemana, nombreDia){
	var dia = 0;
	for(var i = 0; i < nodoNombre.length; i++){
		nodoNombre[i].innerHTML = nombreDia[i];
		}
	for(var i = 0; i < nodoDia.length; i++){
		if(i < (diaSemana+diasEnMes)){	
			if(i<diaSemana){
				nodoDia[i].innerHTML = ' ';
			}
			else{
				dia = i - diaSemana+1;
				nodoDia[i].innerHTML = dia;
				if(dia == getDiaActual()){ 
					nodoDia[i].style.backgroundColor="#FA5858"; 
				}
				
			}
		}
	}
}
function getDiaDeInicio(fecha){
	var diaSemana = fecha.getDay();
	for(var i = fecha.getDate(); i>0; i--){
		if(diaSemana == 0){
			diaSemana = 7;
		}
		diaSemana--;
	}
	if(diaSemana==0){diaSemana=7;}
		return diaSemana
}

function getDiaActual(){
	var miFecha = new Date();
	var dia = miFecha.getDate();
	return parseInt(dia);
}

function getMes(mes){
	switch(mes) {
		case 0:
			return 'Enero';
			break;
		case 1:
			return 'Febrero';
			break;
		case 2:
			return 'Marzo';
			break;
		case 3:
			return 'Abril';
			break;
		case 4:
			return 'Mayo';
			break;
		case 5:
			return 'Junio';
			break;
		case 6:
			return 'Julio';
			break;
		case 7:
			return 'Agosto';
			break;
		case 8:
			return 'Septiembre';
			break;
		case 9:
			return 'Octubre';
			break;
		case 10:
			return 'Noviembre';
			break;
		case 11:
			return 'Diciembre';
			break;
		default:
			break;
	}
}
function getDiasPorMes(mes, anno){
	switch(mes){
		case 0:
		case 2:
		case 4:
		case 6:
		case 7:
		case 9:
		case 11:
			return 31;
			break;
		case 3:
		case 5:
		case 8:
		case 10:
			return 30;
			break;
		case 1:
			if (((anno%100 == 0) && (anno%400 == 0)) || ((anno%100 != 0) && (anno%4 == 0))){
				return 29; 
			}else{
				return 28;
			}
			break;
		default:
			break;
	}
}



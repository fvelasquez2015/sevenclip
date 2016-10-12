


//----------- Funciones Generales ----------------------//

function Color(x, a) {
    x.style.backgroundColor="#27ae60";
    a.style.color="black";
}

function deColor(x,a){
    x.style.backgroundColor="#3A539B";
    a.style.color="white";
    a.style.fontWeight="normal";
}

function opciones() {
    document.getElementById("opc").style.height = "150px";
}
function quitaropciones() {
    document.getElementById("opc").style.height = "0px";
}


//----------------------- Funciones Especificando HTML/php -------------//

//---------- Funciones Sesion.html ------------//

function Validar(miForm){
    var passw = document.getElementById('pass').value;
    var pl = passw.length;
    if(pl<1){
      alert("Debe ingresar una contraseña");
      miForm.pass.focus();
      return false;
    }
    return true;
}

//---------- Funciones Reg.html ------------//

function validarReg(miForm){
    if(miForm.name.value =="") {
      alert("Debe ingresar un Nombre");
      miForm.name.focus();
      return false;
    }
    if(miForm.lname.value =="") {
      alert("Debe ingresar un Apellido");
      miForm.lname.focus();
      return false;
    }
    var rut = document.getElementById('rut').value;
    var l = rut.length;
    if(l<8 || l>9){
      alert("Debe ingresar un rut valido");
      miForm.rut.focus();
      return false
    }
    var passw = document.getElementById('pass').value;
    var pl = passw.length;
    if(pl<1){
      alert("Debe ingresar una contraseña");
      miForm.pass.focus();
      return false
    }
    return true;
}

//-------------------------------------------//



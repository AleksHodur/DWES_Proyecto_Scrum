let xmlhttp = new XMLHttpRequest;
let tabla = document.getElementById('tablaAlumnos');

xmlhttp.onreadystatechange = function (){

    if(this.readyState == 4 && this.status == 200){

        console.dir(this.responseText);
        let tabla = document.getElementById('tablaAlumnos');

        let alumnos = JSON.parse(this.responseText);
        console.dir(alumnos);

        for(let i = 0; i < alumnos.length; i++){
            let fila = document.createElement('tr');
            let alumno = alumnos[i];
            
            for(let atributo in alumno){
                console.log("Atributo:");
                console.dir(alumno[atributo]);
                let columna = document.createElement('td');
                //columna.style.border = 'solid 1px black';
                columna.textContent = alumno[atributo];
                fila.appendChild(columna);
            }

            let opciones = document.createElement('td');
            let lista = document.createElement('ul');
            let boton1 = document.createElement('li');
            let boton2 = document.createElement('li');

            boton1.innerHTML = '<button>Actualizar</button>';
            boton2.innerHTML = '<button>Eliminar</button>';

            lista.append(boton1, boton2);
            opciones.appendChild(lista);
            fila.appendChild(opciones);

            tabla.appendChild(fila);
        }
    }
};

xmlhttp.open('GET', '../../controlador/listaAlumnos.php', true);
xmlhttp.send();
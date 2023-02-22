let xmlhttp = new XMLHttpRequest;
let tabla = document.getElementById('tablaAlumnos');

xmlhttp.onreadystatechange = function (){

    if(this.readyState == 4 && this.status == 200){

        let alumnos = JSON.parse(this.responseText);

        for(let i = 0; i < alumnos.length; i++){
            let fila = document.createElement('tr');
            
            for(let atributo in alumnos[i]){
                let columna = document.createElement('td');
                columna.textContent = atributo;
                fila.appendChild(columna);
            }

            document.body.appendChild(fila);
        }
    }
};

xmlhttp.open('GET', '../panel_profesor.php', true);
xmlhttp.send();
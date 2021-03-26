window.onload = function () {
    if (document.getElementById("paginacion")) {
//        console.log("existe");

//    let pathname = window.location.pathname;
//    console.log(pathname);
        let a = document.getElementsByClassName("page-link");
//        console.log(a[2]);
        for (let i = 0; i < a.length; i++) {
            let etiqueta = a[i];
            //console.log(etiqueta);
            if (etiqueta != "javascript:void(0)") {
                //obtengo el texto de la etiqueta
                let texto = etiqueta.innerHTML;
                //console.log("texto: " + texto);
                //obtengo el href de la etiqueta

                let href = etiqueta.getAttribute("href");
                //console.log("href: " + href);
                //compruebo si está mal la url
                let error = href.includes("controller=");
                //console.log("error: " + error);
                if (error) {
                    let error2 = href.includes("page");
                    //console.log("error2: " + error2);
                    if (error2) {
                        let error = href.includes("controller=");
                        if (error) {
                            //console.log("if");
                            //separo por ?
                            let arrayDeCadenas = href.split("?");
                            //console.log(arrayDeCadenas);
                            //
                            //Obtengo la id
                            let arrayDeCadenasId = arrayDeCadenas[0].split("&");
                            //console.log(arrayDeCadenasId);

                            let arrayDeCadenasId1 = arrayDeCadenasId[0].split("/");
                            //console.log(arrayDeCadenasId1[3]);

                            let id = arrayDeCadenasId1[3] + "&" + arrayDeCadenasId[1] + "&page=";
                            //console.log("id: " + id);

                            if (texto == 1 || texto == "«" && a.length < 5) {
                                //console.log("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%" + a.length);
                                id = id.split("&");
                                //console.log(id);
                                let enlaceFinal = id[0] + "&" + id[1];
                                etiqueta.setAttribute("href", enlaceFinal);
                                //console.log(enlaceFinal);


                            } else {
                                //Obtengo la página

                                let arrayDeCadenasPage = arrayDeCadenas[1].split("=");
                                //console.log("PAG");
                                //console.log(arrayDeCadenasPage);
                                let page = arrayDeCadenasPage[arrayDeCadenasPage.length - 1];

                                //Formo el enlace final
                                let enlaceFinal = id + page;
                                etiqueta.setAttribute("href", enlaceFinal);
                                //console.log(enlaceFinal);

                            }

                        } else {

                        }
                    } else {


                        //separo por ?
                        let arrayDeCadenas = href.split("?");
                        //console.log(arrayDeCadenas);
                        //Separo la cadena donde está la id
                        let arrayDeCadenasId = arrayDeCadenas[0].split("/");
                        //console.log(arrayDeCadenasId);
                        let id = arrayDeCadenasId[3];
                        //console.log("id: "+id);

                        //Separo la cadena donde está la pagina
                        let arrayDeCadenasPage = arrayDeCadenas[1].split("=");
                        //console.log(arrayDeCadenasPage);
                        //console.log("pagina: "+arrayDeCadenasPage);
                        let page = arrayDeCadenasPage[arrayDeCadenasPage.length - 1];
                        //console.log(page);

                        //Creo el enlace final
                        let enlaceFinal = id + "&page=" + page;
                        etiqueta.setAttribute("href", enlaceFinal);
                        //console.log(enlaceFinal);
                    }

                }
            }
            //console.log("###################################");
        }
    }
}

function duplicateDiv() {
    let valorNow = document.getElementById("numCampos").value;;
    let valor = parseInt(valorNow) + 1;
    let campos = document.getElementById("campos");

    if (!document.getElementById("campo1").getAttribute("required")) {
        document.getElementById("campo1").setAttribute("required", "required");
        document.getElementById("camposelect1").setAttribute("required", "required");
    }

    //LABEL
    let label = document.getElementById("label" + valorNow);
    //Duplico
    let copia = label.cloneNode(true);
    //Cambio los valores
    copia.setAttribute("id", "label" + valor);
    copia.setAttribute("name", "label" + valor);
    campos.appendChild(copia);
    //Obtengo el texto viejo
    let textoViejo = document.getElementById("label" + valor).firstChild;
    //Creo el texto nuevo
    let textoNuevo = document.createTextNode("Campo " + valor);
    //Reemplazo los texto
    copia.replaceChild(textoNuevo, textoViejo);

    //INPUT
    let input = document.getElementById("campo" + valorNow);
    //Duplico
    let copia2 = input.cloneNode(true);
    //Cambio los valores
    copia2.setAttribute("id", "campo" + valor);
    copia2.setAttribute("name", "campo" + valor);
    copia2.setAttribute("required", "required");
    copia2.value="";
    campos.appendChild(copia2);

    //SELECT
    let select = document.getElementById("camposelect" + valorNow);
    //Duplico
    let copia3 = select.cloneNode(true);
    //Cambio los valores
    copia3.setAttribute("id", "camposelect" + valor);
    copia3.setAttribute("name", "camposelect" + valor);
    copia2.setAttribute("required", "required");
    campos.appendChild(copia3);

    //INPUT HIDDEN
    let numCampos = document.getElementById("numCampos").value = valor;

    //Actualizo el número de campos en el onclick del botón +
    let btn_add = document.getElementById("btn-add");
    btn_add.removeAttribute("onclick");
    btn_add.setAttribute("onclick", "duplicateDiv('" + valor + "')");
}

function limpiarDiv() {
    let campos = document.getElementById("campos");
    let numCampos = document.getElementById("numCampos").value;
    while (numCampos > 1) {
        if (document.getElementById("label" + numCampos)) {
            let label = document.getElementById("label" + numCampos);
            campos.removeChild(label);
        }
        if (document.getElementById("campo" + numCampos)) {
            let campo = document.getElementById("campo" + numCampos);
            campos.removeChild(campo);
        }
        if (document.getElementById("camposelect" + numCampos)) {
            let camposelect = document.getElementById("camposelect" + numCampos);
            campos.removeChild(camposelect);
        }
        numCampos--;
    }
    if(document.getElementById("subcategoria_no").checked){
        let InputNumCampos = document.getElementById("numCampos").value = 0;
    }else{
        let InputNumCampos = document.getElementById("numCampos").value = 1;
    }
    

}

function eliminarCampoDiv() {
    let campos = document.getElementById("campos");
    let numCampos = document.getElementById("numCampos").value;

    if (numCampos > 1) {
        let label = document.getElementById("label" + numCampos);
        campos.removeChild(label);

        let campo = document.getElementById("campo" + numCampos);
        campos.removeChild(campo);

        let camposelect = document.getElementById("camposelect" + numCampos);
        campos.removeChild(camposelect);

        let InputNumCampos = document.getElementById("numCampos").value = numCampos - 1;
    }

}

function mostrar(div) {
    let etiqueta = document.getElementById(div);
    etiqueta.removeAttribute("class");
    etiqueta.setAttribute("class", "mostrar");
    
    if(div == "infoSubcategoria"){
        console.log("hola mostrar");
        let InputNumCampos = document.getElementById("numCampos").value = 1;
        
        let campo1 = document.getElementById("campo1");
        campo1.setAttribute("required", "required");
        let camposelect1 = document.getElementById("camposelect1");
        camposelect1.setAttribute("required", "required");
    }
}

function ocultar(div) {
    let etiqueta = document.getElementById(div);
    etiqueta.removeAttribute("class");
    etiqueta.setAttribute("class", "ocultar");
    
    if(div == "infoSubcategoria"){
        console.log("hola ocultar");
        let InputNumCampos = document.getElementById("numCampos").value = 0;
        
        let campo1 = document.getElementById("campo1");
        campo1.removeAttribute("required");
        let camposelect1 = document.getElementById("camposelect1");
        camposelect1.removeAttribute("required");
        limpiarDiv();
    }
}

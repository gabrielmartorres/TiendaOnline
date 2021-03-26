<h1>Crear nueva categoría</h1>

<form action="<?= base_url ?>categoria/save" method="POST">
    <label for="nombre">Nombre <em>(En plural)</em></label>
    <input type="text" name="nombre" required/>
    <label for="subcategoria">¿La categoría contiene subcategorías?</label>
    <label for="no"><input type="radio" id="subcategoria_no" name="subcategoria" value="false" checked onclick="ocultar('infoSubcategoria')"> No</label>
    <label for="si"><input type="radio" id="subcategoria_si" name="subcategoria" value="true" onclick="mostrar('infoSubcategoria')"> Si</label>

    <div id="infoSubcategoria" class="ocultar">
        <br>
        <p>Agrega solo los campos que caracterizan un producto de esta categoría:</p>
        <br>
        <p>Notas importantes:</p>
        <ul>
            <li><small>No agregues nombre, descripcion, precio, stock, oferta, fecha e imagen</small></li>
            <li><small>No introduzcas acentos, ñ, catacteres especiales, mayúsculas, ni espacios en blanco</small></li>            
        </ul>        
        <br>
        <div id="campos">
            <label id="label1" for="campo1">Campo 1</label>
            <input type="text" id="campo1" name="campo1"/>
            <select id="camposelect1" name="camposelect1">
                <option value="INT">número entero</option>
                <option value="VARCHAR">texto</option>
                <option value="FLOAT">número decimal</option>
            </select>            
        </div>
        <div class="boton-operaciones">
            <input type="hidden" id="numCampos" name="numCampos" value="0"/>
            <a id="btn-add" class="button" onclick="duplicateDiv('1')" title="Añadir campos">+</a>
            <a id="btn-add" class="button" onclick="eliminarCampoDiv()" title="Eliminar el último campo">-</a>
            <a id="btn-add" class="button" onclick="limpiarDiv()" title="Eliminar todos los campos">x</a>
        </div>

    </div>

    <div class="boton-operaciones2">
        <input type="submit" value="Guardar" />   
    </div>
</form>


<form class="formulario-base" method="READ" action="{{ route('compras.show', $compra->id) }}">

    @method('PUT')

```
<!-- Proveedor -->
<div class="form-grupo">
    <label for="id_proveedor" class="form-label">Proveedor</label>
    <select id="id_proveedor" name="id_proveedor" class="form-input">
        <?php foreach($proveedores as $prov): ?>
            <option value="<?= $prov->id ?>" <?= $compra->id_proveedor == $prov->id ? 'selected' : '' ?>>
                <?= $prov->nombre ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<!-- Fecha -->
<div class="form-grupo">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" id="fecha" name="fecha" class="form-input"
           value="<?= $compra->fecha ?>">
</div>

<!-- Productos -->
<div class="form-grupo">
    <label class="form-label">Productos</label>
    <?php foreach($detalles as $index => $det): ?>
        <div class="detalle-producto" style="margin-bottom:10px; border:1px solid #ccc; padding:5px;">
            <select name="productos[<?= $index ?>][id]" class="form-input">
                <?php foreach($productosTabla as $prod): ?>
                    <option value="<?= $prod->id ?>" <?= $det->id_producto == $prod->id ? 'selected' : '' ?>>
                        <?= $prod->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <input type="number" name="productos[<?= $index ?>][cantidad]" class="form-input"
                   value="<?= $det->cantidad ?>" min="1" step="1" placeholder="Cantidad">

            <input type="number" name="productos[<?= $index ?>][precio]" class="form-input"
                   value="<?= $det->precio_unitario ?>" min="0" step="0.01" placeholder="Precio Unitario">

            <input type="datetime-local" name="productos[<?= $index ?>][timestamp]" class="form-input"
                   value="<?= date('Y-m-d\TH:i', strtotime($det->timestamp)) ?>">
        </div>
    <?php endforeach; ?>
</div>

<!-- Observaciones -->
<div class="form-grupo">
    <label for="observaciones" class="form-label">Observaciones</label>
    <textarea id="observaciones" name="observaciones" class="form-input"><?= $compra->observaciones ?></textarea>
</div>

<!-- Botón Guardar -->
<div class="centrar-div">
    <button type="submit" class="boton centrar-elemento">
        <span class="icono send"></span> Guardar cambios
    </button>
</div>
```

</form>


</form>

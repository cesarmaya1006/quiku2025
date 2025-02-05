<div class="col-12 col-md-6 form-group">
    <label for="categoria_id">Categoría</label>
    <select class="form-control form-control-sm" id="categoria_id" data_url="{{route('cargar_productos',['id'=>1])}}">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ isset($marca) ? ($categoria->id == $marca->producto->categoria_id ? 'selected' : '') : '' }}>
                {{ $categoria->categoria }}</option>
        @endforeach
    </select>
    <small id="helpId" class="form-text text-muted">Producto</small>
</div>
<div class="col-12 col-md-6 form-group">
    <label class="requerido" for="producto_id">Producto</label>
    <select class="form-control form-control-sm" name="producto_id" id="producto_id" required>
        @if (isset($marca))
        @foreach ($productos as $producto)
            <option value="{{ $producto->id }}" {{ isset($marca) ? ($producto->id == $marca->producto_id ? 'selected' : '') : '' }}>
                {{ $producto->producto }}</option>
        @endforeach
        @else
            @foreach ($categorias[0]->productos as $producto)
            <option value="{{ $producto->id }}">
                {{ $producto->producto }}</option>
            @endforeach
        @endif
    </select>
    <small id="helpId" class="form-text text-muted">Producto</small>
</div>
<div class="col-12 col-md-6 form-group">
    <label class="requerido" for="marca">Marca</label>
    <input type="text" class="form-control form-control-sm" name="marca" id="marca" aria-describedby="helpId"
        value="{{ old('marca', $marca->marca ?? '') }}" placeholder="Nombre de la Marca" required>
    <small id="helpId" class="form-text text-muted">Marca</small>
</div>

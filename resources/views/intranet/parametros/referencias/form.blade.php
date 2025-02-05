<div class="col-12 col-md-6 form-group">
    <label for="categoria_id">Categoría</label>
    <select class="form-control form-control-sm" id="categoria_id" data_url="{{route('cargar_productos',['id'=>1])}}">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}" {{ isset($referencia) ? ($categoria->id == $referencia->marca->producto->categoria_id ? 'selected' : '') : '' }}>
                {{ $categoria->categoria }}</option>
        @endforeach
    </select>
    <small id="helpId" class="form-text text-muted">Producto</small>
</div>

<div class="col-12 col-md-6 form-group">
    <label class="requerido" for="producto_id">Producto</label>
    <select class="form-control form-control-sm" id="producto_id">
        @if (isset($referencia))
        @foreach ($productos as $producto)
            <option value="{{ $producto->id }}" {{ isset($referencia) ? ($producto->id == $referencia->marca->producto_id ? 'selected' : '') : '' }}>
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
    <label class="requerido" for="marca_id">Marca</label>
    <select class="form-control form-control-sm" name="marca_id" id="marca_id" required>
        @if (isset($referencia))
        @foreach ($productos as $producto)
            <option value="{{ $producto->id }}" {{ isset($referencia) ? ($producto->id == $referencia->marca->producto_id ? 'selected' : '') : '' }}>
                {{ $producto->producto }}</option>
        @endforeach
        @else
            @foreach ($categorias[0]->productos[0]->marcas as $marca)
            <option value="{{ $marca->id }}">
                {{ $marca->marca }}</option>
            @endforeach
        @endif
    </select>
    <small id="helpId" class="form-text text-muted">Marca</small>
</div>

<div class="col-12 col-md-6 form-group">
    <label class="requerido" for="referencia">Referéncia</label>
    <input type="text" class="form-control form-control-sm" name="referencia" id="referencia" aria-describedby="helpId"
        value="{{ old('referencia', $referencia->referencia ?? '') }}" placeholder="Nombre de la Referéncia" required>
    <small id="helpId" class="form-text text-muted">Referéncia</small>
</div>

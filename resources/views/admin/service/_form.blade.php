{{-- Author: Emily Cardona Castañeda  --}}


<div class="row g-3">

    <div class="col-md-12">
        <label for="name" class="form-label">Nombre del servicio</label>
        <input type="text" id="name" name="name" class="form-control"
               placeholder="Ej: Mantenimiento de jardín"
               value="{{ old('name', $service?->getName()) }}">
    </div>

    <div class="col-md-6">
        <label for="price" class="form-label">Precio (COP)</label>
        <input type="number" id="price" name="price" class="form-control" min="0"
               placeholder="180000"
               value="{{ old('price', $service?->getPrice()) }}">
    </div>

    <div class="col-md-6">
        <label for="duration" class="form-label">Duración estimada</label>
        <input type="text" id="duration" name="duration" class="form-control"
               placeholder="Ej: 2–4 horas"
               value="{{ old('duration', $service?->getDuration()) }}">
    </div>

    <div class="col-md-12">
        <label for="employee" class="form-label">Empleado asignado</label>
        <input type="text" id="employee" name="employee" class="form-control"
               placeholder="Nombre del jardinero asignado"
               value="{{ old('employee', $service?->getEmployee()) }}">
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Descripción</label>
        <textarea id="description" name="description" class="form-control" rows="3"
                  placeholder="Describe el servicio..."
        >{{ old('description', $service?->getDescription()) }}</textarea>
    </div>

    <div class="col-12">
        <label for="features_text" class="form-label">Características incluidas</label>
        <textarea id="features_text" name="features_text" class="form-control" rows="5"
                  placeholder="Poda y corte de césped&#10;Fertilización&#10;Control de plagas"
        >{{ old('features_text', $service ? implode("\n", $service->getFeatures()) : '') }}</textarea>
        <small class="text-muted" style="font-size:.78rem;">Una característica por línea.</small>
    </div>

    <div class="col-12">
        <label for="image" class="form-label">Nombre del archivo de imagen</label>
        <input type="text" id="image" name="image" class="form-control"
               placeholder="mantenimiento-jardin.jpg"
               value="{{ old('image', $service?->getImage()) }}">
        <small class="text-muted" style="font-size:.78rem;">
            Sube la imagen a <code>public/images/services/</code> y escribe el nombre aquí.
        </small>
    </div>

    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" id="active" name="active" value="1"
                   class="form-check-input"
                   {{ old('active', $service?->getActive() ?? true) ? 'checked' : '' }}>
            <label for="active" class="form-check-label">Servicio activo (visible en la tienda)</label>
        </div>
    </div>

    <div class="col-12 d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-success px-4" style="border-radius:8px;">
            {{ $submitText }}
        </button>
        <a href="{{ route('admin.service.index') }}" class="btn btn-outline-secondary" style="border-radius:8px;">
            Volver al listado
        </a>
    </div>

</div>
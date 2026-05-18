{{-- Author: Emily Cardona Castañeda --}}

@php
    $plant              = $viewData['plant'] ?? null;
    $categories         = $viewData['categories'] ?? collect();
    $selectedCategoryId = old('category_id', $plant ? $plant->getCategoryId() : '');
    $isActive           = old('active', $plant ? $plant->getActive() : true);
@endphp

<div class="row g-3">

    {{-- Nombre --}}
    <div class="col-12">
        <label for="name" class="form-label">{{ __('plant.form_name') }}</label>
        <input type="text" id="name" name="name" class="form-control"
               placeholder="{{ __('plant.form_name_placeholder') }}"
               value="{{ old('name', $plant?->getName()) }}">
    </div>

    {{-- Description --}}
    <div class="col-12">
        <label for="description" class="form-label">{{ __('plant.form_description') }}</label>
        <textarea id="description" name="description" class="form-control" rows="3"
                  placeholder="{{ __('plant.form_description_placeholder') }}"
        >{{ old('description', $plant?->getDescription()) }}</textarea>
    </div>

    {{-- Price and Stock --}}
    <div class="col-md-6">
        <label for="price" class="form-label">{{ __('plant.form_price') }}</label>
        <input type="number" id="price" name="price" class="form-control" min="0"
               placeholder="25000"
               value="{{ old('price', $plant?->getPrice()) }}">
    </div>
    <div class="col-md-6">
        <label for="stock" class="form-label">{{ __('plant.form_stock') }}</label>
        <input type="number" id="stock" name="stock" class="form-control" min="0"
               value="{{ old('stock', $plant?->getStock() ?? 0) }}">
    </div>

    {{-- Category --}}
    <div class="col-md-6">
        <label for="category_id" class="form-label">{{ __('plant.form_category') }}</label>
        <select id="category_id" name="category_id" class="form-select">
            <option value="">{{ __('plant.form_category_placeholder') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->getId() }}"
                    {{ (string) $selectedCategoryId === (string) $category->getId() ? 'selected' : '' }}>
                    {{ $category->getName() }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Variety / Color --}}
    <div class="col-md-6">
        <label for="color" class="form-label">{{ __('plant.form_color') }}</label>
        <input type="text" id="color" name="color" class="form-control"
               placeholder="{{ __('plant.form_color_placeholder') }}"
               value="{{ old('color', $plant?->getColor()) }}">
    </div>

    {{-- Size / Presentation --}}
    <div class="col-md-6">
        <label for="size" class="form-label">{{ __('plant.form_size') }}</label>
        <input type="text" id="size" name="size" class="form-control"
               placeholder="{{ __('plant.form_size_placeholder') }}"
               value="{{ old('size', $plant?->getSize()) }}">
    </div>

    {{-- Imagen --}}
    <div class="col-12">
        <label for="image" class="form-label">{{ __('plant.form_image') }}</label>
        <input type="text" id="image" name="image" class="form-control"
               placeholder="{{ __('plant.form_image_placeholder') }}"
               value="{{ old('image', $plant?->getImage()) }}">
        <small class="text-muted" style="font-size:.78rem; margin-top:.3rem; display:block;">
        </small>
    </div>

    {{-- Activo --}}
    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" id="active" name="active" value="1"
                   class="form-check-input" {{ $isActive ? 'checked' : '' }}>
            <label for="active" class="form-check-label">{{ __('plant.form_active') }}</label>
        </div>
    </div>

    {{-- Botones --}}
    <div class="col-12 d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-success px-4" style="border-radius:8px;">
            {{ $submitText }}
        </button>
        <a href="{{ route('admin.plant.index') }}" class="btn btn-outline-secondary" style="border-radius:8px;">
            {{ __('plant.form_back') }}
        </a>
    </div>

</div>

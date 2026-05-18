{{-- Author: Emily Cardona Castañeda --}}

@php
    $exclusiveCategory   = $viewData['exclusiveCategory'] ?? null;
    $exclusiveCategoryId = $exclusiveCategory ? $exclusiveCategory->getId() : null;
    $product             = $viewData['product'] ?? null;
    $categories          = $viewData['categories'] ?? collect();
    $selectedCategoryId  = old('category_id', $product ? $product->getCategoryId() : '');
    $isActive            = old('active', $product ? $product->getActive() : true);
@endphp

<div class="row g-3">

    {{-- Nombre --}}
    <div class="col-12">
        <label for="name" class="form-label">{{ __('product.form_name') }}</label>
        <input type="text" id="name" name="name" class="form-control"
               placeholder="{{ __('product.form_name_placeholder') }}"
               value="{{ old('name', $product?->getName()) }}">
    </div>

    {{-- Description --}}
    <div class="col-12">
        <label for="description" class="form-label">{{ __('product.form_description') }}</label>
        <textarea id="description" name="description" class="form-control" rows="3"
                  placeholder="{{ __('product.form_description_placeholder') }}"
        >{{ old('description', $product?->getDescription()) }}</textarea>
    </div>

    {{-- Price and Stock --}}
    <div class="col-md-4">
        <label for="price" class="form-label">{{ __('product.form_price') }}</label>
        <input type="number" id="price" name="price" class="form-control" min="0"
               placeholder="25000"
               value="{{ old('price', $product?->getPrice()) }}">
    </div>
    <div class="col-md-4">
        <label for="discount" class="form-label">{{ __('product.form_discount') }}</label>
        <input type="number" id="discount" name="discount" class="form-control" min="0" max="100"
               value="{{ old('discount', $product?->getDiscount() ?? 0) }}">
    </div>
    <div class="col-md-4">
        <label for="stock" class="form-label">{{ __('product.form_stock') }}</label>
        <input type="number" id="stock" name="stock" class="form-control" min="0"
               value="{{ old('stock', $product?->getStock() ?? 0) }}">
    </div>

    {{-- Category --}}
    <div class="col-md-6">
        <label for="category_id" class="form-label">{{ __('product.form_category') }}</label>
        <select id="category_id" name="category_id" class="form-select">
            <option value="">{{ __('product.form_category_placeholder') }}</option>
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
        <label for="color" class="form-label">{{ __('product.form_color') }}</label>
        <input type="text" id="color" name="color" class="form-control"
               placeholder="{{ __('product.form_color_placeholder') }}"
               value="{{ old('color', $product?->getColor()) }}">
    </div>

    {{-- Size / Presentation --}}
    <div class="col-md-6">
        <label for="size" class="form-label">{{ __('product.form_size') }}</label>
        <input type="text" id="size" name="size" class="form-control"
               placeholder="{{ __('product.form_size_placeholder') }}"
               value="{{ old('size', $product?->getSize()) }}">
    </div>

    {{-- Marca / Origen --}}
    <div class="col-md-6">
        <label for="brand" class="form-label">{{ __('product.form_brand') }}</label>
        <input type="text" id="brand" name="brand" class="form-control"
               placeholder="{{ __('product.form_brand_placeholder') }}"
               value="{{ old('brand', $product?->getBrand()) }}">
    </div>

    {{-- Imagen --}}
    <div class="col-12">
        <label for="image" class="form-label">{{ __('product.form_image') }}</label>
        <input type="text" id="image" name="image" class="form-control"
               placeholder="{{ __('product.form_image_placeholder') }}"
               value="{{ old('image', $product?->getImage()) }}">
        <small class="text-muted" style="font-size:.78rem; margin-top:.3rem; display:block;">
        </small>
    </div>

    {{-- Activo --}}
    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" id="active" name="active" value="1"
                   class="form-check-input" {{ $isActive ? 'checked' : '' }}>
            <label for="active" class="form-check-label">{{ __('product.form_active') }}</label>
        </div>
        {{-- Campo oculto para exclusive — requerido por el controlador --}}
        <input type="hidden" name="exclusive" value="0">
    </div>

    {{-- Botones --}}
    <div class="col-12 d-flex gap-2 pt-2">
        <button type="submit" class="btn btn-success px-4" style="border-radius:8px;">
            {{ $submitText }}
        </button>
        <a href="{{ route('admin.product.index') }}" class="btn btn-outline-secondary" style="border-radius:8px;">
            {{ __('product.form_back') }}
        </a>
    </div>

</div>

@extends('layouts.admin')

@section('title', $title ?? 'Formulario')

@section('header', $header ?? 'Formulario')

@section('header_buttons')
<a href="{{ $backRoute }}" class="btn btn-sm btn-secondary">
    <i class="fas fa-arrow-left"></i> Volver
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ $submitRoute }}">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif
            
            @foreach($fields as $field)
                <div class="mb-3">
                    <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}:</label>
                    
                    @if($field['type'] == 'select')
                        <select 
                            name="{{ $field['name'] }}" 
                            id="{{ $field['name'] }}" 
                            class="form-select @error($field['name']) is-invalid @enderror"
                            {{ isset($field['required']) && $field['required'] ? 'required' : '' }}
                        >
                            <option value="">Seleccione una opción</option>
                            @foreach($field['options'] as $option)
                                <option 
                                    value="{{ $option[$field['option_value']] }}" 
                                    {{ old($field['name'], isset($item) ? $item->{$field['name']} : '') == $option[$field['option_value']] ? 'selected' : '' }}
                                >
                                    {{ $option[$field['option_text']] }}
                                </option>
                            @endforeach
                        </select>
                    @elseif($field['type'] == 'textarea')
                        <textarea 
                            name="{{ $field['name'] }}" 
                            id="{{ $field['name'] }}" 
                            rows="3"
                            class="form-control @error($field['name']) is-invalid @enderror"
                            {{ isset($field['required']) && $field['required'] ? 'required' : '' }}
                        >{{ old($field['name'], isset($item) ? $item->{$field['name']} : '') }}</textarea>
                    @elseif($field['type'] == 'radio')
                        <div>
                            @foreach($field['options'] as $option)
                                <div class="form-check form-check-inline">
                                    <input 
                                        class="form-check-input @error($field['name']) is-invalid @enderror" 
                                        type="radio" 
                                        name="{{ $field['name'] }}" 
                                        id="{{ $field['name'] }}_{{ $option['value'] }}" 
                                        value="{{ $option['value'] }}"
                                        {{ old($field['name'], isset($item) ? $item->{$field['name']} : '') == $option['value'] ? 'checked' : '' }}
                                        {{ isset($field['required']) && $field['required'] ? 'required' : '' }}
                                    >
                                    <label class="form-check-label" for="{{ $field['name'] }}_{{ $option['value'] }}">
                                        {{ $option['label'] }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @elseif($field['type'] == 'date')
                        <input 
                            type="date"
                            name="{{ $field['name'] }}" 
                            id="{{ $field['name'] }}" 
                            class="form-control @error($field['name']) is-invalid @enderror"
                            value="{{ old($field['name'], isset($item) ? $item->{$field['name']} : '') }}"
                            {{ isset($field['required']) && $field['required'] ? 'required' : '' }}
                        >
                    @else
                        <input 
                            type="{{ $field['type'] }}"
                            name="{{ $field['name'] }}" 
                            id="{{ $field['name'] }}" 
                            class="form-control @error($field['name']) is-invalid @enderror"
                            value="{{ old($field['name'], isset($item) ? $item->{$field['name']} : '') }}"
                            {{ isset($field['required']) && $field['required'] ? 'required' : '' }}
                        >
                    @endif
                    
                    @error($field['name'])
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endforeach
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ $submitText ?? 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 
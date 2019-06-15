@php
$selected = old($name) ?? optional($__model)->$name ?? $default;
@endphp
<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="{{ $class }}" {!! $attributes !!}>
    @foreach($options as $key => $value)
        @if (is_iterable($value))
            <optgroup label="{{ $value }}">
            @foreach($value as $subkey => $subvalue)
                <option value="{{ $subkey }}" @if($subkey == $selected) selected @endif>{{ $subvalue }}</option>
            @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}" @if($key == $selected) selected @endif>{{ $value }}</option>
        @endif
    @endforeach
    </select>
</div>

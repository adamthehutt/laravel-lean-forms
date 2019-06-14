<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ old($name) ?? optional($__model)->$name ?? $default }}" {!! $attributes !!} class="{{ $class }}">
</div>

@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    @endif
    <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ old($name) ?? optional($__model)->$name ?? $default }}" {!! $attributes !!} class="{{ $class }}">
@if($includeFormGroup)
</div>
@endif

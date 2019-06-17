@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    @endif
    <input id="{{ $id ?? $name }}" type="email" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="{{ $class }}">
@if($includeFormGroup)
</div>
@endif

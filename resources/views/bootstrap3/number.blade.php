@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label class="{{ $label_class }}" for="{{ $id ?? $name }}">{{ $label }}</label>
    @endif
    <input id="{{ $id ?? $name }}" type="number" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control {{ $class }}">
@if($includeFormGroup)
</div>
@endif

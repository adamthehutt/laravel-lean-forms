@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="{{ $label_class }}">{{ $label }}</label>
    @endif
    <input id="{{ $id ?? $name }}" type="email" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control {{ $class }}">
@if($includeFormGroup)
</div>
@endif

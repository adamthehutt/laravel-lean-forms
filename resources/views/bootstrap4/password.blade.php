@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id }}" class="{{ $label_class }}">{{ $label }}</label>
    @endif
    <input id="{{ $id }}" type="password" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="{{ $class }}">
@if($includeFormGroup)
</div>
@endif

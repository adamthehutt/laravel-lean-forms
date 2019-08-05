@if($includeFormGroup)
<div class="form-group @if(isset($errors) && $errors->has($name)) has-error @endif">
@endif
    @if($includeLabel)
    <label class="{{ $label_class }}" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" class="form-control {{ $class }}" {!! $attributes !!}>
@if($includeFormGroup)
</div>
@endif

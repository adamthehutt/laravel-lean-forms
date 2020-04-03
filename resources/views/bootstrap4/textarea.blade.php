@if($includeFormGroup)
<div class="form-group @if(isset($errors) && $errors->has($name)) has-error @endif">
@endif
    @if($includeLabel)
    <label for="{{ $name }}" class="col-form-label {{ $label_class }}">{{ $label }}</label>
    @endif
    <textarea id="{{ $name }}" name="{{ $name }}" {!! $attributes !!} class="form-control {{ $class }}">{{ $__value }}</textarea>
@if($includeFormGroup)
</div>
@endif

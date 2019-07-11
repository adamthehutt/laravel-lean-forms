@if($includeFormGroup)
<div class="form-group @if(isset($errors) && $errors->has($name)) has-error @endif">
@endif
    @if($includeLabel)
    <label for="{{ $name }}" class="col-form-label {{ $label_class }}">{{ $label }}</label>
    @endif
    <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control {{ $class }}">
@if($includeFormGroup)
</div>
@endif

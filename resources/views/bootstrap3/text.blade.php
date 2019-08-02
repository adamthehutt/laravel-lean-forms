@if($includeFormGroup)
<div class="form-group @if(isset($errors) && $errors->has($name)) has-error @endif">
@endif
    @if($includeLabel)
    <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" class="form-control" {!! $attributes !!}>
@if($includeFormGroup)
</div>
@endif

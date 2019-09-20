<div class="form-group @if(isset($errors) && $errors->has($name)) has-error @endif">
    <label class="{{ $label_class }}" for="{{ $name }}">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" {!! $attributes !!} class="form-control {{ $class }}">{{ $__value }}</textarea>
</div>

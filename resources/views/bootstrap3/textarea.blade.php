<div class="form-group">
    <label class="{{ $label_class }}" for="{{ $name }}">{{ $label }}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" {!! $attributes !!} class="form-control {{ $class }}">{{ $__value }}</textarea>
</div>

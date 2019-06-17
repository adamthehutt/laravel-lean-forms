<div class="form-group">
    <label for="{{ $name }}">{{ $label ?? ucwords(str_replace("_", " ", $name))}}</label>
    <textarea id="{{ $name }}" name="{{ $name }}" {!! $attributes !!} class="form-control">{{ $__value }}</textarea>
</div>

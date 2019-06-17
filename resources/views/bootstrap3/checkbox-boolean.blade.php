<div class="form-group">
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="1" class="{{ $class }}" {!! $attributes !!} @if($__value)checked @endif>
</div>

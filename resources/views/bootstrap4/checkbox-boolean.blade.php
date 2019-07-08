@if($includeFormGroup)
<div class="form-group">
@endif
  <div class="form-check">
    @if($includeLabel)
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label }}</label>
    @endif
    <input type="hidden" name="{{ $name }}" value="0">
    <input type="checkbox" name="{{ $name }}" value="1" class="{{ $class }}" {!! $attributes !!} @if($__value)checked @endif>
  </div>
@if($includeFormGroup)
</div>
@endif

@if($includeFormGroup)
<div class="form-group">
@endif
  <div class="form-check">
    @if($includeLabel)
    <input type="checkbox" name="{{ $name }}" value="1" class="form-check-input {{ $class }}" {!! $attributes !!} @if($__value)checked @endif>
    <label for="{{ $name }}" class="form-check-label {{ $label_class }}">{{ $label }}</label>
    @endif
    <input type="hidden" name="{{ $name }}" value="0">
  </div>
@if($includeFormGroup)
</div>
@endif

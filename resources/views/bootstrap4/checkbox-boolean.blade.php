@if($includeFormGroup)
<div class="form-group">
@endif
  <div class="form-check">
    <input type="checkbox" name="{{ $name }}" value="1" id="{{ $id ?? $name }}" class="form-check-input {{ $class }}" {!! $attributes !!} @if($__value)checked @endif>
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="form-check-label {{ $label_class }}">{{ $label }}</label>
    @endif
    <input type="hidden" name="{{ $name }}" value="0">
  </div>
@if($includeFormGroup)
</div>
@endif

@if($includeFormGroup)
<div class="form-group">
@endif
  <div class="form-check">
    @if($includeLabel)
    <input type="checkbox" name="{{ $name }}" value="1" id="boolean-{{ $label }}" class="form-check-input" {!! $attributes !!} @if($__value)checked @endif>
    <label for="boolean-{{ $label }}" class="form-check-label">{{ $label }}</label>
    @endif
    <input type="hidden" name="{{ $name }}" value="0">
  </div>
@if($includeFormGroup)
</div>
@endif

@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
  @foreach($options as $key => $value)
    <div class="form-check">
      @if($includeLabel)
      <input type="checkbox" name="{{ $name }}" value="1" class="form-check-input" {!! $attributes !!} @if($__value)checked @endif>
      <label for="{{ $name }}" class="form-check-label">{{ $label }}</label>
    </div>
  @endforeach
@if($includeFormGroup)
</div>
@endif

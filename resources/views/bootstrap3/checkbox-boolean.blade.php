@if($includeFormGroup)
<div class="form-group">
@endif
    @if($includeLabel)
    <label class="{{ $label_class }}" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input type="hidden" name="{{ $name }}" value="0">
    <input class="checkbox {{ $class }}" type="checkbox" name="{{ $name }}" value="1" {!! $attributes !!} @if($__value)checked @endif>
@if($includeFormGroup)
</div>
@endif

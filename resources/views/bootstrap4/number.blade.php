@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="">{{ $label }}</label>
    @endif
    <input id="{{ $id ?? $name }}" type="number" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control">
@if($includeFormGroup)
</div>
@endif

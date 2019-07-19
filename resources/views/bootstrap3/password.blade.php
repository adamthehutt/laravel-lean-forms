@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id }}">{{ $label }}</label>
    @endif
    <input id="{{ $id }}" type="password" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control">
@if($includeFormGroup)
</div>
@endif

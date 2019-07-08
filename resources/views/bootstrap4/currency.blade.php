@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label }}</label>
    @endif
    <div class="input-group">
        <span class="input-group-prepend"><i class="fas fa-dollar"></i></span>
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control currency">
    </div>
@if($includeFormGroup)
</div>
@endif

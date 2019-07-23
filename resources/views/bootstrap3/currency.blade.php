@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-dollar-sign"></i></span>
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control currency">
    </div>
@if($includeFormGroup)
</div>
@endif

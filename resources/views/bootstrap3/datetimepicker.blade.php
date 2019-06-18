@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="{{ $label_class }}">{{ $label  }}</label>
    @endif
    <div class="input-group date datetimepicker">
        <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
        <input id="{{ $id ?? $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control">
    </div>
@if($includeFormGroup)
</div>
@endif
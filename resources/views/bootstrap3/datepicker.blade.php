@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label  }}</label>
    @endif
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control datepicker">
    </div>
@if($includeFormGroup)
</div>
@endif

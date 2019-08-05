@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label class="{{ $label_class }}" for="{{ $name }}">{{ $label  }}</label>
    @endif
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control datepicker {{ $class }}">
    </div>
@if($includeFormGroup)
</div>
@endif

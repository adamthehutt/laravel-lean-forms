@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="">{{ $label  }}</label>
    @endif
    <div class="input-group date">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
      </div>
        <input id="{{ $id ?? $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control datetimepicker">
    </div>
@if($includeFormGroup)
</div>
@endif

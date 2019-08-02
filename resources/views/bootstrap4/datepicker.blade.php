@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $name }}" class="col-form-label">{{ $label  }}</label>
    @endif
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
      </div>
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control datepicker">
    </div>
@if($includeFormGroup)
</div>
@endif

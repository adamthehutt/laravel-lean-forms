@if($includeFormGroup)
<fieldset class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <legend for="{{ $id ?? $name }}" class="col-form-label {{ $label_class }}">{{ $label }}</legend>
    @endif

    @foreach($options as $key => $descriptor)
    <div class="form-check">
        <label>
            <input type="radio" name="{{ $name }}" id="{{ $id ?? $name }}-{{ $key }}" value="{{ $key }}" class="form-check-input" @if($key == $__value) checked @endif>
            {{ $descriptor }}
        </label>
    </div>
    @endforeach
@if($includeFormGroup)
</fieldset>
@endif

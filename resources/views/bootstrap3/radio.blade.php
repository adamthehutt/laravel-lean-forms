@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}">{{ $label }}</label>
    @endif

    @foreach($options as $key => $descriptor)
    <div class="radio">
        <label>
            <input type="radio" name="{{ $name }}" id="{{ $id ?? $name }}-{{ $key }}" value="{{ $key }}" @if($key == $__value) checked @endif>
            {{ $descriptor }}
        </label>
    </div>
    @endforeach
@if($includeFormGroup)
</div>
@endif

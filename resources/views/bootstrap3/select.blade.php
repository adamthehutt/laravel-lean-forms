@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    @endif

    <select id="{{ $id ?? $name }}" name="{{ $name }}" class="{{ $class }}" {!! $attributes !!}>
    @foreach($options as $key => $value)
        @if (is_iterable($value))
            <optgroup label="{{ $value }}">
            @foreach($value as $subkey => $subvalue)
                <option value="{{ $subkey }}" @if($__value->contains($subkey)) selected @endif>{{ $subvalue }}</option>
            @endforeach
            </optgroup>
        @else
            <option value="{{ $key }}" @if($__value->contains($key)) selected @endif>{{ $value }}</option>
        @endif
    @endforeach
    </select>

@if($includeFormGroup)
</div>
@endif

@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="{{ $label_class }}">{{ $label }}</label>
    @endif

    <select id="{{ $id ?? $name }}" name="{{ $name }}" class="{{ $class }}" {!! $attributes !!}>
    @foreach($options as $key => $value)
        @if (is_iterable($value))
            @include("lean-forms::bootstrap3.select-optgroup")
        @else
            <option value="{{ $key }}" @if($__value->contains($key)) selected @endif>{{ $value }}</option>
        @endif
    @endforeach
    </select>

@if($includeFormGroup)
</div>
@endif

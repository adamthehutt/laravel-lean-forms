@if($includeFormGroup)
<div class="form-group @error($name) has-error @enderror">
@endif
    @if($includeLabel)
    <label for="{{ $id ?? $name }}" class="col-form-label">{{ $label }}</label>
    @endif

    <select id="{{ $id ?? $name }}" name="{{ $name }}" class="form-control" {!! $attributes !!}>
    @foreach($options as $key => $value)
        @if (is_iterable($value))
            @include("lean-forms::bootstrap4.select-optgroup")
        @else
            <option value="{{ $key }}" @if($__value->contains($key)) selected @endif>{{ $value }}</option>
        @endif
    @endforeach
    </select>

@if($includeFormGroup)
</div>
@endif

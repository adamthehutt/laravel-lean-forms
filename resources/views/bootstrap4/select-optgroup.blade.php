<optgroup label="{{ $key }}">
    @foreach($value as $subkey => $subvalue)
        @if (is_iterable($subvalue))
            @include("lean-forms::" . config('lean-forms.skin') . ".select-optgroup", ["value" => $subvalue, "key" => $subkey])
        @else
            <option value="{{ $subkey }}" @if($__value->contains($subkey)) selected @endif>{{ $subvalue }}</option>
        @endif
    @endforeach
</optgroup>

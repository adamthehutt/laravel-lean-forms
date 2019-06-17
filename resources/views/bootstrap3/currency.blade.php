<div class="form-group @error($name) has-error @enderror">
    <label for="{{ $name }}" class="{{ $label_class }}">{{ $label ?? ucwords(str_replace("_", " ", $name)) }}</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fas fa-dollar"></i></span>
        <input id="{{ $name }}" type="text" name="{{ $name }}" value="{{ $__value }}" {!! $attributes !!} class="form-control currency">
    </div>
</div>

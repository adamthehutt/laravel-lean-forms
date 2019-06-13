<input type="hidden" name="{{ $name }}" value="{{ old($name) ?? optional($__model)->$name ?? $default }}">

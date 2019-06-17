<form action="{{$action}}" id="{{$id ?? "lean-form"}}" method="{{$htmlMethod}}" accept-charset="UTF-8" class="{{$class ?? ""}}" @if(isset($files) && $files)enctype="multipart/form-data"@endif>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@if($realMethod != $htmlMethod)
<input type="hidden" name="_method" value="{{$realMethod}}">
@endif

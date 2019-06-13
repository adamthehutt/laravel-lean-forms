<form action="{{$action}}" method="{{$htmlMethod}}" accept-charset="UTF-8">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
@if($realMethod != $htmlMethod)
<input type="hidden" name="_method" value="{{$realMethod}}">
@endif

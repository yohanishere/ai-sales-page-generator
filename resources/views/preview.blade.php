<!DOCTYPE html>
<html>
<head>
    <title>Sales Page</title>
    @include('components.head')
</head>
    @if($style == 'dark')
        @include('previews.dark')
    @elseif($style == 'premium')
        @include('previews.premium')
    @elseif($style == 'friendly')
        @include('previews.friendly')
    @else
        @include('previews.default')
    @endif
</html>
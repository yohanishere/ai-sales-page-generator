<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $result['headline'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
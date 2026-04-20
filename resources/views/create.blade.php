<!DOCTYPE html>
<html>
<head>
    <title>Generate</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="max-w-3xl mx-auto p-6 bg-white mt-10 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-6">Generate Sales Page</h1>

        @include('form', [
            'action' => $action ?? '/generate',
            'method' => $method ?? 'POST',
            'input' => $input ?? [],
            'style' => $style ?? 'default',
            'button' => $button ?? 'Generate'
        ])

    </div>

</body>
</html>
<body class="bg-gradient-to-br from-blue-100 via-sky-100 to-indigo-100 text-gray-800">

    <div class="max-w-3xl mx-auto p-6">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-600 mb-3">
                🎉 {{ $result['headline'] }}
            </h1>
            <p class="text-lg text-gray-700">
                {{ $result['subheadline'] }}
            </p>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-md mb-6 text-center">
            {{ $result['description'] }}
        </div>

        <div class="mb-6 bg-white p-5 rounded-2xl shadow-sm">
            <h2 class="text-xl font-semibold mb-3 text-blue-500">✨ Benefits</h2>
            <ul class="space-y-2">
                @foreach($result['benefits'] ?? [] as $item)
                    <li>👉 {{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <div class="mb-6 bg-white p-5 rounded-2xl shadow-sm">
            <h2 class="text-xl font-semibold mb-3 text-indigo-500">🎯 Feature</h2>
            <ul class="space-y-2">
                @foreach($result['features'] ?? [] as $item)
                    <li>✔ {{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <div class="bg-blue-200 p-5 rounded-2xl text-center italic mb-6 shadow-sm">
            💬 "{{ $result['social_proof'] }}"
        </div>

        <div class="text-center">
            <p class="text-3xl font-bold text-blue-600 mb-4">
                {{ $result['price_display'] }}
            </p>
            <button class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-8 py-3 rounded-full text-lg shadow-md hover:scale-105 transition">
                🚀 {{ $result['cta'] }}
            </button>
        </div>

        <div class="flex justify-center gap-4 mt-8">

            @if(isset($input))
                <form method="POST" action="{{ (isset($id) && $id > 0) ? '/edit/'.$id : '/save' }}">
                @csrf
                    <input type="hidden" name="result" value='@json($result)'>
                    <input type="hidden" name="input" value='@json($input)'>
                    <input type="hidden" name="style" value="{{ $style }}">
                    @if((isset($id) && $id > 0))
                        <input type="hidden" name="id" value="{{ $id }}">
                    @endif

                    <button class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-600 shadow-md">
                        {{ (isset($id) && $id > 0) ? 'Update' : 'Save' }}
                    </button>
                </form>

                <a href="{{ '/generate?' . http_build_query(array_merge($input ?? [],['style' => $style],(isset($id) && $id > 0) ? ['id' => $id] : [])) }}"
                class="bg-blue-100 text-blue-600 px-6 py-3 rounded-full hover:bg-blue-200 shadow-md">
                    Back
                </a>

            @elseif((isset($id) && $id > 0))
                <a href="/edit/{{ $id }}"
                class="bg-blue-400 text-white px-6 py-3 rounded-full hover:bg-blue-500 transition shadow">
                    Edit
                </a>
                <a href="/"
                class="bg-blue-100 text-blue-600 px-6 py-3 rounded-full hover:bg-blue-200 shadow-md">
                    Back
                </a>
            @endif

        </div>

    </div>

</body>
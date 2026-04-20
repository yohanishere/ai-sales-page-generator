<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto bg-white p-8 mt-10 rounded-xl shadow">

        <h1 class="text-4xl font-bold text-center mb-4">
            {{ $result['headline'] }}
        </h1>

        <p class="text-xl text-center text-gray-600 mb-6">
            {{ $result['subheadline'] }}
        </p>

        <p class="mb-6 text-gray-700">
            {{ $result['description'] }}
        </p>

        <h2 class="text-2xl font-semibold mb-3">Manfaat</h2>
        <ul class="list-disc pl-5 mb-6">
            @foreach($result['benefits'] ?? [] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        <h2 class="text-2xl font-semibold mb-3">Fitur</h2>
        <ul class="list-disc pl-5 mb-6">
            @foreach($result['features'] ?? [] as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        <div class="bg-gray-50 p-4 rounded mb-6 italic text-center">
            "{{ $result['social_proof'] }}"
        </div>

        <div class="text-3xl font-bold text-green-600 mb-6 text-center">
            {{ $result['price_display'] }}
        </div>

        <div class="text-center">
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-700">
                {{ $result['cta'] }}
            </button>
        </div>

        <div class="flex justify-center gap-4 mt-8">

            @if(isset($input))
                <form method="POST" action="{{ isset($id) ? '/edit/'.$id : '/save' }}">
                @csrf
                    <input type="hidden" name="result" value='@json($result)'>
                    <input type="hidden" name="input" value='@json($input)'>
                    <input type="hidden" name="style" value="{{ $style }}">
                    @if(isset($id))
                        <input type="hidden" name="id" value="{{ $id }}">
                    @endif

                    <button class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 shadow">
                        {{ isset($id) ? 'Update' : 'Save' }}
                    </button>
                </form>

                <a href="{{ '/generate?' . http_build_query(array_merge($input ?? [],['style' => $style],isset($id) ? ['id' => $id] : [])) }}"
                class="bg-gray-300 px-6 py-3 rounded-lg hover:bg-gray-400 shadow">
                    Back
                </a>

            @elseif(isset($id))
                <a href="/edit/{{ $id }}"
                class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition">
                    Edit
                </a>
                <a href="/"
                    class="bg-gray-300 px-6 py-3 rounded-lg hover:bg-gray-400 shadow">
                    Back
                </a>
            @endif

        </div>

    </div>

</body>
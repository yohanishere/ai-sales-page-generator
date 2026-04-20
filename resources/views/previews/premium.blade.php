<body class="bg-gradient-to-b from-yellow-50 to-white text-gray-900">

    <div class="max-w-4xl mx-auto p-12">

        <div class="text-center mb-12">
            <h1 class="text-5xl font-serif font-bold mb-4 tracking-wide">
                {{ $result['headline'] }}
            </h1>
            <p class="text-lg text-gray-600">
                {{ $result['subheadline'] }}
            </p>
        </div>

        <div class="mb-10 text-center italic text-lg leading-relaxed">
            {{ $result['description'] }}
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <h2 class="font-semibold mb-4 text-yellow-600 uppercase tracking-wide">Feature</h2>
                <ul class="space-y-2">
                    @foreach($result['features'] ?? [] as $item)
                        <li>• {{ $item }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <h2 class="font-semibold mb-4 text-yellow-600 uppercase tracking-wide">Benefits</h2>
                <ul class="space-y-2">
                    @foreach($result['benefits'] ?? [] as $item)
                        <li>• {{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="border-l-4 border-yellow-500 pl-6 italic text-gray-700 mb-10">
            "{{ $result['social_proof'] }}"
        </div>

        <div class="text-center">
            <p class="text-4xl font-bold text-yellow-600 mb-6">
                {{ $result['price_display'] }}
            </p>
            <button class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-10 py-4 rounded-full text-lg shadow-lg hover:scale-105 hover:shadow-xl transition">
                {{ $result['cta'] }}
            </button>
        </div>

        <div class="flex justify-center gap-6 mt-10">

            @if(isset($input))
                <form method="POST" action="{{ isset($id) ? '/edit/'.$id : '/save' }}">
                @csrf
                    <input type="hidden" name="result" value='@json($result)'>
                    <input type="hidden" name="input" value='@json($input)'>
                    <input type="hidden" name="style" value="{{ $style }}">
                    @if(isset($id))
                        <input type="hidden" name="id" value="{{ $id }}">
                    @endif

                    <button class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-black px-8 py-3 rounded-full shadow-xl hover:scale-105 transition">
                        {{ isset($id) ? 'Update' : 'Save' }}
                    </button>
                </form>

                <a href="{{ '/generate?' . http_build_query(array_merge($input ?? [],['style' => $style],isset($id) ? ['id' => $id] : [])) }}"
                class="border border-yellow-500 text-yellow-600 px-6 py-3 rounded-full hover:bg-yellow-500 hover:text-white transition">
                    Back
                </a>

            @elseif(isset($id))
                <a href="/edit/{{ $id }}"
                class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-black px-6 py-3 rounded-full shadow-lg hover:scale-105 transition">
                    Edit
                </a>
                <a href="/"
                class="border border-yellow-500 text-yellow-600 px-6 py-3 rounded-full hover:bg-yellow-500 hover:text-white transition">
                    Back
                </a>
            @endif

        </div>

    </div>

</body>
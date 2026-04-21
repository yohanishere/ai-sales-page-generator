<body class="bg-gray-900 text-white">

    <div class="max-w-5xl mx-auto p-8">

        <h1 class="text-5xl font-extrabold text-center mb-6">
            {{ $result['headline'] }}
        </h1>

        <p class="text-center text-gray-400 text-lg mb-10">
            {{ $result['subheadline'] }}
        </p>

        <div class="grid md:grid-cols-2 gap-6">

            <div>
                <h2 class="text-xl font-semibold mb-2">Tentang Produk</h2>
                <p class="text-gray-300">{{ $result['description'] }}</p>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg italic">
                "{{ $result['social_proof'] }}"
            </div>

        </div>

        <div class="mt-10">
            <h2 class="text-2xl font-bold mb-4">Manfaat</h2>
            <ul class="space-y-2">
                @foreach($result['benefits'] ?? [] as $item)
                    <li>✔ {{ $item }}</li>
                @endforeach
            </ul>
        </div>

        <div class="text-center mt-10">
            <p class="text-3xl text-purple-400 font-bold mb-4">
                {{ $result['price_display'] }}
            </p>
            <button class="bg-purple-600 px-8 py-4 rounded-xl text-lg hover:bg-purple-700">
                {{ $result['cta'] }}
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

                    <button class="bg-green-500 text-black px-6 py-3 rounded-lg hover:bg-green-400 shadow-lg">
                        {{ (isset($id) && $id > 0) ? 'Update' : 'Save' }}
                    </button>
                </form>

                <a href="{{ '/generate?' . http_build_query(array_merge($input ?? [],['style' => $style],(isset($id) && $id > 0) ? ['id' => $id] : [])) }}"
                class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 shadow-lg">
                    Back
                </a>

            @elseif((isset($id) && $id > 0))
                <a href="/edit/{{ $id }}"
                class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 border border-gray-500 transition">
                    Edit
                </a>
                <a href="/"
                    class="bg-gray-700 text-white px-6 py-3 rounded-lg hover:bg-gray-600 shadow-lg">
                    Back
                </a>
            @endif

        </div>

    </div>

</body>
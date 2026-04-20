<!DOCTYPE html>
<html>
<head>
    <title>Saved Pages</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">📄 Saved Sales Pages</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid md:grid-cols-2 gap-6">

        @forelse($pages as $page)
            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

                <h2 class="text-xl font-semibold mb-2">
                    {{ $page->title }}
                </h2>

                <p class="text-gray-600 text-sm mb-4">
                    {{ \Illuminate\Support\Str::limit($page->headline, 100) }}
                </p>

                <div class="text-xs text-gray-400 mb-4">
                    Dibuat {{ $page->created_at->diffForHumans() }}
                </div>

                <div class="flex gap-2">

                    <a href="/details/{{ $page->id }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                        Preview
                    </a>

                    <a href="/edit/{{ $page->id }}"
                        class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-500 text-sm">
                        Edit
                    </a>

                    <form method="POST" action="/pages/{{ $page->id }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau hapus?')"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 text-sm">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        @empty
            <div class="col-span-2 text-center text-gray-500">
                Belum ada sales page 😢
            </div>
        @endforelse

    </div>

</div>

</body>
</html>
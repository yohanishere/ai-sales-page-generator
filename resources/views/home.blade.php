<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <div class="min-h-screen">

        <nav class="bg-white shadow px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">AI Sales Generator</h1>

            <div class="flex items-center gap-4">
                <span class="text-gray-600">Welcome {{ auth()->user()->name }}</span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            </div>
        </nav>

        <div class="max-w-6xl mx-auto p-6">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Sales Pages</h2>

                <a href="/generate"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Create
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">

                @forelse($pages as $page)
                    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">

                        <h3 class="text-lg font-semibold mb-2">
                            {{ $page->title }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-4">
                            {{ \Illuminate\Support\Str::limit($page->headline, 100) }}
                        </p>

                        <div class="text-xs text-gray-400 mb-4">
                            {{ $page->created_at->diffForHumans() }}
                        </div>

                        <div class="flex gap-2">

                            <a href="/detail/{{ $page->id }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 text-sm">
                                Detail
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

                            <a href="/export/{{ $page->id }}"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
                                Export
                            </a>

                        </div>

                    </div>
                @empty
                    <div class="col-span-2 text-center text-gray-500">
                        No sales page yet
                    </div>
                @endforelse

            </div>

        </div>

    </div>

</body>
</html>
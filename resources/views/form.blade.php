<form method="POST" action="{{ $action }}">
    
    @csrf
    @if($method == 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label class="block mb-1 font-medium">Product</label>
        <input type="text" name="product" value="{{ $input['product'] ?? '' }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Description</label>
        <textarea name="description" class="w-full p-2 border rounded">{{ $input['description'] ?? '' }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Features</label>
        <input type="text" name="features" value="{{ $input['features'] ?? '' }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Target Audience</label>
        <input type="text" name="audience" value="{{ $input['audience'] ?? '' }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Price</label>
        <input type="text" name="price" value="{{ $input['price'] ?? '' }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-medium">Unique Selling Point</label>
        <input type="text" name="selling_point" value="{{ $input['selling_point'] ?? '' }}" class="w-full p-2 border rounded">
    </div>

    <div class="mb-8">
        <label class="block mb-1 font-medium">Style</label>
        <select name="style" class="w-full p-2 border rounded">
            <option value="default" {{ ($style ?? '') == 'default' ? 'selected' : '' }}>Default</option>
            <option value="dark" {{ ($style ?? '') == 'dark' ? 'selected' : '' }}>Dark</option>
            <option value="premium" {{ ($style ?? '') == 'premium' ? 'selected' : '' }}>Premium</option>
            <option value="friendly" {{ ($style ?? '') == 'friendly' ? 'selected' : '' }}>Friendly</option>
        </select>
    </div>
                    
    <input type="hidden" name="id" value="{{ $page_id }}">

    <div class="flex justify-between items-center mt-6">
        <a href="/"
        class="bg-gray-300 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-400">
            Back
        </a>
        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            {{ $button }}
        </button>

    </div>
</form>
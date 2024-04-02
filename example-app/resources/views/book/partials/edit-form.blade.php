<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Edit book
        </h2>
    </header>

    <form enctype="multipart/form-data" method="post" action="{{ route('book.update', ['book' => $book->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="name" value="Name" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $book->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="category_id" value="Category" />
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>
        <div>
            <x-input-label for="price" value="Price" />
            <x-text-input id="price" step="0.01" name="price" type="number" class="mt-1 block w-full" :value="old('price', $book->price)" required autofocus autocomplete="price" />
            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>
        <div>
            <x-input-label for="quantity" value="Quantity" />
            <x-text-input id="quantity" name="quantity" type="number" class="mt-1 block w-full" :value="old('quantity', $book->quantity)" required autofocus autocomplete="quantity" />
            <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
        </div>
        <div>
            <x-input-label for="image" value="image" />
            <x-text-input id="image" name="image" type="file" class="mt-1 block w-full"/>
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <button>
                <a href="{{route('book.create')}}">Create</a>
            </button>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table>
                    <thead>
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                Category
                            </td>
                            <td>
                                Price
                            </td>
                            <td>
                                Quantity
                            </td>
                            <td>
                                Edit
                            </td>
                            <td>
                                Delete
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>
                                    {{$book->name}}
                                </td>
                                <td>
                                    {{$book->category->name}}
                                </td>
                                <td>
                                    {{$book->price}}
                                </td>
                                <td>
                                    {{$book->quantity}}
                                </td>
                                <td>
                                    <button>
                                        <a href="{{route('book.edit', ['book' => $book->id])}}">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('book.delete', ['book' => $book->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <button>
                <a href="{{route('category.create')}}">Create</a>
            </button>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <table>
                    <thead>
                        <tr>
                            <td>
                                Name
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
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{$category->name}}
                                </td>
                                <td>
                                    <button>
                                        <a href="{{route('category.edit', ['category' => $category->id])}}">Edit</a>
                                    </button>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('category.delete', ['category' => $category->id]) }}">
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

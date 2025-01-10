@extends('Layouts.index')

@section('content')
  <section class="container my-24 mx-auto">
  <div class="grid grid-cols-1 gap-4 px-20">
    <div class="relative bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
      <a href="#">
      <img class="h-auto max-w-full rounded-lg" src="{{ asset('storage/' . $book->image) }}" alt="">
      </a>
      <div class="absolute top-0 flex justify-between w-full">
        <p class="bg-white px-3 py-2 rounded-br-lg text-lg">{{ $book->created_at->translatedFormat('d F Y') }}</p>
        <p class="bg-white px-3 py-2 rounded-bl-lg text-lg">{{ $book->category->name }}</p>
      </div>
      <div class="py-2 px-5">
        <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $book->title }}
        </h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">{{ Str::limit($book->summary, 120) }}</p>

        <div class="flex w-full justify-end mt-5">
          <a href="{{ route('books.edit', $book->id) }}" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900">Edit</a>

          <!-- Simpan di bawah button edit -->
        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">Delete</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
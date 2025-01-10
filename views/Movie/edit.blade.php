@extends('Layouts.index')

@section('content')
<section class="container my-24 mx-auto">
  <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data"
    class="max-w-4xl mx-auto bg-blue-50 rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 p-5">
    @csrf
    @method('PUT') <!-- Tambahkan method PUT untuk update -->

    <!-- Title -->
    <div class="relative z-0 w-full mb-5 group">
      <input type="text" name="title" id="title" value="{{ old('title', $movie->title) }}"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        placeholder=" " required />
      <label for="title"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Title</label>
      @error('title')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <div class="grid md:grid-cols-2 md:gap-6">
      <!-- Genre -->
      <div class="relative z-0 w-full mb-5 group">
        <select name="genre_id" id="genre_id"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          required>
          <option value="" disabled {{ old('genre_id', $movie->genre_id) ? '' : 'selected' }}>Pilih genre</option>
          @foreach($genres as $genre)
          <option value="{{ $genre->id }}" {{ old('genre_id', $movie->genre_id) == $genre->id ? 'selected' : '' }}>
            {{ $genre->name }}
          </option>
          @endforeach
        </select>
        <label for="genre_id"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Genre</label>
        @error('genre_id')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      <!-- Year -->
      <div class="relative z-0 w-full mb-5 group">
        <input type="number" name="year" id="year" value="{{ old('year', $movie->year) }}" min="1900" max="{{ date('Y') }}"
          class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
          placeholder=" " required />
        <label for="year"
          class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Year</label>
        @error('year')
        <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>
    </div>

    <!-- Synopsis -->
    <div class="relative z-0 w-full mb-5 group">
      <textarea name="synopsis" id="synopsis" rows="4"
        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
        placeholder=" " required>{{ old('synopsis', $movie->synopsis) }}</textarea>
      <label for="synopsis"
        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:text-blue-600 peer-focus:dark:text-blue-500">Synopsis</label>
      @error('synopsis')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Available (True/False) -->
    <div class="relative z-0 w-full mb-5 group">
      <label for="available" class="inline-flex items-center">
        <input type="checkbox" name="available" id="available" value="1"
          class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out"
          {{ old('available', $movie->available) ? 'checked' : '' }} />
        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">Available</span>
      </label>
      @error('available')
      <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
    </div>

    <!-- Image (Poster) -->
    <div class="flex mb-6 items-center justify-center w-full">
      <label for="image" class="relative overflow-hidden flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('image') is-invalid @enderror">
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
          <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 4096KB)</p>
        </div>
        @if ($movie->image)
        <img src="{{ asset('storage/' . $movie->image) }}" class="img-preview w-full object-cover object-center absolute z-10">
        @else
        <img  class="img-preview w-full object-cover object-center absolute z-10">
        @endif
        <input id="image" name="image" class="hidden" onchange="previewImage()" type="file" />
        @error('image')
        <p id="standard_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Oh, snapp!</span> {{ $message }}</p>
        @enderror
      </label>
    </div>

    <!-- Submit Button -->
    <button type="submit"
      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
  </form>
</section>
@endsection

<script>
  function previewImage() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".img-preview");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
</script>

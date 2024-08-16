<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="{{ url('books') }}">
        ←
      </a>
      {!! __('Add &raquo; Books') !!}
    </h2>
  </x-slot>

  <!-- <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title') }}" required>
        @error('title')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label for="code">Code:</label>
        <input type="text" id="code" name="code" value="{{ old('code') }}">
        @error('code')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label for="kategori_id">kategori:</label>
        <select id="kategori_id" name="kategori_id" required>
            @foreach ($kategori as $category)
                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('katefory_id')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label for="penulis_id">penulis:</label>
        <select id="penulis_id" name="penulis_id" required>
            @foreach ($penulis as $author)
                <option value="{{ $author->id }}" {{ old('penulis_id') == $author->id ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
        @error('penulis_id')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <label for="cover_image">Cover Image:</label>
        <input type="file" id="cover_image" name="cover_image">
        @error('cover_image')
            <p>{{ $message }}</p>
        @enderror
        <br><br>

        <button type="submit">Add Book</button>
    </form> -->

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div>
        @if ($errors->any())
          <div class="mb-5" role="alert">
            <div class="px-4 py-2 font-bold text-white bg-red-500 rounded-t">
              Ada kesalahan!
            </div>
            <div class="px-4 py-3 text-red-700 bg-red-100 border border-t-0 border-red-400 rounded-b">
              <p>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              </p>
            </div>
          </div>
        @endif
        <form class="w-full" action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="title">
                title*
              </label>
              <input value="{{ old('title') }}" name="title"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="title" type="text" placeholder="title" required>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="code">
                code
              </label>
              <input value="{{ old('code') }}" name="code"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="code" type="text" placeholder="code" required>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">           
            <label for="message" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Description</label>
            <textarea rows="4" name="description" id="description" class="block py-5 px-4 w-full text-sm tleading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Write your thoughts here...">
                {{ old('description') }}
            </textarea>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
          <label for="kategori_id" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">kategori</label>
        <select id="kategori_id" name="kategori_id" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
            @foreach ($kategori as $category)
                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }} >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
          </div>
        

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
          <label for="penulis_id" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">penulis</label>
        <select id="penulis_id" name="penulis_id" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
            @foreach ($penulis as $author)
                <option value="{{ $author->id }}" {{ old('penulis_id') == $author->id ? 'selected' : '' }}>
                    {{ $author->name }}
                </option>
            @endforeach
        </select>
          </div>
        
            <div class="avatar-upload px-3 mt-4 mb-6 -mx-3">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="cover_image">
                cover_image
                </label>
                <div class="">
                  <img id="output" src="{{ url('/img/foto-profil.jpg') }}" class="figora"/>
                  <input type="file" id="cover_image" name="cover_image" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" class="mt-5">
                </div>
            </div> 
          <div class="flex flex-wrap mb-6">
            <div class="w-full px-3 text-right">
              <button type="submit"
                      class="px-4 py-2 font-bold text-white bg-red-600 rounded shadow-lg">
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
<style>
  .figora {
    width: 200px;
  }
</style>
<script type="text/javascript">
    
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
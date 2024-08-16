<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="{{ url('kategori') }}">
        ←
      </a>
      {!! __('Add &raquo; Kategori') !!}
    </h2>
  </x-slot>

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
        <form class="w-full" action="{{ route('kategori/store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Nama*
              </label>
              <input value="{{ old('name') }}" name="name"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="text" placeholder="Nama" required>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">           
            <label for="message" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Description</label>
            <textarea rows="4" name="description" id="description" class="block py-5 px-4 w-full text-sm tleading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Write your thoughts here...">
                {{ old('description') }}
            </textarea>
          </div>         
            <div class="avatar-upload px-3 mt-4 mb-6 -mx-3">
                <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="photo">
                   Photo
                </label>
                <div class="">
                  <img id="output" src="{{ url('/img/foto-profil.jpg') }}" class="figora"/>
                  <input type="file" name="photo" accept=".png, .jpg, .jpeg" onchange="loadFile(event)" class="mt-5">
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
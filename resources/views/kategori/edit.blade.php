<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="#!" onclick="window.history.go(-1); return false;">
        ←
      </a>
      {!! __('Edit &raquo; Kategori &raquo; #') . $kategori->id . ' &middot; ' . $kategori->name !!}
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
              <ul>5
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              </p>
            </div>
          </div>
        @endif
        <form class="w-full" action="{{ route('kategori/update', $kategori->id )}}" method="post"
              enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class=" px-3 mt-4 mb-6 -mx-3">
          <div class=" px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="grid-last-name">
                Nama*
              </label>
              <input value="{{ old('name') ?? $kategori->name }}" name="name"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="grid-last-name" type="text" placeholder="Nama" required>
            </div>
          </div>

          <div class=" px-3 mt-4 mb-6 -mx-3">           
            <label for="message" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">Description</label>
            <textarea rows="4" name="description" id="description" class="block py-5 px-4 w-full text-sm tleading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Write your thoughts here...">
            {{ old('description') ?? $kategori->description }}
            </textarea>
          </div>         
          
          <div class="-mx-3 px-3 mt-4 mb-6">
          @if ($kategori->photo)
          <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="photo">
                photo
          </label>
          <div class="">
            <img style="max-width:200px;max-height:200px" id="preview" src="{{ url('uploads').'/'.$kategori->photo }}" >
            
          </div>
          @endif
            <div class="block py-1.5 mt-5 text-gray-900 placeholder:text-gray-400">
                <input type="file" id="photo" class="" name="photo" value=""  accept=".png, .jpg, .jpeg" onchange="previewImage(event)">
                <label for="photo"></label>
            </div>
          </div>
           
    
          <div class=" mb-6 -mx-3">
            <div class="w-full px-3 text-right">
              <button type="submit"
                      class="px-4 py-2 font-bold text-white bg-red-500 rounded shadow-lg hover:bg-red-700">
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script>
  function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                // Jika tidak ada file, set gambar pratinjau ke default (misalnya gambar sebelumnya)
                preview.src = '{{ asset('uploads/' . $kategori->photo) }}';
            }
        }
</script>
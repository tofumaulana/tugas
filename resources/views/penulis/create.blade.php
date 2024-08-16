<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      <a href="{{ route('penulis.index') }}">
        ←
      </a>
      {!! __('Add &raquo; Penulis') !!}
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
        <form class="w-full" action="{{ route('penulis/store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="name">
                Nama*
              </label>
              <input value="{{ old('name') }}" name="name"
                     class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                     id="name" type="text" placeholder="Nama" required>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">
            <div class="w-full">
              <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="slug">
                SLUG 
              </label>
              <div class="relative flex">      
                 <input type="text" id="slug" value="{{ old('slug') }}" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"  required />
                 <div class="absolute end-0 flex items-center">
                     <p class="text-sm text-gray-500 generate">Regenerate</p>
                     <div class="hover:bg-gray-200 spin">
                     <button type="button" class="spinner" onclick="spin()" id="generateBtn">
                     <svg class="w-6 h-6 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                     </svg>
                     </button>
                     </div>
                 </div>
               </div>
            </div>
          </div>

          <div class="flex flex-wrap px-3 mt-4 mb-6 -mx-3">           
            <label for="message" class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase">biografi</label>
            <textarea rows="4" name="biografi" id="biografi" class="block py-5 px-4 w-full text-sm tleading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Write your thoughts here...">
                {{ old('biografi') }}
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
        .spinner {
            transition: 1s;
        }

        .spin {
          margin-top: 10px;
          margin-right: 10px;
        }

        .generate {
          margin-right: 5px;
          margin-top: 2px;
        }

        .figora {
          width: 200px;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    
    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>
<script>
    function spin() {
            var spinner = document.getElementById('generateBtn');
            spinner.style.transform += 'rotate(360deg)';

            // var name = document.getElementById('name').value.trim().toLowerCase();
            var name = document.getElementById('name').value.trim();
            // var slug = name.replace(/\s+/g, '-');
            var initials = getInitials(name);
            var slug = slugify(name, initials);
            document.getElementById('slug').value = slug;
      }

        function slugify(name, initials) {
          var slug = name.toLowerCase().replace(/\s+/g, '-');
        
        // Add initials to slug if they exist
        if (initials) {
            slug += '-' + initials.toLowerCase();
        }

        $(document).ready(function() {
    $('#generateBtn').click(function(e) {
        var name = $('#name').val();

        // Mengirim permintaan AJAX untuk mendapatkan slug
        $.get('{{ url('penulis/getSlug') }}', { 'name': name }, function(data) {
            $('#slug').val(data.slug);
        });
    });
});
    return slug;
    }

    function getInitials(name) {
        let initials = name.split(' ')
        .map(word => word.charAt(0).toUpperCase())
        .join('');
       return initials;
      }
</script>
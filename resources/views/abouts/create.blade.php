<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ isset($about) ? 'Edit About' : 'Create About' }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Error Handling --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-5 shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white p-8 rounded-2xl shadow-lg">
                <form 
                    action="{{ isset($about) ? route('abouts.update', $about->id) : route('abouts.store') }}" 
                    method="POST"
                    class="space-y-6 about-form"
                >
                    @csrf
                    @if(isset($about))
                        @method('PUT')
                    @endif

                    {{-- Input Company Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <input 
                            type="text" 
                            name="company_name" 
                            value="{{ old('company_name', $about->company_name ?? '') }}" 
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 px-4 py-2 rounded-lg shadow-sm"
                            placeholder="Masukkan nama perusahaan"
                            required
                            autofocus
                        >
                    </div>

                    {{-- Input Deskripsi --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea 
                            name="deskripsi" 
                            rows="5"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 px-4 py-2 rounded-lg shadow-sm"
                            placeholder="Tuliskan deskripsi singkat..."
                            required
                        >{{ old('deskripsi', $about->deskripsi ?? '') }}</textarea>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center gap-3">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition">
                            {{ isset($about) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('abouts.index') }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2 rounded-lg shadow-md transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.about-form').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ isset($about) ? "Update data ini?" : "Simpan data baru?" }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '{{ isset($about) ? "Ya, Update!" : "Ya, Simpan!" }}',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>
</x-app-layout>

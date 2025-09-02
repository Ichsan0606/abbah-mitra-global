<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form class="kategori-form" 
                      action="{{ isset($kategori) ? route('kategoris.update', $kategori->id_kategori) : route('kategoris.store') }}" 
                      method="POST">
                    @csrf
                    @if(isset($kategori)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Kategori</label>
                        <input type="text" name="kategori_name" 
                               value="{{ old('kategori_name', $kategori->kategori_name ?? '') }}" 
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ isset($kategori) ? 'Update' : 'Simpan' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('.kategori-form').addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '{{ isset($kategori) ? "Update kategori ini?" : "Simpan kategori baru?" }}',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '{{ isset($kategori) ? "Ya, Update!" : "Ya, Simpan!" }}',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    </script>
</x-app-layout>

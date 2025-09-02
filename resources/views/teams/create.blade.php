<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($team) ? 'Edit Team' : 'Tambah Team' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ isset($team) ? route('teams.update', $team->id) : route('teams.store') }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($team)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Lengkap</label>
                        <input type="text" name="full_name" 
                               value="{{ old('full_name', $team->full_name ?? '') }}" 
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Jabatan</label>
                        <input type="text" name="job" 
                               value="{{ old('job', $team->job ?? '') }}" 
                               class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="4">{{ old('deskripsi', $team->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Foto (jpg/png, max 2MB)</label>
                        <input type="file" name="foto" accept="image/png, image/jpeg" class="w-full">
                        @if(isset($team) && $team->foto)
                            <img src="{{ asset('storage/'.$team->foto) }}" class="w-32 mt-2 rounded">
                        @endif
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ isset($team) ? 'Update' : 'Simpan' }}
                    </button>
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

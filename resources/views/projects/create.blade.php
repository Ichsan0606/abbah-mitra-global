<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($project) ? 'Edit Project' : 'Tambah Project' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($project)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Project</label>
                        <input type="text" name="project_name" value="{{ old('project_name', $project->project_name ?? '') }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="4" required>{{ old('deskripsi', $project->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Kategori</label>
                        <select name="id_kategori" class="w-full border rounded px-3 py-2" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id_kategori }}" 
                                    {{ old('id_kategori', $project->id_kategori ?? '') == $kategori->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->kategori_name }}
                                </option>
                            @endforeach
                        </select>
                        <a href="{{ route('kategoris.create') }}" class="text-indigo-600 text-sm hover:underline mt-2 inline-block">+ Tambah Kategori</a>
                    </div>                    

                    <div class="mb-4">
                        <label class="block text-gray-700">Foto (jpg/png, max 2MB)</label>
                        <input type="file" name="foto" accept="image/png, image/jpeg" class="w-full">
                        @if(isset($project) && $project->foto)
                            <img src="{{ asset('storage/'.$project->foto) }}" class="w-32 mt-2 rounded">
                        @endif
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ isset($project) ? 'Update' : 'Simpan' }}
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

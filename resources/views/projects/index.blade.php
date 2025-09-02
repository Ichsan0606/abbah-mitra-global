<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-end">
                <a href="{{ route('projects.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Tambah Project</a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($projects as $project)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $project->project_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($project->deskripsi, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($project->foto)
                                        <img src="{{ asset('storage/'.$project->foto) }}" 
                                             class="w-20 h-20 object-cover rounded">
                                    @else
                                        <div class="w-20 h-20 bg-gray-200 flex items-center justify-center text-gray-500 text-xs rounded">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                    <a href="{{ route('projects.edit', $project->id) }}" 
                                       class="inline-flex items-center justify-center px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>  
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- Tambahkan SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // cegah submit langsung
                Swal.fire({
                    title: 'Yakin hapus data?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // jalankan submit kalau user pilih "Ya"
                    }
                });
            });
        });
    </script>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif
</x-app-layout>

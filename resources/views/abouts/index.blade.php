<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            About
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tombol Create --}}
            <div class="mb-4 flex justify-end">
                <a href="{{ route('abouts.create') }}" 
                   class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Create About
                </a>
            </div>

            {{-- Notifikasi Success --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Table --}}
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Company Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($abouts as $about)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $about->company_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ Str::limit($about->deskripsi, 80, '...') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap flex gap-2">
                                    <a href="{{ route('abouts.edit', $about->id) }}" 
                                       class="inline-flex items-center justify-center px-3 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                                        Edit
                                    </a>
                                    <form action="{{ route('abouts.destroy', $about->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination jika dipakai --}}
                @if(method_exists($abouts, 'links'))
                    <div class="p-4">
                        {{ $abouts->links() }}
                    </div>
                @endif
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

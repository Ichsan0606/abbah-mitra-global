<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($client) ? 'Edit Client' : 'Tambah Client' }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($client)) @method('PUT') @endif

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Client</label>
                        <input type="text" name="client_name" value="{{ old('client_name', $client->client_name ?? '') }}" class="w-full border rounded px-3 py-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="w-full border rounded px-3 py-2" rows="4">{{ old('deskripsi', $client->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Foto (jpg/png, max 2MB)</label>
                        <input type="file" name="foto" accept="image/png, image/jpeg" class="w-full">
                        @if(isset($client) && $client->foto)
                            <img src="{{ asset('storage/'.$client->foto) }}" class="w-32 mt-2 rounded">
                        @endif
                    </div>
                    <div class="flex items-center gap-3">
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md transition">
                            {{ isset($client) ? 'Update' : 'Create' }}
                        </button>
                        <a href="{{ route('clients.index') }}" 
                           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2 rounded-lg shadow-md transition">
                            Cancel
                        </a>
                    </div>
                    {{-- <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        {{ isset($client) ? 'Update' : 'Simpan' }}
                    </button> --}}
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

@extends('home.template.main')

@section('content')
    <section class="scroll-mt-[69px] max-w-7xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-2 items-start gap-8">
            <!-- Kolom Kiri: Foto -->
            <div class="flex justify-center md:justify-start">
                <div class="p-4 bg-white border-[6px] border-gray-300 rounded-xl shadow-2xl 
                            transform transition duration-500 hover:scale-105 hover:rotate-1 hover:shadow-[0_10px_25px_rgba(0,0,0,0.3)]">
                    <img src="{{ $team->foto ? asset('storage/'.$team->foto) : asset('images/team/default.jpg') }}" 
                         alt="{{ $team->full_name }}" 
                         class="w-full max-w-xs md:max-w-sm lg:max-w-md xl:max-w-lg h-auto rounded-md object-cover">
                </div>
            </div>            

            <!-- Kolom Kanan: Detail -->
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-2 text-gray-800">
                    {{ $team->full_name }}
                </h2>

                <p class="text-indigo-600 font-medium mb-4">
                    {{ $team->job }}
                </p>

                <!-- Deskripsi dengan efek mengetik -->
                <p class="leading-relaxed text-gray-700 text-justify typewriter" id="desc">
                    {{-- kosong, nanti diisi lewat JS --}}
                </p>
            </div>
        </div>
    </section>
@endsection

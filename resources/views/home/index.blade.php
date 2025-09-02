@extends('home.template.main')

@section('content')
    {{-- Carousel Section --}}
    <section id="carousel" class="relative w-full h-[500px] overflow-hidden">
        <div class="relative w-full h-full">
            <!-- Slide 1 -->
            <div class="w-full h-full carousel-slide">
                <img src="{{ asset('images/carousel/carousel-1.jpg') }}" alt="Slide 1" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <h2 class="text-white text-3xl md:text-5xl font-bold">Selamat Datang di Abbah Mitra Global</h2>
                </div>
            </div>
            <!-- Slide 2 -->
            <div class="w-full h-full carousel-slide">
                <img src="{{ asset('images/carousel/carousel-2.jpg') }}" alt="Slide 2" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <h2 class="text-white text-3xl md:text-5xl font-bold">Desain Interior & Eksterior</h2>
                </div>
            </div>
            <!-- Slide 3 -->
            <div class="w-full h-full carousel-slide">
                <img src="{{ asset('images/carousel/carousel-3.jpg') }}" alt="Slide 3" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <h2 class="text-white text-3xl md:text-5xl font-bold">Proyek Berkualitas</h2>
                </div>
            </div>
        </div>
    </section>    
    {{-- About Section --}}
    <section id="about" class="scroll-mt-[69px] max-w-7xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-2 items-start gap-8">
            <!-- Kolom Kiri: Foto -->
            <div class="flex justify-center md:justify-start">
                <div class="overflow-hidden rounded-lg">
                    <img src="{{ asset('images/logo/logo.jpg') }}" 
                         alt="Logo AMG" 
                         class="w-full max-w-xs md:max-w-sm lg:max-w-md xl:max-w-lg h-auto rounded-lg object-cover 
                                transition-transform duration-500 ease-in-out transform hover:scale-105 hover:shadow-2xl">
                </div>
            </div>                      
            <!-- Kolom Kanan: Detail -->
            <div>
                <h2 class="text-3xl md:text-4xl font-bold mb-2 text-gray-800">
                    {{ $abouts->company_name ?? 'Nama Perusahaan' }}
                </h2>
                <!-- Deskripsi dengan efek mengetik -->
                <p class="leading-relaxed text-gray-700 text-justify typewriter" id="about-desc">
                    {{-- kosong, nanti diisi lewat JS --}}
                </p>
            </div>
        </div>
    </section>
    {{-- Project Section --}}
    <section id="project" class="scroll-mt-[69px] bg-gray-100 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Project Kami</h2>
            <p class="text-base text-gray-700 mb-12 max-w-2xl mx-auto">
                Beberapa hasil karya desain interior & eksterior yang telah kami kerjakan. 
                Setiap proyek mencerminkan dedikasi, kreativitas, dan detail yang selalu kami utamakan.
            </p>

            {{-- Filter Kategori --}}
            <div class="flex items-center justify-center gap-3 mb-10">
                <!-- Tombol Prev -->
                <button id="prevBtn" class="px-3 py-2 rounded bg-gray-300 text-gray-800 hover:bg-gray-400 disabled:opacity-40">
                    Prev
                </button>
            
                <!-- Tombol All -->
                <button class="filter-btn px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700" data-filter="all">
                    All
                </button>
            
                <!-- Container kategori -->
                <div id="kategoriContainer" class="flex flex-wrap justify-center gap-3 max-w-[500px] overflow-hidden">
                    @foreach($kategoris as $kategori)
                        <button class="filter-btn px-4 py-2 rounded bg-gray-200 text-gray-800 hover:bg-indigo-600 hover:text-white"
                                data-filter="{{ $kategori->id_kategori }}">
                            {{ $kategori->kategori_name }}
                        </button>
                    @endforeach
                </div>
            
                <!-- Tombol Next -->
                <button id="nextBtn" class="px-3 py-2 rounded bg-gray-300 text-gray-800 hover:bg-gray-400 disabled:opacity-40">
                    Next
                </button>
            </div>

            {{-- Project Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $project)
                <div class="project-item opacity-0 translate-y-10 transition-all duration-700"
                    data-category="{{ $project->id_kategori }}">
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl border border-transparent hover:border-blue-600 transition-all duration-300 h-full flex flex-col">
                        <img src="{{ $project->foto ? asset('storage/'.$project->foto) : asset('images/client/default.jpg') }}" 
                            alt="{{ $project->project_name }}" 
                            class="w-full h-56 object-cover rounded-lg mb-3">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $project->project_name }}</h3>
                        <p class="text-gray-800 text-sm">{{ $project->deskripsi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Team Section --}}
    <section id="team" class="scroll-mt-[69px] bg-white py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Team</h2>
            <p class="text-base mb-12 max-w-2xl mx-auto">
                Di balik setiap desain yang kami hasilkan, ada tim kreatif dan profesional yang berdedikasi. 
                Kami percaya kerja sama, inovasi, dan detail adalah kunci menghasilkan karya terbaik untuk klien kami.
            </p>
    
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($teams as $team)
                <div class="team-item opacity-0 translate-y-10 transition-all duration-700">
                    <a href="{{ route('team.show', Crypt::encryptString($team->id)) }}"
                       class="bg-white p-4 w-64 h-[290px] rounded-lg shadow-md hover:shadow-xl 
                              border border-transparent hover:border-blue-600 
                              transition-all duration-300 flex flex-col text-center mx-auto">
                        
                        <img src="{{ $team->foto ? asset('storage/'.$team->foto) : asset('images/team/default.jpg') }}" 
                             alt="{{ $team->full_name }}" 
                             class="w-32 h-32 mx-auto rounded mb-3 object-cover hover:shadow-xl">
    
                        <h3 class="text-lg font-semibold">{{ $team->full_name }}</h3>
                        <p class="text-blue-600 text-sm">{{ $team->job }}</p>
    
                        <p class="mt-3 text-sm leading-relaxed line-clamp-2">
                            {{ $team->deskripsi }}
                        </p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>        
    {{-- Services Section --}}
    <section id="services" class="scroll-mt-[69px] bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-16">Layanan Kami</h2>
    
            <!-- Grid Layanan -->
            <div class="grid md:grid-cols-3 gap-12 mb-12">
                <div>
                    <div class="text-indigo-600 text-5xl mb-4">🏠</div>
                    <h3 class="text-xl font-semibold mb-2">Desain Interior</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Menciptakan ruang dalam yang estetis, fungsional, dan nyaman.
                    </p>
                </div>
                <div>
                    <div class="text-indigo-600 text-5xl mb-4">🏢</div>
                    <h3 class="text-xl font-semibold mb-2">Desain Eksterior</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Fasad, taman, dan landscape yang menawan sesuai karakter bangunan.
                    </p>
                </div>
                <div>
                    <div class="text-indigo-600 text-5xl mb-4">🎨</div>
                    <h3 class="text-xl font-semibold mb-2">3D Visualisasi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Preview realistis desain Anda dalam bentuk 3D rendering.
                    </p>
                </div>
            </div>
    
            <!-- Video Section -->
            <div class="mt-8">
                <h3 class="text-2xl font-semibold mb-4">Lihat Video Kami</h3>
                <!-- Jika video dari file lokal -->
                {{-- <video controls class="w-full max-w-3xl mx-auto rounded-2xl shadow-lg">
                    <source src="{{ asset('videos/layanan.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutaran video.
                </video> --}}
    
                <!-- Jika ingin pakai YouTube embed -->
                <div class="aspect-w-16 aspect-h-9 max-w-3xl mx-auto rounded-2xl shadow-lg overflow-hidden">
                    <iframe src="https://www.youtube.com/embed/3nccgQ6p4VQ"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            class="w-full h-full"></iframe>
                </div>
            </div>
        </div>
    </section>
    
    {{-- Clients Section --}}
    <section id="clients" class="scroll-mt-[69px] bg-white py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Clients</h2>
            <p class="text-base text-gray-700 mb-12 max-w-2xl mx-auto">
                Beberapa hasil karya desain interior & eksterior yang telah kami kerjakan. 
                Setiap proyek mencerminkan dedikasi, kreativitas, dan detail yang selalu kami utamakan.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($clients as $client)
                <div class="project-item opacity-0 translate-y-10 transition-all duration-700">
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl border border-transparent hover:border-blue-600 transition-all duration-300 h-full flex flex-col">
                        <img src="{{ $client->foto ? asset('storage/'.$client->foto) : asset('images/client/default.jpg') }}" 
                             alt="{{ $client->client_name }}" 
                             class="w-full h-48 mx-auto rounded-lg mb-3 object-cover">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $client->client_name }}</h3>
                        <p class="text-gray-800 text-sm">{{ $client->deskripsi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Contact Section --}}
    <section id="contact" class="scroll-mt-[69px] bg-gray-100 py-12">
        <div class="max-w-xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4">Hubungi Kami</h2>
            <p class="mb-6">Butuh informasi lebih lanjut? Silakan hubungi kami melalui form berikut :</p>
            <form action="{{ route('contact.store') }}" method="POST" class="grid gap-6">
                @csrf
                <input type="text" name="name" placeholder="Nama Anda" class="border rounded-lg px-4 py-3 w-full focus:ring focus:ring-indigo-200">
                <input type="email" name="email" placeholder="Email Anda" class="border rounded-lg px-4 py-3 w-full focus:ring focus:ring-indigo-200">
                <textarea name="message" placeholder="Pesan Anda" rows="4" class="border rounded-lg px-4 py-3 w-full focus:ring focus:ring-indigo-200 min-h-[120px]"></textarea>
                <button type="submit" class="bg-white px-6 py-3 border rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition">
                    Kirim Pesan
                </button>            
            </form>            
        </div>
    </section>
@endsection

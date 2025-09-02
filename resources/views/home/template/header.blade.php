<header class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        <div class="text-2xl font-bold text-gray-800">
            <a href="/">
              Abbah Mitra<span class="text-indigo-600"> Global</span>
            </a>
        </div>          

        {{-- Desktop Menu --}}
        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            <a href="{{ url('/') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">HOME</a>
            <a href="{{ url('/#about') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">ABOUT US</a>
            <a href="{{ url('/#project') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">PROJECT</a>
            <a href="{{ url('/#team') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">TEAM</a>
            <a href="{{ url('/#services') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">SERVICES</a>
            <a href="{{ url('/#clients') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">CLIENTS</a>
            <a href="{{ url('/#contact') }}" class="nav-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">CONTACT US</a>
          </nav>          

        {{-- CTA Button --}}
        <a href="#contact" 
            class="hidden md:block bg-indigo-600 text-white px-4 py-2 rounded-lg 
                hover:bg-indigo-700 transform hover:scale-105 transition duration-300">
            Konsultasi Gratis
        </a>     

        {{-- Mobile Menu Button --}}
        <button id="menu-toggle" class="md:hidden text-gray-700 focus:outline-none text-2xl">
            ☰
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t shadow-lg transition-all duration-300">
        <nav class="flex flex-col p-4 space-y-3 text-sm font-medium">
            <a href="{{ url('/') }}" class="mobile-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">HOME</a>
            <a href="{{ url('/#about') }}" class="mobile-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">ABOUT US</a>
            <a href="{{ url('/#project') }}" class="mobile-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">PROJECT</a>
            <a href="{{ url('/#team') }}" class="mobile-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">TEAM</a>
            <a href="{{ url('/#services') }}" class="mobile-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">SERVICES</a>
            <a href="{{ url('/#clients') }}" class="mobile-link text-gray-700 hover:text-indigo-600 hover:font-bold transition-all">CLIENTS</a>
            <a href="{{ url('/#contact') }}" class="mobile-link bg-indigo-600 text-white px-4 py-2 rounded-lg text-center hover:bg-indigo-700 transition">
              Konsultasi Gratis
            </a>
          </nav>          
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const toggle = document.getElementById("menu-toggle");
        const menu = document.getElementById("mobile-menu");

        // Toggle Mobile Menu
        toggle.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        // Tutup menu mobile saat klik link
        document.querySelectorAll(".mobile-link").forEach(link => {
            link.addEventListener("click", () => {
                menu.classList.add("hidden");
            });
        });

        // Highlight menu saat scroll
        const sections = document.querySelectorAll("main section[id]");
        const navLinks = document.querySelectorAll(".nav-link");

        window.addEventListener("scroll", () => {
            let scrollPos = window.scrollY + 80; // offset header
            sections.forEach(section => {
                if(scrollPos >= section.offsetTop && scrollPos < section.offsetTop + section.offsetHeight){
                    navLinks.forEach(link => {
                        link.classList.remove("text-indigo-600", "font-bold");
                        if(link.getAttribute("href").substring(1) === section.id){
                            link.classList.add("text-indigo-600", "font-bold");
                        }
                    });
                }
            });
        });
    });
</script>

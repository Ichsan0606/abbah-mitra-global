<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="{{ asset('images/logo/logo.jpg') }}">
    <title>Abbah Mitra Global</title>
    @vite('resources/css/app.css') {{-- Tailwind --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
        .typewriter {
        display: inline-block;
        white-space: pre-line; /* supaya nl2br tetap jalan */
        overflow-wrap: break-word;
        
        /* border-right: .15em solid #4f46e5; cursor efek */
        }
        .typewriter.finished {
            border-right: none; /* cursor hilang setelah selesai */
        }
        .carousel-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out; /* efek fade */
        }
        .carousel-slide.active {
            opacity: 1;
            z-index: 1;
        }
    </style>    
</head>
<body class="font-sans text-gray-800">
    
    @include('home.template.header')

    <main class="pt-20">
        @yield('content')
    </main>

    @include('home.template.footer')

    <!-- Scroll Up Button -->
    <button id="scrollUpBtn" 
        class="hidden fixed bottom-6 right-6 bg-indigo-600 text-white p-3 rounded shadow-lg hover:bg-indigo-800 transition">
        <i class="fas fa-arrow-up"></i>
    </button>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                if(target) {
                    const headerOffset = 69; // tinggi header
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
    
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth"
                    });
                }
            });
        });
        
        //carousel animation
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const typingSpeed = 70; 
        const delayAfterTyping = 2000; 
        let typingTimeout;

        function typeWriter(textElement, text, callback) {
            let i = 0;
            textElement.textContent = ""; 
            function typing() {
                if (i < text.length) {
                    textElement.textContent += text.charAt(i);
                    i++;
                    typingTimeout = setTimeout(typing, typingSpeed);
                } else {
                    setTimeout(callback, delayAfterTyping);
                }
            }
            typing();
        }

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                // reset text setiap slide nonaktif
                const h2 = slide.querySelector("h2");
                if (h2) h2.textContent = h2.dataset.fulltext || h2.textContent;
            });

            const activeSlide = slides[index];
            activeSlide.classList.add('active');

            const textElement = activeSlide.querySelector("h2");
            if (textElement) {
                // simpan full text jika belum ada
                if (!textElement.dataset.fulltext) {
                    textElement.dataset.fulltext = textElement.textContent;
                }
                const fullText = textElement.dataset.fulltext;
                textElement.textContent = "";
                typeWriter(textElement, fullText, () => {
                    nextSlide();
                });
            }
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        document.addEventListener("DOMContentLoaded", () => {
            showSlide(currentSlide);
        });

        //end carousel animation

        //team-item
        document.addEventListener('DOMContentLoaded', () => {
            // Animasi Scroll untuk team
            const teamItems = document.querySelectorAll('.team-item');

            const teamObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    } else {
                        entry.target.classList.add('opacity-0', 'translate-y-10');
                        entry.target.classList.remove('opacity-100', 'translate-y-0');
                    }
                });
            }, { threshold: 0.2 });

            teamItems.forEach(item => teamObserver.observe(item));
        });

        //project-item
        document.addEventListener('DOMContentLoaded', () => {
            const items = document.querySelectorAll('.project-item');

            // Animasi Scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting){
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                    } else {
                        entry.target.classList.add('opacity-0', 'translate-y-10');
                        entry.target.classList.remove('opacity-100', 'translate-y-0');
                    }
                });
            }, { threshold: 0.2 });

            items.forEach(item => observer.observe(item));

            // Read More / Collapse
            document.querySelectorAll('.read-more').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const currentDesc = btn.previousElementSibling;

                    // Tutup semua card lain
                    document.querySelectorAll('.project-desc').forEach(desc => {
                        if(desc !== currentDesc){
                            const shortText = desc.dataset.full.split('.')[0] + '.';
                            desc.textContent = shortText;
                            desc.style.maxHeight = '3.5rem'; // versi pendek
                            const siblingBtn = desc.nextElementSibling;
                            if(siblingBtn && siblingBtn.classList.contains('read-more')){
                                siblingBtn.style.display = 'inline'; // tampilkan tombol Read More lagi
                            }
                        }
                    });

                    // Toggle current card
                    if(currentDesc.style.maxHeight === 'none'){
                        // collapse
                        currentDesc.textContent = currentDesc.dataset.full.split('.')[0] + '.';
                        currentDesc.style.maxHeight = '3.5rem';
                        btn.style.display = 'inline';
                    } else {
                        // expand
                        currentDesc.textContent = currentDesc.dataset.full;
                        currentDesc.style.maxHeight = 'none';
                        btn.style.display = 'none';
                    }
                });
            });
        });

        // Tampilkan tombol setelah scroll 200px
        const scrollUpBtn = document.getElementById('scrollUpBtn');
        window.addEventListener('scroll', () => {
            if(window.scrollY > 200){
                scrollUpBtn.classList.remove('hidden');
            } else {
                scrollUpBtn.classList.add('hidden');
            }
        });

        // Klik tombol scroll ke atas
        scrollUpBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        //end button scrollup
        
        //about-desc
        document.addEventListener("DOMContentLoaded", function() {
            const element = document.getElementById("about-desc");
            const text = `{{ $abouts->deskripsi ?? 'Deskripsi perusahaan belum tersedia.' }}`; // ambil dari DB / fallback

            let i = 0;
            function typeWriter() {
                if (i < text.length) {
                    element.innerHTML = text.substring(0, i+1);
                    i++;
                    setTimeout(typeWriter, 40); // kecepatan ketik
                } else {
                    element.classList.add("finished"); // hilangkan cursor setelah selesai
                }
            }
            typeWriter();
        });

        //team-desc-detail
        document.addEventListener("DOMContentLoaded", function() {
            const element = document.getElementById("desc");
            if (!element) return; // stop kalau tidak ada

            const rawText = `{!! e($team->deskripsi ?? 'Deskripsi team belum tersedia.') !!}`;
            const text = rawText.replace(/\n/g, "<br>");
            
            let i = 0;
            function typeWriter() {
                if (i < text.length) {
                    element.innerHTML = text.substring(0, i+1);
                    i++;
                    setTimeout(typeWriter, 40);
                } else {
                    element.classList.add("finished");
                }
            }
            typeWriter();
        });

        
        document.addEventListener("DOMContentLoaded", () => {
            const filterBtns = document.querySelectorAll(".filter-btn");
            const projects = document.querySelectorAll(".project-item");

            filterBtns.forEach(btn => {
                btn.addEventListener("click", () => {
                    const filter = btn.dataset.filter;

                    // toggle active button style
                    filterBtns.forEach(b => b.classList.remove("bg-indigo-600", "text-white"));
                    filterBtns.forEach(b => b.classList.add("bg-gray-200", "text-gray-800"));
                    btn.classList.add("bg-indigo-600", "text-white");

                    // filter projects
                    projects.forEach(item => {
                        if (filter === "all" || item.dataset.category === filter) {
                            item.style.display = "block";
                        } else {
                            item.style.display = "none";
                        }
                    });
                });
            });
        });

        const kategoriContainer = document.getElementById('kategoriContainer');
        const kategoriBtns = kategoriContainer.querySelectorAll('.filter-btn');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');

        let startIndex = 0;
        const perPage = 3; // tampil 3 tapi geser 1

        function renderKategori() {
            kategoriBtns.forEach((btn, index) => {
                btn.style.display = (index >= startIndex && index < startIndex + perPage) 
                    ? 'inline-flex' 
                    : 'none';
            });

            prevBtn.disabled = startIndex === 0;
            nextBtn.disabled = startIndex + perPage >= kategoriBtns.length;
        }

        prevBtn.addEventListener('click', () => {
            if (startIndex > 0) {
                startIndex--; // mundur 1
                renderKategori();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (startIndex + perPage < kategoriBtns.length) {
                startIndex++; // maju 1
                renderKategori();
            }
        });

        renderKategori();
    </script>
</body>
</html>

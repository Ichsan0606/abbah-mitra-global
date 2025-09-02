<footer class="bg-white mt-8">
    <div class="max-w-7xl mx-auto px-6 py-8 grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <!-- Tentang + Maps -->
      <div>
        <h2 class="text-xl font-bold mb-3">
          <a href="/">
            Abbah Mitra <span class="text-indigo-600">Global</span>
          </a>
        </h2>        
        <p class="text-sm mb-4">
          Membawa suasana baru dengan desain interior & eksterior modern, elegan, dan fungsional.
        </p>
        <!-- Maps -->
        {{-- <div class="w-full h-60 md:h-48"> --}}
        <div class="w-full h-60 md:h-48 rounded-lg overflow-hidden shadow-md transition-transform duration-300 hover:scale-[1.02] hover:shadow-xl">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.7458935118866!2d107.01867077659332!3d-6.297085761634342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69911b65b54df1%3A0xbd502fded1d1a15!2sABBAH%20MITRA%20GLOBAL!5e0!3m2!1sid!2sid!4v1755584745568!5m2!1sid!2sid" 
            width="100%" 
            height="100%" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>          
      </div>
  
      <!-- Navigasi -->
      <div>
        <h2 class="text-xl font-bold mb-3">Navigasi</h2>
        <ul class="space-y-2 text-sm">
          <li><a href="{{ url('/#about') }}" class="hover:text-indigo-600 hover:font-bold transition-all">Tentang Kami</a></li>
          <li><a href="{{ url('/#services') }}" class="hover:text-indigo-600 hover:font-bold transition-all">Layanan</a></li>
          <li><a href="{{ url('/#project') }}" class="hover:text-indigo-600 hover:font-bold transition-all">Project</a></li>
          <li><a href="{{ url('/#contact') }}" class="hover:text-indigo-600 hover:font-bold transition-all">Kontak</a></li>
        </ul>
      </div>      
  
      <!-- Kontak -->
      <div>
        <h2 class="text-xl font-bold mb-3">Kontak</h2>
        <ul class="space-y-2 text-sm">
          <li class="grid grid-cols-[auto_1fr] gap-x-2">
            <span class="font-medium">Email :</span>
            <a href="mailto:abbahmitraglobal@gmail.com" 
               class="hover:text-indigo-600 hover:font-bold transition-all">
               abbahmitraglobal@gmail.com
            </a>
          </li>
          <li class="grid grid-cols-[auto_1fr] gap-x-2">
            <span class="font-medium">Telp :</span>
            <a href="tel:+6287821334043" 
               class="hover:text-indigo-600 hover:font-bold transition-all">
               +62 878-2133-4043
            </a>
          </li>
          <li class="grid grid-cols-[auto_1fr] gap-x-2">
            <span class="font-medium">Alamat :</span>
            <a href="https://www.google.com/maps/place/ABBAH+MITRA+GLOBAL/@-6.2970858,107.0186708,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69911b65b54df1:0xbd502fded1d1a15!8m2!3d-6.2970911!4d107.0212457!16s%2Fg%2F11c74h4tpr?entry=ttu&g_ep=EgoyMDI1MDgxOS4wIKXMDSoASAFQAw%3D%3D"
               target="_blank"
               rel="noopener noreferrer"
               class="hover:text-indigo-600 hover:font-bold transition-all">
               Jl. Raya Ciketing Asem No.07, Mustikajaya, Bekasi Timur, Kota Bks, Jawa Barat 17158
            </a>
          </li>          
        </ul>       
        <div class="flex space-x-8 mt-4 text-xl">
          <a href="https://facebook.com" target="_blank" class="hover:text-indigo-600 transition-colors" aria-label="Facebook">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="https://www.instagram.com/abbahmitraglobal/" target="_blank" class="hover:text-indigo-600 transition-colors" aria-label="Instagram">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="http://www.tiktok.com/@abbahmitraglobal" target="_blank" class="hover:text-indigo-600 transition-colors" aria-label="TikTok">
            <i class="fab fa-tiktok"></i>
          </a>
          <a href="https://wa.me/6287821334043" target="_blank" class="hover:text-indigo-600 transition-colors" aria-label="WhatsApp">
            <i class="fab fa-whatsapp"></i>
          </a>
        </div>
      </div>
  
    </div>
  
    <!-- Copyright -->
    <div class="text-center py-4 border-t border-gray-200 text-sm mt-8">
      &copy; {{ date('Y') }} Abbah Mitra Global. All Rights Reserved.
    </div>
  </footer>
  
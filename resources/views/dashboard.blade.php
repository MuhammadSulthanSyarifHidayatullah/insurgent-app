<x-app-layout>
    <x-slot name="title">Dashboard | Partisan</x-slot>

    <!-- Warning Message Modal for Missing Address -->

    @auth
        @if (empty(auth()->user()->address) ||
                empty(auth()->user()->city) ||
                empty(auth()->user()->state) ||
                empty(auth()->user()->postal_code) ||
                empty(auth()->user()->country))
            <div class="bg-red-500 px-4 py-3 text-white">
                <p class="text-center text-sm font-medium">
                    Kamu Belum Mengisi Alamat Isi Sekarang di 
                    <a href="{{ route('profile.edit') }}" class="inline-block underline">Profile</a>
                </p>
            </div>
        @endif
    @endauth
    <!-- Hero Section -->
    <section class="relative bg-cover bg-center bg-no-repeat h-screen flex items-center"
        style="background-image: url('{{ asset('images/header-image.jpg') }}')">
        <div class="absolute inset-0 bg-gray-900/75 sm:bg-gradient-to-r sm:from-gray-900/95 sm:to-transparent"></div>

        <div class="relative mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8 z-2">
            <div class="max-w-xl text-center sm:text-left">
                <h1 class="text-3xl font-extrabold text-white sm:text-5xl">
                    Ayo Temukan Outfit
                    <strong class="block font-extrabold text-gray-500">
                        Favorit Mu.
                    </strong>
                </h1>

                <p class="mt-4 max-w-lg text-white sm:text-xl/relaxed">
                    Temukan gaya unik Anda dengan koleksi terbaru kami. Kualitas terbaik, harga terjangkau.
                </p>

                <div class="mt-8 flex flex-wrap gap-4 text-center sm:justify-start flex-grow-0">
                    <x-button-link href="{{ route('products.index') }}" class="w-full sm:w-auto bg-gray-800">
                        Belanja Sekarang
                    </x-button-link>
                    <x-button-link href="{{ route('about') }}" variant="secondary" class="w-full sm:w-auto">
                        Tentang Kami
                    </x-button-link>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100">
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-8">
                <div>
                    <div class="max-w-lg md:max-w-none">
                        <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                            Selamat datang di Partisan! Kami adalah merek fashion yang merayakan keberanian dan
                            keunikan.
                        </h2>

                        <p class="mt-4 text-gray-700">
                            Dengan koleksi yang dirancang untuk mengekspresikan gaya individu, kami
                            berkomitmen pada kualitas tinggi dan bahan ramah lingkungan. Visi kami adalah menjadi
                            pelopor dalam industri fashion yang mendukung keberagaman. Bergabunglah dengan kami untuk
                            menunjukkan siapa Anda dan berani tampil beda!
                        </p>
                    </div>
                </div>

                <div>
                    <img src="{{ asset('dashboard/image-1.jpg') }}" class="rounded" alt="">
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- Wave Separator -->
    <div class="bg-gray-100">
        <svg class="wave-top" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                    <g class="wave" fill="#1f2937">
                        <path d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z"></path>
                    </g>
                </g>
            </g>
        </svg>
    </div> --}}

    <!-- Features Section -->
    <section class="bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-12">Keunggulan Kami</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <x-feature-card image="fa-bolt-lightning" title="Cepat" color="text-yellow-500"
                    description="Pengiriman cepat ke seluruh Indonesia dengan jasa ekspedisi terpercaya." />
                <x-feature-card image="fa-money-bill" title="Murah" color="text-green-500"
                    description="Harga terjangkau dengan kualitas terbaik untuk kepuasan Anda." />
                <x-feature-card image="fa-square-check" title="Terpercaya" color="text-blue-500"
                    description="Ribuan pelanggan puas dengan pelayanan dan produk kami." />
                <x-feature-card image="fa-gift" title="Promo" color="text-red-500"
                    description="Dapatkan promo menarik setiap bulan untuk pembelian tertentu." />
                <x-feature-card image="fa-headset" title="Layanan Pelanggan" color="text-purple-500"
                    description="Tim layanan pelanggan kami siap membantu Anda 24/7." />
                <x-feature-card image="fa-recycle" title="Ramah Lingkungan" color="text-green-500"
                    description="Kami menggunakan bahan ramah lingkungan untuk produk kami." />
            </div>
        </div>
    </section>

    <!-- Wave Separator -->
    <div class="bg-white">
        <svg class="wave-down" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                    <g class="wave" fill="#f3f4f6">
                        <path
                            d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z">
                        </path>
                    </g>
                </g>
            </g>
        </svg>
    </div>

    <!-- FAQ Section -->
    <section class="bg-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-8">FAQ</h2>
            <div class="space-y-4">
                <x-faq-item question="Mengapa harus beli di Partisan?"
                    answer="Partisan menawarkan koleksi fashion terkini dengan harga terjangkau dan kualitas terbaik. Kami juga menyediakan layanan pelanggan yang responsif dan pengiriman cepat ke seluruh Indonesia." />
                <x-faq-item question="Apa keuntungan beli di Partisan?"
                    answer="Dengan berbelanja di Partisan, Anda mendapatkan akses ke tren fashion terbaru, harga kompetitif, dan program loyalitas pelanggan. Kami juga menawarkan garansi kepuasan dan kebijakan pengembalian yang fleksibel." />
                <x-faq-item question="Bagaimana cara membeli produk di Partisan?"
                    answer="Anda dapat membeli produk di Partisan dengan mengunjungi website kami di www.partisan.com. Pilih produk yang Anda inginkan, tambahkan ke keranjang belanja, dan selesaikan pembayaran. Kami akan mengirimkan produk pesanan Anda ke alamat yang Anda tentukan." />
                <x-faq-item question="Apakah produk di Partisan ramah lingkungan?"
                    answer="Kami berkomitmen untuk menggunakan bahan ramah lingkungan dalam produksi produk kami. Kami juga mendukung gerakan zero waste dan daur ulang." />
                <x-faq-item question="Apakah Partisan menyediakan layanan pengiriman internasional?"
                    answer="Saat ini, Partisan hanya menyediakan layanan pengiriman di dalam wilayah Indonesia. Kami sedang berupaya untuk dapat melayani pengiriman internasional di masa mendatang." />
                <x-faq-item question="Apakah Partisan memiliki toko fisik?"
                    answer="Saat ini, Partisan hanya beroperasi secara online melalui website kami. Namun, kami berencana untuk membuka toko fisik di beberapa kota besar di Indonesia di masa mendatang." />
            </div>
        </div>
    </section>


    <div class="">
        <svg class="wave-down" viewBox="0 0 1439 147" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-1.000000, -14.000000)" fill-rule="nonzero">
                    <g class="wave" fill="#ffffff">
                        <path
                            d="M1440,84 C1383.555,64.3 1342.555,51.3 1317,45 C1259.5,30.824 1206.707,25.526 1169,22 C1129.711,18.326 1044.426,18.475 980,22 C954.25,23.409 922.25,26.742 884,32 C845.122,37.787 818.455,42.121 804,45 C776.833,50.41 728.136,61.77 713,65 C660.023,76.309 621.544,87.729 584,94 C517.525,105.104 484.525,106.438 429,108 C379.49,106.484 342.823,104.484 319,102 C278.571,97.783 231.737,88.736 205,84 C154.629,75.076 86.296,57.743 0,32 L0,0 L1440,0 L1440,84 Z">
                        </path>
                    </g>
                </g>
            </g>
        </svg>
    </div>


    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#d1d5db" fill-opacity="1"
            d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
        </path>
    </svg>
    <footer class="bg-gray-300">
        <div class="mx-auto max-w-5xl px-4 pb-16 bg-gray-300 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <x-application-logo class="h-32"></x-application-logo>
            </div>

            <p class="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Incidunt consequuntur amet culpa cum
                itaque neque.
            </p>

            <ul class="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:gap-12">
                <li>
                    <a class="text-gray-700 transition hover:text-gray-700/75" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a class="text-gray-700 transition hover:text-gray-700/75" href="{{ route('about') }}"> About Us
                    </a>
                </li>

                <li>
                    <a class="text-gray-700 transition hover:text-gray-700/75" href="{{ route('products.index') }}">
                        Product
                    </a>
                </li>


            </ul>
        </div>
    </footer>

</x-app-layout>

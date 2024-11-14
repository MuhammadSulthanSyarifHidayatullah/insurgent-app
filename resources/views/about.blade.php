<x-app-layout>
    <x-slot name="title">About | Partisan</x-slot>
    <section>
        <div class="mx-auto max-w-screen-2xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="bg-gray-600 p-8 md:p-12 lg:px-16 lg:py-24 rounded-md shadow-md">
                    <div class="mx-auto max-w-xl text-center">
                        <h2 class="text-2xl font-bold text-white md:text-3xl">
                            Tentang Kami - PARTISAN
                        </h2>

                        <p class="hidden text-white/90 sm:mt-4 sm:block">
                            Selamat datang di Partisan! Kami adalah merek fashion yang merayakan keberanian dan
                            keunikan. Dengan koleksi yang dirancang untuk mengekspresikan gaya individu, kami
                            berkomitmen pada kualitas tinggi dan bahan ramah lingkungan. Visi kami adalah menjadi
                            pelopor dalam industri fashion yang mendukung keberagaman. Bergabunglah dengan kami untuk
                            menunjukkan siapa Anda dan berani tampil beda!
                        </p>

                        <div class="mt-4 md:mt-8">
                            <a href="#about">
                                <x-secondary-button>SELENGKAPNYA</x-secondary-button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-1 lg:grid-cols-2">
                    <img alt="" src="{{ asset('images/about-image-1.jpg') }}"
                        class="h-40 w-full object-cover sm:h-56 md:h-full rounded-md shadow-md" />

                    <img alt="" src="{{ asset('images/about-image-2.jpg') }}"
                        class="h-40 w-full object-cover sm:h-56 md:h-full rounded-md shadow-md" />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 bg-gray-600 rounded-md shadow-md mt-5" id="about">
                <div class="mx-auto max-w-5xl text-center mt-5 md:w-[80%] sm:w-[80%]">
                    <h2 class="text-2xl font-bold text-white md:text-3xl">
                        TENTANG KAMI
                    </h2>

                    <p class=" text-white/90 sm:mt-4 sm:block px-5">
                        Selamat datang di Partisan, merek fashion yang mengusung semangat kebebasan dan keberanian. Di
                        Partisan, kami percaya bahwa pakaian bukan hanya sekadar bahan yang menutupi tubuh, tetapi juga
                        merupakan pernyataan diri. Kami hadir untuk mereka yang berani tampil beda, mengungkapkan
                        kepribadian, dan mengekspresikan gaya unik mereka.
                        <br>
                        Didirikan oleh sekelompok desainer dan penggemar fashion yang berkomitmen untuk menghadirkan
                        produk berkualitas tinggi, setiap koleksi Partisan dirancang dengan penuh perhatian terhadap
                        detail dan keunikan. Kami menggunakan bahan-bahan terbaik dan ramah lingkungan, memastikan bahwa
                        setiap potong baju tidak hanya nyaman dipakai, tetapi juga berkelanjutan.
                        <br>
                        <span>
                            <b>Visi kami</b> adalah menjadi pelopor dalam industri fashion yang merayakan keberagaman
                            dan
                            kreativitas, menjadikan setiap individu merasa bangga dengan gaya mereka sendiri.
                        </span>

                        <span>
                            <br>
                            <b>Misi kami</b> meliputi:
                            <ul class="list-disc text-white/90 sm:mt-4 sm:block px-5 text-start">
                                <li>Kualitas Tinggi: Menyediakan produk berkualitas terbaik dengan bahan yang nyaman dan
                                    ramah lingkungan.</li>
                                <li>Desain Unik: Menciptakan koleksi yang mencerminkan inovasi dan keunikan, memberi
                                    kesempatan bagi pelanggan untuk mengekspresikan diri.</li>
                                <li>Komunitas Kreatif: Membangun komunitas yang mendukung dan merayakan keberagaman
                                    dalam fashion, menginspirasi orang untuk berani tampil beda.</li>
                                <li>Keberlanjutan: Berkomitmen pada praktik ramah lingkungan dan berkelanjutan dalam
                                    setiap langkah produksi kami.</li>
                            </ul>
                        </span>
                    </p>
                    <p class="text-white/90 sm:mt-4 sm:block px-5">
                        Jelajahi koleksi kami dan temukan gaya yang mencerminkan siapa Anda. Bersama Partisan, tunjukkan
                        bahwa Anda adalah seorang partisan sejati dalam dunia fashion!
                    </p>

                    <div class="mt-4 md:mt-8">
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

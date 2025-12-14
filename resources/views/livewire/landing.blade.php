<div>
    <!-- Navbar -->
    <livewire:components.navbar />
    <!-- endnavbar -->


    <!-- Section -->
    <section id="beranda" class="text-white min-h-screen flex items-center"
        style="background-image: 
                    linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3)),
                    url('https://i.pinimg.com/736x/58/58/dc/5858dc7045e206305cba80341ce0b00a.jpg');
                    background-size: cover;
                    background-position: center;">
        <div class="max-w-7xl mx-auto px-10 sm:px-6 lg:px-8 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-16 lg:py-0">
                <!-- isi-->
                <div class="space-y-6">
                    <h1 class=" sm:text-4xl md:text-5xl lg:text-6xl">
                        <strong>Wujudkan <em>Kreativitas</em> Tanpa Batas</strong>
                    </h1>

                    <p class="text-xl lg:text-2xl text-gray-200">
                        <em>
                            Platform untuk para pengguna berbagi karya, mendapat apresiasi,
                            dan membangun jaringan kreatif Indonesia.
                        </em>
                    </p>

                    <div class="flex flex-col md:flex-row sm:flex gap-4 pt-4">
                        @auth
                        <a href="{{ route('kreasi.create') }}"
                            class="text-center border-2 border-white text-white px-8 py-3 rounded-full font-semibold bg-white/10 hover:bg-white hover:text-primary transition duration-300">
                            Mulai Berkarya
                        </a>
                        @else
                        <button
                            onclick="Livewire.dispatch('openRegisterModal')"
                            class="text-center border-2 border-white text-white px-8 py-3 rounded-full font-semibold bg-white/10 hover:bg-white hover:text-primary transition duration-300">
                            Mulai Berkarya
                        </button>
                        @endauth

                        <a href="#jelajah"
                            class="text-center border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-primary transition duration-300">
                            Jelajahi Karya
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="order-first lg:order-last flex justify-center items-center">
                    <div class="w-full max-w-md bg-white/10 backdrop-blur-sm rounded-full shadow-8xl overflow-hidden aspect-square border-5">
                        <img src="https://i.pinimg.com/736x/58/58/dc/5858dc7045e206305cba80341ce0b00a.jpg"
                            alt="Ilustrasi Wayang Kreativitas"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- tentang kami -->
    <section id="tentang" class="py-20 px-13 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-12">
                <h2 class="text-4xl font-bold text-gray-50 mb-4">Tentang Kami</h2>
                <p class="text-xl text-gray-50 font-serif px-90">Platform Kreatif untuk Semua Rakyat Indonesia</p>
            </div>

            <!-- visi -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <div class="bg-white p-10 rounded-lg shadow-lg">
                    <h3 class="text-center text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                    <p class="text-gray-600 leading-relaxed font-serif">
                        Menjadi platform terdepan di Indonesia yang menghubungkan para pengguna
                        untuk saling menghargai dan mendukung karya kreatif mereka.
                    </p>
                </div>

                <!-- Misi -->
                <div class="bg-white p-10 rounded-lg shadow-lg">
                    <h3 class="text-center text-2xl font-bold text-gray-900 mb-4">Misi Kami</h3>
                    <ul class="space-y-3 text-gray-600 font-serif">
                        <li class="flex items-start">
                            <span>1. Memberikan ruang bagi pengguna untuk memamerkan hasil karya</span>
                        </li>
                        <li class="flex items-start">
                            <span>2. Membangun relasi antar pengguna kreatif yang saling mendukung</span>
                        </li>
                        <li class="flex items-start">
                            <span>3. Meningkatkan apresiasi terhadap karya lokal</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- endtenatngkami -->

    


    <!-- section search,tag dan karyanya -->
    <section id="jelajah" class="py-12 bg-gray-50">
        <div class="text-center mb-12 font-serif">
            <h2 class="text-4xl font-bold mb-4  text-black uppercase">Jelajahi Karya</h2>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row justify-between items-end gap-6">

                <div class="w-full md:w-1/2">
                    <label for="search" class="block text-sm font-bold text-gray-900 mb-3 ml-1">
                        Cari Karya
                    </label>
                    <div class="relative shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input
                            id="search"
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Tulis nama Karya..."
                            class="block w-full pl-11 pr-4 py-3 bg-white border border-gray-300 rounded-lg 
                               text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-blue-900 
                               transition duration-150 ease-in-out sm:text-sm">
                    </div>
                </div>

                <div class="w-full md:w-1/3">
                    <label for="tagFilter" class="block text-sm font-bold text-gray-900 mb-3 ml-1">
                        Filter Berdasarkan Tag
                    </label>

                    <div class="relative">
                        <select
                            id="tagFilter"
                            wire:model.live="tagFilter"
                            class="block w-full pl-4 pr-10 py-3 text-base border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-blue-900 sm:text-sm rounded-lg shadow-sm bg-white text-gray-700 cursor-pointer">
                            <option value="">Semua Karya</option>

                            @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->nama_tag }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- karya -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mt-4">Karya - karya</h2>
            </div>

            @if ($kreasis->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($kreasis as $kreasi)
                @include('livewire.partials.kreasi-card', ['kreasi' => $kreasi])
                @endforeach
            </div>

            <div class="mt-8">
                {{ $kreasis->links() }}
            </div>
            @else
            <div class="text-center py-12">
                <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Belum ada kreasi</p>
            </div>
            @endif
        </div>
    </section>
    <!-- end -->

    <!-- faq -->
    <section id="faq" class="bg-gray-900 py-20 text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 ">FAQ</h2>
                <p class="text-gray-50 font-mono text-lg ">Pertanyaan yang sering diajukan oleh pengguna</p>
            </div>

            <div class="space-y-6 text-center">

                <!-- 1 -->
                <div id="upload" class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                    <h3 class="text-xl font-semibold mb-2">Bagaimana cara upload karya?</h3>
                    <p class="text-gray-400">
                        Kamu bisa upload karya dengan menekan tombol <strong>“Mulai Berkarya”</strong> di halaman utama
                        atau dari menu Dashboard setelah login.
                    </p>
                </div>

                <!-- 2 -->
                <div id="gratis" class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                    <h3 class="text-xl font-semibold mb-2">Apakah penggunaan platform ini gratis?</h3>
                    <p class="text-gray-400">
                        Website ini disediakan semua fitur utama di PojokKaarya dapat digunakan secara gratis oleh seluruh pengguna.
                    </p>
                </div>

                <!-- 3 -->
                <div id="rating" class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                    <h3 class="text-xl font-semibold mb-2">Bagaimana cara memberikan rating pada karya?</h3>
                    <p class="text-gray-400">
                        Kamu bisa memberi rating pada suatu karya dengan memilih jumlah bintang yang tersedia
                        di halaman detail karya tersebut.
                    </p>
                </div>

                <!-- 4 -->
                <div id="bookmark" class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
                    <h3 class="text-xl font-semibold mb-2">Bagaimana cara menyimpan karya ke bookmark?</h3>
                    <p class="text-gray-400">
                        Pada kartu karya atau halaman detail, kamu dapat menekan ikon <strong>Bookmark</strong>
                        untuk menyimpan karya ke daftar favoritmu.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- endfaq -->

    <!-- Footer -->
    <livewire:components.footer />
    <!-- endFooter -->



    <!-- Scripts -->
    <script>
        function toggleMobileNav() {
            const nav = document.getElementById('mobileNav');
            nav.classList.toggle('hidden');
        }
    </script>
</div>
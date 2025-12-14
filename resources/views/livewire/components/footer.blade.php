<footer class="bg-gray-800 text-white py-14 text-center">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <!-- Grid utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                <!-- Brand -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">PojokKaarya</h3>
                    <p class="text-gray-400 leading-relaxed">
                        Platform untuk para pengguna berbagi karya,<br>
                        saling menginspirasi satu sama lain.
                    </p>
                </div>

                <!-- Navigasi -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('landing') }}#beranda" class="hover:text-white">Beranda</a></li>
                        <li><a href="{{ route('landing') }}#jelajah" class="hover:text-white">Jelajah Karya</a></li>
                        <li><a href="{{ route('landing') }}#tentang" class="hover:text-white">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- FAQ -->
                <div>
                    <h4 class="text-lg font-semibold mb-4"><a href="#faq">FAQ</a></h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('landing') }}#upload" class="hover:text-white">Bagaimana cara upload karya?</a></li>
                        <li><a href="{{ route('landing') }}#gratis" class="hover:text-white">Apakah penggunaan platfrom gratis?</a></li>
                        <li><a href="{{ route('landing') }}#rating" class="hover:text-white">Bagaimana cara memberikan rating pada karya?</a></li>
                        <li><a href="{{ route('landing') }}#bookmark" class="hover:text-white">Bagaimana cara memberikan bookmark pada karya?</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>info@pojokkaarya.id</li>
                        <li>+62 812-3456-7890</li>
                        <li>Bekasi, Indonesia</li>
                    </ul>
                </div>

            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-12 pt-6 text-center text-gray-400">
                <p>&copy; 2024 PojokKaarya. Dibuat oleh Naimah.</p>
            </div>

        </div>
    </footer>
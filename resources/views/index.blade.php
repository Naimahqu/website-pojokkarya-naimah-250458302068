
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PojokKaarya - Platform Karya Kreatif Indonesia</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite Assets (Tailwind CSS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-primary to-secondary sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="#" class="text-2xl font-bold text-white">🎨 PojokKaarya</a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-6">
                    <div class="relative">
                        <div class="flex items-center bg-white/20 backdrop-blur-sm rounded-full px-4 py-1">
                            <i class="fas fa-search text-white/80 mr-2"></i>
                            <input type="text" placeholder="Cari tag..." class="bg-transparent text-white placeholder-white/80 outline-none border-none focus:border-none focus:outline-none focus:ring-0 w-48">
                        </div>
                    </div>

                    <div class="flex items-center space-x-6">
                        <a href="#beranda" class="text-white hover:text-gray-300 transition">Beranda</a>
                        <a href="#jelajah" class="text-white hover:text-gray-300 transition">Jelajah</a>
                        <button onclick="Livewire.dispatch('openLoginModal')" class="text-white hover:text-gray-300 transition">Masuk</button>
                        <button onclick="Livewire.dispatch('openRegisterModal')" class="bg-accent text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">Daftar</button>
                    </div>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-white text-xl">
                    <i class="fas fa-bars"></i>.
                </button>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-primary to-secondary text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight">
                        Wujudkan Kreativitas Tanpa Batas
                    </h1>
                    <p class="text-xl text-gray-300">
                        Platform untuk para kreator berbagi karya, mendapat apresiasi, dan membangun jaringan dengan komunitas kreatif Indonesia
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="Livewire.dispatch('openRegisterModal')" class="bg-accent text-white px-8 py-3 rounded-full hover:bg-blue-700 transition transform hover:-translate-y-1">
                            Mulai Berkarya
                        </button>
                        <a href="#jelajah" class="border-2 border-white text-white px-8 py-3 rounded-full hover:bg-white hover:text-primary transition transform hover:-translate-y-1 text-center">
                            Jelajahi Karya
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="flex justify-center">
                    <div class="w-full max-w-md h-80 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center overflow-hidden">
                        <img src="https://i.pinimg.com/736x/58/58/dc/5858dc7045e206305cba80341ce0b00a.jpg" alt="Hero Illustration" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section id="jelajah" class="bg-gray-100 py-8 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <h3 class="text-gray-600 font-medium">📑 Filter Berdasarkan Tag:</h3>
            </div>
            <div class="flex flex-wrap gap-3">
                <button class="tag-filter bg-accent text-white px-4 py-2 rounded-full text-sm font-medium transition" data-tag="semua">
                    Semua Karya
                </button>
                <button class="tag-filter bg-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium border border-gray-300 hover:border-accent transition" data-tag="fotografi">
                    📷 Fotografi
                </button>
                <button class="tag-filter bg-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium border border-gray-300 hover:border-accent transition" data-tag="seni-lukis">
                    🎭 Seni Lukis
                </button>
                <button class="tag-filter bg-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium border border-gray-300 hover:border-accent transition" data-tag="craft">
                    ✂️ Craft & DIY
                </button>
                <button class="tag-filter bg-white text-gray-700 px-4 py-2 rounded-full text-sm font-medium border border-gray-300 hover:border-accent transition" data-tag="digital-art">
                    💻 Digital Art
                </button>
            </div>
        </div>
    </section>

    <!-- Kreasi Gallery -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 sm:mb-0">Karya Terbaru Komunitas</h2>
                <div class="flex space-x-2">
                    <button class="toggle-view bg-accent text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        🔥 Terbaru
                    </button>
                    <button class="toggle-view bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition">
                        ⭐ Populer
                    </button>
                </div>
            </div>

            <!-- Kreasi Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="kreasiGrid">

                <!-- Fotografi Cards -->
                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="fotografi">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-600 rounded-t-xl overflow-hidden">
                            <img src="https://i.pinimg.com/736x/e4/3c/01/e43c01c62863509d639c632ebeaf21b0.jpg" alt="Urban Life Series" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Fotografi
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    SN
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">189</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">21</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="fotografi">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-t-xl overflow-hidden">
                            <img src="https://i.pinimg.com/736x/8a/8b/6d/8a8b6d7c8c7e8e8e8e8e8e8e8e8e8e8e.jpg" alt="Nature Photography" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Fotografi
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    RA
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">245</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">34</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="fotografi">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-t-xl overflow-hidden">
                            <img src="https://i.pinimg.com/736x/9a/9b/9c/9a9b9c9d9e9f9a9b9c9d9e9f9a9b9c9d.jpg" alt="Street Photography" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Fotografi
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    FA
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">178</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">29</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seni Lukis Cards -->
                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="seni-lukis">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-red-400 to-orange-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🎨</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Seni Lukis
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    DK
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">278</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">38</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="seni-lukis">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-pink-400 to-rose-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🖼️</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Seni Lukis
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    AS
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">312</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">45</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="seni-lukis">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-yellow-400 to-amber-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🖌️</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Seni Lukis
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    BW
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">195</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">27</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Craft & DIY Cards -->
                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="craft">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-green-400 to-teal-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🏺</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Craft & DIY
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    RP
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">156</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">19</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="craft">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-emerald-400 to-green-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🧵</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Craft & DIY
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    LS
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">223</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">31</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="craft">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-lime-400 to-green-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">📦</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Craft & DIY
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    DW
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">187</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">24</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Digital Art Cards -->
                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="digital-art">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-pink-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">💻</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Digital Art
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    LP
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">367</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">54</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="digital-art">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-violet-400 to-purple-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🎮</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Digital Art
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    AR
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">298</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">42</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>j
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="digital-art">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-fuchsia-400 to-pink-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🖥️</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Digital Art
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    DN
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">276</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">38</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>j
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Categories -->
                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="animasi">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-yellow-400 to-red-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🎬</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Animasi
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    FR
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">423</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">67</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kreasi-card bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer" data-tag="ilustrasi">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-pink-400 to-rose-500 rounded-t-xl flex items-center justify-center">
                            <span class="text-6xl">🌸</span>
                        </div>
                        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-semibold text-primary">
                            Ilustrasi
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-primary to-secondary rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    MH
                                </div>
                            </div>
                            <div class="kreasi-actions flex space-x-2">
                                <button class="action-btn like-btn text-gray-400 hover:text-red-500 transition" onclick="toggleLike(this)">
                                    <i class="far fa-heart"></i>
                                    <span class="text-xs ml-1">291</span>
                                </button>
                                <button class="action-btn text-gray-400 hover:text-blue-500 transition">
                                    <i class="far fa-comment"></i>
                                    <span class="text-xs ml-1">41</span>
                                </button>
                                <button class="action-btn bookmark-btn text-gray-400 hover:text-yellow-500 transition" onclick="toggleBookmark(this)">
                                    <i class="far fa-bookmark"></i>.
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <h3 class="text-accent text-xl font-bold mb-4">🎨 PojokKaarya</h3>
                    <p class="text-gray-400">
                        Platform untuk para kreator berbagi karya, menemukan inspirasi, dan membangun komunitas kreatif Indonesia.
                    </p>
                </div>

                <!-- Navigation -->
                <div>
                    <h4 class="font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#beranda" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#jelajah" class="hover:text-white transition">Jelajah Karya</a></li>
                        <li><a href="#komunitas" class="hover:text-white transition">Komunitas</a></li>
                        <li><a href="#tentang" class="hover:text-white transition">Tentang Kami</a></li>
                    </ul>
                </div>

                <!-- Help -->
                <div>
                    <h4 class="font-semibold mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#faq" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#panduan" class="hover:text-white transition">Panduan Pengguna</a></li>
                        <li><a href="#privasi" class="hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#syarat" class="hover:text-white transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>📧 info@pojokkaarya.id</li>
                        <li>📱 +62 812-3456-7890</li>
                        <li>📍 Bekasi, West Java, Indonesia</li>
                        <li class="flex space-x-4 mt-3 text-xl">
                            <a href="#" class="hover:text-white transition">📘</a>
                            <a href="#" class="hover:text-white transition">📷</a>
                            <a href="#" class="hover:text-white transition">🐦</a>
                            <a href="#" class="hover:text-white transition">💼</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PojokKaarya. Dibuat dengan ❤️ oleh Naimah | TRPL B</p>
            </div>
        </div>
    </footer>

    <!-- Livewire Auth Modals -->
    @livewire('auth.login-modal')
    @livewire('auth.register-modal')

    <script>
        // Like functionality
        function toggleLike(button) {
            const icon = button.querySelector('i');
            const countSpan = button.querySelector('span');
            let count = parseInt(countSpan.textContent);

            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-red-500');
                countSpan.textContent = count + 1;
            } else {
                icon.classList.remove('fas', 'text-red-500');
                icon.classList.add('far');
                countSpan.textContent = count - 1;
            }
        }

        // Bookmark functionality
        function toggleBookmark(button) {
            const icon = button.querySelector('i');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas', 'text-yellow-500');
            } else {
                icon.classList.remove('fas', 'text-yellow-500');
                icon.classList.add('far');
            }
        }

        // Filter functionality
        document.querySelectorAll('.tag-filter').forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.tag-filter').forEach(btn => {
                    btn.classList.remove('bg-accent', 'text-white');
                    btn.classList.add('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                });

                // Add active class to clicked button
                this.classList.remove('bg-white', 'text-gray-700', 'border', 'border-gray-300');
                this.classList.add('bg-accent', 'text-white');

                const tag = this.getAttribute('data-tag');
                filterKreasi(tag);
            });
        });

        function filterKreasi(tag) {
            const cards = document.querySelectorAll('.kreasi-card');

            cards.forEach(card => {
                if (tag === 'semua' || card.getAttribute('data-tag') === tag) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // View toggle functionality
        document.querySelectorAll('.toggle-view').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.toggle-view').forEach(btn => {
                    btn.classList.remove('bg-accent', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                });

                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-accent', 'text-white');
            });
        });
    </script>
</body>
</html>

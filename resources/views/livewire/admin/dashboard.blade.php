<div>
    <!-- Welcome Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h2>
        <p class="text-gray-600">Berikut adalah ringkasan aktivitas platform PojokKaarya.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
        <!-- Total Users -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#0f3460]">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-[#0f3460] text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Kreasi -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Kreasi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_kreasi'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-images text-green-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Tags -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Tag</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['total_tags'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-tags text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Kreasi Hari Ini -->
        <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Kreasi Hari Ini</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['kreasi_today'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-calendar-plus text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>


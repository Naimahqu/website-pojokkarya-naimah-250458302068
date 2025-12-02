<div>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-600">Kelola kreasi dan profil Anda di sini</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Total Kreasi -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-full">
                    <i class="fas fa-images text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Kreasi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalKreasi }}</p>
                </div>
            </div>
        </div>

        <!-- Total Likes -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-full">
                    <i class="fas fa-heart text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Likes</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalLikes }}</p>
                </div>
            </div>
        </div>

        <!-- Total Followers -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <i class="fas fa-users text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Followers</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $totalFollowers }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


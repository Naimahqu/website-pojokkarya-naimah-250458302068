<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengikut Saya</h1>
        <p class="text-gray-600">{{ $totalFollowers }} orang mengikuti kamu</p>
    </div>

    @if($followers->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($followers as $follower)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4">
                        <!-- Avatar Follower -->
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg shadow">
                            {{ strtoupper(substr($follower->name, 0, 1)) }}
                        </div>
                        
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $follower->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $follower->email }}</p>
                        </div>

                        <!-- Button Lihat Profile -->
                        <a href="" 
                           class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>

                    <!-- Info Tambahan -->
                    <div class="mt-3 pt-3 border-t border-gray-200">
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>
                                <i class="fas fa-images mr-1"></i>
                                {{ $follower->kreasi()->count() }} Kreasi
                            </span>
                            <span>
                                <i class="fas fa-users mr-1"></i>
                                {{ $follower->followers()->count() }} Pengikut
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $followers->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-users text-gray-400 text-6xl mb-4"></i>
            <p class="text-gray-600">Belum ada yang follow kamu</p>
            <p class="text-sm text-gray-500 mt-2">Upload kreasi menarik untuk mendapatkan pengikut!</p>
        </div>
    @endif
</div>
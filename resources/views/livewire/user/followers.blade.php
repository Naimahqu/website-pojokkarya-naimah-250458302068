<div class="space-y-6">
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-800">Daftar Pengikut</h3>
        <p class="text-sm text-gray-500">
            {{ auth()->check() && auth()->id() === $userId ? ($totalFollowers . ' orang mengikuti Anda') : ($totalFollowers . ' orang mengikuti kreator ini') }}
        </p>
    </div>

    @if($followers->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($followers as $follower)
                <div class="bg-white rounded-xl border border-gray-200 p-4 hover:shadow-md transition duration-200 shadow-sm flex items-center justify-between">
                    <a href="{{ route('profile', $follower->id) }}" class="flex items-center space-x-3.5 min-w-0 hover:opacity-80 transition duration-150 group">
                        <!-- Avatar Follower -->
                        <div class="w-11 h-11 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold text-base shadow-sm border border-gray-100 flex-shrink-0">
                            {{ strtoupper(substr($follower->name, 0, 1)) }}
                        </div>
                        
                        <div class="min-w-0">
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base truncate group-hover:underline">{{ $follower->name }}</h3>
                            <p class="text-xs text-gray-500 truncate">{{ $follower->email }}</p>
                        </div>
                    </a>

                    <!-- Follower stats/info -->
                    <div class="text-right text-xs text-gray-500 flex flex-col space-y-1">
                        <span class="inline-flex items-center justify-end font-semibold text-gray-700">
                            <i class="fas fa-images mr-1 text-blue-500"></i>
                            {{ $follower->kreasi()->count() }}
                        </span>
                        <span class="text-[10px] text-gray-400">kreasi</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-4">
            {{ $followers->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center max-w-md mx-auto shadow-sm">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Belum Ada Pengikut</h3>
            <p class="text-gray-500 text-sm">
                {{ auth()->check() && auth()->id() === $userId ? 'Bagikan kreasi unik Anda secara rutin untuk menarik pengikut baru!' : 'Kreator belum memiliki pengikut.' }}
            </p>
        </div>
    @endif
</div>
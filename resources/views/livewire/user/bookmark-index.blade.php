<div class="space-y-6">
    <!-- Header Controls -->
    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <!-- Search bar -->
        <div class="relative w-full sm:max-w-xs shadow-sm">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-search text-gray-400 text-sm"></i>
            </div>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Cari disimpian..."
                   class="block w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition duration-150">
        </div>
    </div>

    @if(session('success'))
        <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg flex items-center text-green-700 text-sm font-medium" role="alert">
            <i class="fas fa-check-circle mr-2 text-green-500 text-base"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Home-Page Aligned Card Grid -->
    @if($bookmarks->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($bookmarks as $bookmark)
                @php
                    $kreasi = $bookmark->kreasi; 
                    if (!$kreasi) continue; 
                @endphp
                @include('livewire.partials.kreasi-card', ['kreasi' => $kreasi])
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pt-6">
            {{ $bookmarks->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center max-w-md mx-auto shadow-sm">
            <div class="w-16 h-16 mx-auto mb-4 bg-gray-50 rounded-full flex items-center justify-center">
                <i class="far fa-bookmark text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-1">Daftar Bookmark Kosong</h3>
            <p class="text-gray-500 text-sm">
                {{ auth()->check() && auth()->id() === $userId ? 'Saatnya jelajahi dan simpan kreasi favorit Anda!' : 'Kreator belum menyimpan kreasi apapun.' }}
            </p>
        </div>
    @endif
</div>
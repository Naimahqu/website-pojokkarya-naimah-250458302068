<?php

namespace App\Livewire\Admin;

use App\Livewire\Actions\Logout;
use App\Models\Kreasi;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public array $stats = [];
    public array $chartData = [];

    public function mount(): void
    {
        $this->stats = [
            'total_users' => User::count(),
            'total_kreasi' => Kreasi::count(),
            'total_tags' => Tag::count(),
            'kreasi_today' => Kreasi::whereDate('created_at', today())->count(),
        ];

        // Data kreasi 7 hari terakhir
        $this->chartData = $this->getKreasiLast7Days();
    }

    private function getKreasiLast7Days(): array
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('d M');
            $data[] = Kreasi::whereDate('created_at', $date)->count();
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin', ['title' => 'Dashboard']);
    }

   
}


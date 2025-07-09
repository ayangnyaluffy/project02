<x-filament::page>
    <div class="space-y-6">
        <h2 class="text-2xl font-bold">Halo, {{ auth('mahasiswa')->user()->name }}! 👋</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <x-filament::card>
                <div class="text-sm text-gray-500">Checklist Kamu</div>
                <div class="text-3xl font-bold">
                    {{ \App\Models\Checklist::where('user_id', auth('mahasiswa')->id())->count() }}
                </div>
                <div class="text-xs text-gray-400">Total checklist milikmu</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-sm text-gray-500">Sudah Dibawa</div>
                <div class="text-3xl font-bold">
                    {{ \App\Models\Item::whereHas('checklist', fn($q) => $q->where('user_id', auth('mahasiswa')->id()))->where('is_checked', true)->count() }}
                </div>
                <div class="text-xs text-green-500">Barang yang sudah dicek</div>
            </x-filament::card>

            <x-filament::card>
                <div class="text-sm text-gray-500">Belum Dibawa</div>
                <div class="text-3xl font-bold">
                    {{ \App\Models\Item::whereHas('checklist', fn($q) => $q->where('user_id', auth('mahasiswa')->id()))->where('is_checked', false)->count() }}
                </div>
                <div class="text-xs text-red-500">Barang yang belum dicek</div>
            </x-filament::card>
        </div>
    </div>
</x-filament::page>

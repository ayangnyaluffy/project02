<x-filament::page>
    <form method="POST" action="{{ route('mahasiswa.checklist.update') }}">
        @csrf

        @foreach ($checklists as $checklist)
            <div class="mb-6 p-4 bg-white rounded-lg shadow-sm border">
                <h3 class="text-lg font-bold text-gray-800 mb-4">
                    {{ ucfirst($checklist->title) }}
                </h3>

                @php
                    $itemsByKategori = $checklist->items->groupBy('kategori');
                @endphp

                @foreach ($itemsByKategori as $kategori => $items)
                    <div x-data="{ open: false }" class="mb-4 border rounded-md">
                        <button type="button"
                            @click="open = !open"
                            class="w-full px-4 py-3 flex justify-between items-center bg-gray-100 hover:bg-gray-200 rounded-t-md">
                            <span class="font-semibold text-gray-700">📁 {{ $kategori ?? 'Tanpa Kategori' }}</span>
                            <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition class="p-4 bg-white space-y-3">
                            @foreach ($items as $item)
                                <div class="flex items-center justify-between px-4 py-2 rounded hover:bg-gray-50">
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox"
                                            name="items[{{ $checklist->id }}][]"
                                            value="{{ $item->id }}"
                                            {{ $item->is_checked ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-amber-600 shadow-sm focus:ring-amber-500" />
                                        <span class="text-gray-800">
                                            {{ ucfirst($item->name) }}
                                            <span class="text-sm text-gray-500">({{ $item->quantity }})</span>
                                        </span>
                                    </label>

                                    <span class="text-sm {{ $item->is_checked ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $item->is_checked ? '✔️ Sudah Dibawa' : '❌ Belum Dibawa' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach

        <x-filament::button type="submit" class="mt-4">
            Simpan Checklist
        </x-filament::button>
    </form>
</x-filament::page>

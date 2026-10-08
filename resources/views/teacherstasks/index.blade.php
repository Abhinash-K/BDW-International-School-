<x-layout>
    <div class="container">
        <div class="flex" style="width:100%;">
            {{ $dataTable->table() }}
        </div>
    </div>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    @endpush
</x-layout>
<div class="w-1/3">
    <ul class="text-center bg-white divide-y rounded shadow">
        @foreach ($things as $thing)
            <li animate-move wire:key="{{ $thing['id'] }}" class="p-4">
                {{ $thing['title'] }}
            </li>
        @endforeach
    </ul>
    <button wire:click="shuffle" class="w-full py-4 mt-4 bg-gray-200 rounded focus:outline-none">Shuffle</button>
</div>

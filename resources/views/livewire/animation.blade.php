<div>
    <ul class="bg-white divide-y rounded shadow">
        @foreach ($things as $thing )
            <li wire:key="{{ $thing['id'] }}" class="w-64 p-4">
                {{ $thing['title'] }}
            </li>
        @endforeach
    </ul>
    <button wire:click="shuffle" class="w-full py-4 mt-4 bg-gray-200 rounded focus:outline-none">Shuffle</button>
</div>

<div>
    <h1 class="text-2xl font-semibold text-gray-900">Profile</h1>

    <form wire:submit.prevent="save">
        <div class="mt-6 sm:mt-5">
            <!-- First option on how to show a saved message -->
            <div>
                @if ($saved)
                    <div class="w-full mb-6 bg-white rounded-lg pointer-events-auto">
                        <div class="overflow-hidden rounded-lg shadow-xs">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <div class="flex shrink-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 w-0 pt-0 ml-3 5">
                                        <p class="text-sm font-medium leading-5 text-gray-900">
                                            Successfully saved!
                                        </p>
                                    </div>
                                    <div class="flex flex-shrink-0 ml-4">
                                        <button wire:click="$set('saved', false)" type="button"
                                            class="inline-flex text-gray-400 transition ease-in-out focus:outline-none focus:text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>Profile save!</div>
                @endif
            </div>

            <x-input.group label="Username" for="username" :error="$errors->first('username')">
                <x-input.text wire:model="user.username" id="username" leading-add-on="surge.com/" />
            </x-input.group>

            <x-input.group label="Birthday" for="birthday" :error="$errors->first('birthday')">
                <x-input.date wire:model="user.birthday" id="birthday" placeholder="YYYY/MM/DD" />
            </x-input.group>

            <x-input.group label="About" for="about" :error="$errors->first('about')"
                help-text="Write a few sentances about yourself.">
                <x-input.rich-text wire:model.defer="user.about" id="about" />
            </x-input.group>

            <x-input.group label="Photo" for="photo" :error="$errors->first('upload')">
                <x-input.file-upload wire:model="upload" id="photo">
                    <span class="w-12 h-12 overflow-hidden bg-gray-100 rounded-full">
                        @if ($upload)
                            <img src="{{ $upload->temporaryUrl() }}" alt="Profile Photo">
                        @else
                            <img src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                        @endif
                    </span>
                </x-input.file-upload>
            </x-input.group>

            <x-input.group label="Filepond" for="photo" :error="$errors->first('upload')">
                <x-input.filepond wire:model="files" multiple />
            </x-input.group>
        </div>

        <div class="pt-5 mt-8 border-t border-gray-200">
            <div class="flex items-center justify-end space-x-3">
                <span x-data="{ open: false }" x-init="
                @this.on('notify-saved', () => {
                            if (open === false) setTimeout(() => { open = false }, 2500);
                            open = true;
                        })
                    " x-show.transition.out.duration.1000ms="open" style="display: none;"
                    class="text-gray-500">Saved!</span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button"
                        class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800">
                        Cancel
                    </button>
                </span>

                <span class="inline-flex rounded-md shadow-sm">
                    <button type="submit"
                        class="inline-flex justify-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
                        Save
                    </button>
                </span>
            </div>
        </div>
    </form>
</div>

<x-layouts.base>
    <div class="flex h-screen overflow-hidden bg-cool-gray-100" x-data="{ sidebarOpen: false }"
        @keydown.window.escape="sidebarOpen = false">
        <!-- Off-canvas menu for mobile -->
        <div x-show="sidebarOpen" class="md:hidden" style="display: none;">
            <div class="fixed inset-0 z-40 flex">
                <div @click="sidebarOpen = false" x-show="sidebarOpen"
                    x-description="Off-canvas menu overlay, show/hide based on off-canvas menu state."
                    x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0"
                    style="display: none;">
                    <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                </div>
                <div x-show="sidebarOpen" x-description="Off-canvas menu, show/hide based on off-canvas menu state."
                    x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    class="relative flex flex-col flex-1 w-full max-w-xs bg-indigo-400" style="display: none;">
                    <div class="absolute top-0 right-0 p-1 -mr-14">
                        <button x-show="sidebarOpen" @click="sidebarOpen = false"
                            class="flex items-center justify-center w-12 h-12 rounded-full focus:outline-none focus:bg-gray-600"
                            aria-label="Close sidebar" style="display: none;">
                            <svg class="w-6 h-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <img class="w-auto h-8" src="/img/logos/workflow-logo-on-brand.svg" alt="Workflow">
                        </div>
                        <nav class="px-2 mt-5 space-y-1">
                            <a href="/dashboard"
                                class="flex items-center px-2 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-indigo-900 rounded-md group focus:outline-none focus:bg-indigo-700">
                                <svg class="w-6 h-6 mr-4 text-indigo-400 transition duration-150 ease-in-out group-hover:text-indigo-300 group-focus:text-indigo-300"
                                    stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                                    </path>
                                </svg>
                                Dashboard
                            </a>
                        </nav>
                        <nav class="px-2 mt-5 space-y-1">
                            <a href="/animation"
                                class="flex items-center px-2 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-indigo-900 rounded-md group focus:outline-none focus:bg-indigo-700">
                                <svg class="w-6 h-6 mr-4 text-indigo-400 transition duration-150 ease-in-out group-hover:text-indigo-300 group-focus:text-indigo-300"
                                    stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                                    </path>
                                </svg>
                                Animation
                            </a>
                        </nav>
                    </div>
                    <div class="flex flex-shrink-0 p-4 border-t border-indigo-500">
                        <a href="/profile" class="flex-shrink-0 block group focus:outline-none">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block w-12 h-12 rounded-full"
                                        src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                                </div>
                                <div class="ml-3">
                                    <p class="text-base font-medium leading-6 text-white">
                                        {{ auth()->user()->username }}
                                    </p>
                                    <p
                                        class="text-sm font-medium leading-5 text-indigo-300 transition duration-150 ease-in-out group-hover:text-indigo-100 group-focus:underline">
                                        View profile
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-14">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-indigo-500 border-r border-gray-200">
                <div class="flex flex-col flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex items-center flex-shrink-0 px-4">
                        <img class="w-auto h-7" src="/img/logo-light.svg" alt="Surge Logo">
                    </div>
                    <!-- Sidebar component, swap this element with another sidebar if you like -->
                    <nav class="flex-1 px-2 mt-5 space-y-1 bg-indigo-500">
                        <a href="/dashboard"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-900 rounded-md group focus:outline-none focus:bg-indigo-700">
                            <svg class="w-6 h-6 mr-3 text-indigo-400 transition duration-150 ease-in-out group-focus:text-indigo-300"
                                stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                                </path>
                            </svg>
                            Dashboard
                        </a>
                    </nav>
                    <nav class="flex-1 px-2 mt-5 space-y-1 bg-indigo-500">
                        <a href="/animation"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-900 rounded-md group focus:outline-none focus:bg-indigo-700">
                            <svg class="w-6 h-6 mr-3 text-indigo-400 transition duration-150 ease-in-out group-focus:text-indigo-300"
                                stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                                </path>
                            </svg>
                            Animation
                        </a>
                    </nav>
                    <nav>
                        <a href="/drag-component"
                            class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-900 rounded-md group focus:outline-none focus:bg-indigo-700">
                            <svg class="w-6 h-6 mr-3 text-indigo-400 transition duration-150 ease-in-out group-focus:text-indigo-300"
                                stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6">
                                </path>
                            </svg>
                            Drag-Component
                        </a>
                    </nav>
                </div>

                <div class="flex flex-shrink-0 p-4 border-t border-indigo-700">
                    <a href="/profile" class="flex-shrink-0 block w-full group">
                        <div class="flex items-center">
                            <div>
                                <img class="inline-block w-12 h-12 rounded-full"
                                    src="{{ auth()->user()->avatarUrl() }}" alt="Profile Photo">
                            </div>

                            <div class="ml-3">
                                <p class="text-sm font-medium leading-5 text-white">
                                    {{ auth()->user()->username }}
                                </p>

                                <p
                                    class="text-xs font-medium leading-4 text-indigo-300 transition duration-150 ease-in-out group-hover:text-indigo-100">
                                    View profile
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="flex flex-col flex-1 w-0 overflow-hidden">
            <div class="pt-1 pl-1 md:hidden sm:pl-3 sm:pt-3">
                <button @click.stop="sidebarOpen = true"
                    class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150"
                    aria-label="Open sidebar">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <main class="relative z-0 flex-1 pt-2 pb-6 overflow-y-auto focus:outline-none md:py-6" tabindex="0"
                x-data="" x-init="$el.focus()">
                <div class="px-4 mx-auto max-w-7xl sm:px-6 md:px-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Pop up message when saved -->
        <x-notification />
    </div>
</x-layouts.base>

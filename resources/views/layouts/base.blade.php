<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2&display=swap" rel="stylesheet">

    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- Livewire -->
    @livewireStyles

    <!-- Filepond -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet">

    <!-- Pikaday package from Github -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    <!-- Trix package from Github -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@1.2.3/dist/trix.css">
</head>

<body class="font-sans antialiased bg-gray-100">
    {{ $slot }}

    <!-- Livewire -->
    @livewireScripts

    <!-- Pikaday package from Github -->
    <script src="https://unpkg.com/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

    <!-- Trix package from Github -->
    <script src="https://unpkg.com/trix@1.2.3/dist/trix.js"></script>

    <!-- Filepond -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <!-- Load this script after `@livewireScripts` in your layout or where you like putting scripts. -->
    <script>
        let animations = []

        Livewire.hook('message.received', () => {
            let things = Array.from(document.querySelectorAll('[animate-move]'))

            animations = things.map(thing => {
                let oldTop = thing.getBoundingClientRect().top

                return () => {
                    let newTop = thing.getBoundingClientRect().top

                    thing.animate([
                        { transform: `translateY(${oldTop - newTop}px)` },
                        { transform: `translateY(0px)` },
                    ], { duration: 1000, easing: 'ease' })
                }
            })

            things.forEach(thing => {
                thing.getAnimations().forEach(animation => animation.finish())
            })
        })

        Livewire.hook('message.processed', () => {
            while (animations.length) {
                animations.shift()()
            }
        })
    </script>
</body>

</html>

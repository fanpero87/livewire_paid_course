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

    <!-- Animating A Re-Ordered List. -This it's been used on the animation livewire component -->
    <script>
        let animations = []

        //When a message is received and the HTML haven't change yet
        Livewire.hook('message.received', () => {
            // grab all the things you want to animate and store them in an Array
            let things = Array.from(document.querySelectorAll('[animate-move]'))

            // loop through all the things you want to move
            animations = things.map(thing => {
                // get the old top position of each element
                let oldTop = thing.getBoundingClientRect().top

                //return a call back with the new position of each element and the animation
                return () => {

                    //store the new top position of each element
                    let newTop = thing.getBoundingClientRect().top

                    // animation process for each element
                    thing.animate([{
                            transform: `translateY(${oldTop - newTop}px)`
                        },
                        {
                            transform: `translateY(0px)`
                        },
                    ], {
                        duration: 1000,
                        easing: 'ease'
                    })
                }
            })

            // if you click while the animation is going, this will finish the animations and start over
            things.forEach(thing => {
                thing.getAnimations().forEach(animation => animation.finish())
            })
        })


        Livewire.hook('message.processed', () => {
            // actually run the code that is inside of the call back
            while (animations.length) {
                animations.shift()()
            }
        })
    </script>

    <!-- Drag & Drop Sorting A List. -This it's been used on the animation livewire component -->
    <script>
        let root = document.querySelector('[drag-root]')

        root.querySelectorAll('[drag-item]').forEach(el => {
            el.addEventListener('dragstart', e => {
                e.target.setAttribute('dragging', true)
            })

            el.addEventListener('drop', e => {
                e.target.classList.remove('bg-yellow-100')

                let draggingEl = root.querySelector('[dragging]')

                e.target.before(draggingEl)

                // Refresh the livewire component
                let component = Livewire.find(
                    e.target.closest('[wire\\:id]').getAttribute('wire:id')
                )

                let orderIds = Array.from(root.querySelectorAll('[drag-item]'))
                    .map(itemEl => itemEl.getAttribute('drag-item'))

                let method = root.getAttribute('drag-root')

                component.call(method, orderIds)
            })

            el.addEventListener('dragenter', e => {
                e.target.classList.add('bg-yellow-100')

                e.preventDefault()
            })

            el.addEventListener('dragover', e => e.preventDefault())

            el.addEventListener('dragleave', e => {
                e.target.classList.remove('bg-yellow-100')
            })

            el.addEventListener('dragend', e => {
                e.target.removeAttribute('dragging')
            })
        })
    </script>
</body>

</html>

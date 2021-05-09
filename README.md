on the controller you could use $this->emitSelf('');
with this, you could then use @this on the view to reference that specific livewire component

This project is using:

pikadate package from GITHUB
https://github.com/Pikaday/Pikaday

Trix editor package
https://trix-editor.org
https://github.com/basecamp/trix

Gravatar to create an avatar image
https://en.gravatar.com

Filepond to upload images
https://pqina.nl/filepond/

on app\Providers\AppServiceProvider there are a few custome made components that are being used on the app.
one of them is: "Transaction::search('title', $this->search)->paginate(10)" -> search was made on that folder.
This replace the use of where and if statements.

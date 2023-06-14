<x-layout>

    <form action="/profile-upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="user-image" id="" required>

        <button type="submit">upload</button>
    </form>
    
</x-layout>
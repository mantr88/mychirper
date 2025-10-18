<x-layout>
  {{-- <x-slot name="title">Home</x-slot>// variant one for Set the page title to "Home" --}}
  <x-slot:title>Home</x-slot:title> {{-- variant two for Set the page title to "Home" --}}  
  <div class="max-w-2xl mx-auto">
    @foreach ($chirps as $chirp)
      <div class="card bg-base-100 shadow mt-4">
        <div class="card-body">
          <h2 class="text-xl font-semibold">{{ $chirp['author'] }}</h2>
          <p class="mt-2">{{ $chirp['message'] }}</p>
          <p class="mt-2 text-base-content/60">{{ $chirp['time'] }}</p>
        </div>
      </div>
    @endforeach
</x-layout>
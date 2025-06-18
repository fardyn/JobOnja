<x-layout>
    <h2 class="text-3xl text-center mb-4 font-bold border-gray-300 p-3">Bookmarked jobs</h2>

    @forelse($bookmarks as $bookmark)
        <x-job-card :job="$bookmark"/>
    @empty
        <p class="text-gray-500 text-center ">You have no bookmarks</p>
    @endforelse
</x-layout>>

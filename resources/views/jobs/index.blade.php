<x-layout>

<h1>Available jobs</h1>

    <ul>
        @forelse($jobs as $job)
            <li class="mt-10"> <a href="{{route("jobs.show", $job->id)}}"> {{$job->title}}</a> - {{$job->description}}</li>
        @empty
            <li>No jobs available</li>
        @endforelse
    </ul>
</x-layout>

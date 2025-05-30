<x-layout>
    <h1 class="text-center mb-4 text-3xl font-bold border-gray-300 p-3">Wellcome to Jobonja</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"></x-job-card>
        @empty
            <p>No jobs available</p>
        @endforelse
        <a href="{{route('jobs.index')}}" class="block text-xl text-center">
            <i class="fa fa-arrow-alt-circle-right "></i> Show all jobs
        </a>
    </div>
    <x-bottom-banner/>
</x-layout>




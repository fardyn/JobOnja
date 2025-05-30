<x-layout>
   <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"></x-job-card>
        @empty
            <p>No jobs available</p>
        @endforelse
       <a href="{{route('jobs.index')}}" class="block text-xl text-center mt-110">
           <i class="fa fa-arrow-alt-circle-right "></i> Show all jobs
       </a>
   </div>
</x-layout>

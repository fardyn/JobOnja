<x-layout>
    <div class="bg-blue-500 h-24 px-4 mb-4 flex justify-center items-center rounded ">
        <x-search></x-search>
    </div>

    {{--Back button--}}
    @if(request()->has('keywords') || request()->has('location'))
        <a href="{{route('jobs.index')}}" class="bg-gray-700 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-1"></i> Back
        </a>

    @endif
   <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"></x-job-card>
        @empty
            <p>No jobs available</p>
        @endforelse
       <div>
           <a href="{{route('jobs.index')}}" class=" block text-xl text-center mt-10">
       </div>

           <i class="fa fa-arrow-alt-circle-right "></i> Show all jobs
       </a>
   </div>

    {{--pagination lists--}}
    {{$jobs->links()}}
</x-layout>

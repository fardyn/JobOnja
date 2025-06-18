<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        {{-- profile info--}}
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">
                Profile info
            </h3>

            @if($user->avatar)
                <div class="mt-2 flex justify-center">
                    <img src="{{asset('storage/' . $user->avatar)}}" alt="User Profile" class="w-32 h-32 object-cover rounded-full">
                </div>
            @endif

            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data"  >
                @csrf
                @method('PUT')
                <x-inputs.text id="name" name="name" label="Name" placeholder="Your name" value="{{$user->name}}"></x-inputs.text>
                <x-inputs.text id="email" name="email" label="Email" placeholder="Your Email" value='{{$user->email}}'></x-inputs.text>

                <x-inputs.file id="avatar" name="avatar" label="avatar"></x-inputs.file>
                <button class="w-full bg-green-500 hover:bg-green-600 focus:outline-none text-white py-2 font-bold" type="submit">Update</button>
            </form>
        </div>

        {{-- job listings --}}
    <div class="bg-white p-8 rounded-lg shadow-md w-full">
        <h3 class="text-3xl text-center font-bold mb-4">
                My Job Listings
        </h3>
        @forelse ($jobs as $job)
            <div class=" flex justify-between items-center border-b-2 border-gray-200 py-2">
                <div>
                    <h3 class="text-3xl font-semibold">{{$job->title}}</h3>
                    <p class="text-gray-700 ">{{$job->job_type}}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{route('jobs.edit', $job->id)}}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm">
                        Edit
                    </a>
                    <!-- Delete Form -->
                    <form method="POST" action="{{route('jobs.destroy', $job->id)}}?from=dashboard" onsubmit="return confirm('are you sure that you want to delete this job?')">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded"
                        >
                            Delete
                        </button>
                    </form>
                    <!-- End Delete Form -->
                </div>
            </div>
        @empty
                <p class="text-gray-700">You have not job listing</p>
        @endforelse
    </div>
    </section>
    <x-bottom-banner></x-bottom-banner>
</x-layout>

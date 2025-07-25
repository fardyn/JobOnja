<x-layout>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <section class="md:col-span-3">
            <div class="rounded-lg shadow-md bg-white p-3">
                <div class="flex justify-between items-center">
                    <a class="block p-4 text-blue-700" href="/jobs.html">
                        <i class="fa fa-arrow-alt-circle-left"></i>
                        Back To Listings
                    </a>
                    @can('update', $job)
                    <div class="flex space-x-3 ml-4">
                        <a
                            href="/jobs/{{$job->id}}/edit"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                        >Edit</a
                        >
                        <!-- Delete Form -->
                        <form method="POST" action="{{route('jobs.destroy', $job->id)}}" onsubmit="return confirm('are you sure that you want to delete this job?')">
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
                    @endcan
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-semibold">{{$job->title}}</h2>
                    <p class="text-gray-700 text-lg mt-2">
                        {{$job->description}}
                    </p>
                    <ul class="my-4 bg-gray-100 p-4">
                        <li class="mb-2"><strong>Job Type:</strong> {{$job->job_type}}</li>
                        <li class="mb-2"><strong>Remote:</strong> {{$job->remote ? "Yes" : "No"}}</li>
                        <li class="mb-2"><strong>Salary:</strong> $ {{number_format($job->salary)}}</li>
                        <li class="mb-2">
                            <strong>Site Location:</strong> {{$job->city}}, {{$job->state}}
                            <span
                                class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2"
                            >Local</span
                            >
                        </li>
                        @if($job->tags)
                        <li class="mb-2">
                            <strong>Tags: {{ucwords(str_replace(",", ", ", $job->tags))}}</strong>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

            <div class="container mx-auto p-4">
                <h2 class="text-xl font-semibold mb-4">Job Details</h2>
                @if($job->requirements || $job->benefits)
                <div class="rounded-lg shadow-md bg-white p-4">
                    <h3 class="text-lg font-semibold mb-2 text-blue-500">Job Requirements</h3>
                    <p>
                        {{$job->requirements}}
                    </p>
                    <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">Benefits</h3>
                    <p>{{$job->benefits}}</p>
                </div>
                @endif
                @auth()
                <p class="my-5">
                    Put "Job Application" as the subject of your email and attach your resume.
                </p>

                <div x-data="{open: false}">
                    <button @click="open=true"
                        class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                        Apply now
                    </button>
                    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-gray-900 opacity-95">
                        <div @click.away="open=false" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md ">
                            <h3 class="text-lg mb-4 font-semibold ">
                                Apply for: {{$job->title}}
                            </h3>
                            <form method="POST" action="{{route('applicants.store', $job->id)}}"  enctype="multipart/form-data">
                                @csrf
                                <x-inputs.text id="full_name" name="full_name" label="Full name" :required="true"/>
                                <x-inputs.text id="contact_number" type="phone" name="contact_number" label="Contact number" />
                                <x-inputs.text id="email" name="email" label="Email" :required="true" type="email"/>
                                <x-inputs.text-area id="message" name="message" label="Message"></x-inputs.text-area>
                                <x-inputs.text id="location" name="location" label="Location"/>
                                <x-inputs.file id="resume_path" name="resume_path" label="Upload Your Resume" :required="true"></x-inputs.file>





                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                                    Apply
                                </button>


                                <button @click="open=false" class="bg-red-500 hover:bg-red-600 text-black px-4 py-2 rounded-md">
                                    Cancel
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
                @else
                    <p class="my-5 bg-gray-500 rounded-lg p-2">
                        <i class="fas fa-info-circle mr-3 "></i>You must be logged in to apply for this job</p>
                @endauth

            </div>



            <div class="bg-white p-6 rounded-lg shadow-md mt-6">
                <div id="map"></div>
            </div>
        </section>
        <aside class="bg-white rounded-lg shadow-md p-3">
            <h3 class="text-xl text-center mb-4 font-bold">Company Info</h3>
            @if($job->company_logo)
            <img
                src="/storage/{{$job->company_logo}}"
                alt="Ad"
                class="w-full rounded-lg mb-4 m-auto"
            />
            @endif
            <h4 class="text-lg font-bold">{{$job->company_name}}</h4>
            @if($job->description)
            <p class="text-gray-700 text-lg my-3">
                {{$job->description}}
            </p>
            @endif
            @if($job->company_website)
            <a href="{{$job->company_website}}" target="_blank" class="text-blue-500"
            >Visit Website</a
            >
            @endif
            @guest
                <p class="mt-10 bg-gray-200 text-gray-700 font-bold w-full py-2 px-4 rounded-full text-center">
                    <i class="fas fa-info-circle mr-3 "></i> You must be logged in to bookmark
                </p>
                @else
                <form action="{{route('bookmarks.store', $job->id)}}" method="POST">
                    @csrf


                    <button class="flex bg-blue-500 text-white font-bold w-full py-2 px-4 rounded-full items-center justify-center hover:bg-blue-500 mb-2 mt-3" type="submit">
                        <i class="fas fa-bookmark mr-3"></i> Bookmark listing
                    </button>

                </form>

                <form action="{{route('bookmarks.destroy', $job->id)}}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="flex bg-red-500 text-black font-bold w-full py-2 px-4 rounded-full items-center justify-center hover:bg-red-500 mb-2" type="submit">
                        <i class="fas fa-bookmark mr-3"></i> Delete bookmark
                    </button>

                </form>

            @endguest
        </aside>
    </div>

</x-layout>


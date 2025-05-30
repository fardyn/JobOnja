<x-layout>
    <x-slot name="title">Create job</x-slot>
    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
        <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>
        <form method="POST" action="/jobs" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <x-inputs.text id="title" name="title" lable="job title" placeholder="Software Engineer"/>

            <div class="mb-4">
                <label class="block text-gray-700" for="description"
                >Job Description</label
                >
                <textarea
                    cols="30"
                    rows="7"
                    id="description"
                    name="description"
                    class="w-full px-4 py-2 border rounded focus:outline-none @error('description') border-red-500 @enderror"
                    placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team. In this role, you will be responsible for designing, developing, and maintaining high-quality software solutions that meet our clients' needs. You will work closely with cross-functional teams to deliver robust applications and improve existing systems."
                >{{old('description')}}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>

            <x-inputs.text id="salary" name="salary" lable="Annual Salary" type="number" placeholder="90,000"/>




            <div class="mb-4">
                <label class="block text-gray-700" for="requirements"
                >Requirements</label
                >
                <textarea
                    id="requirements"
                    name="requirements"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    placeholder="Bachelor's degree in Computer Science"
                ></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700" for="benefits">Benefits</label>
                <textarea
                    id="benefits"
                    name="benefits"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                    placeholder="Health insurance, 401k, paid time off"
                ></textarea>
            </div>


            <x-inputs.text id="tags" name="tags" lable="tags (comma separated)" placeholder="development,coding,java,python"/>


            <div class="mb-4">
                <label class="block text-gray-700" for="job_type">Job Type</label>
                <select
                    id="job_type"
                    name="job_type"
                    class="w-full px-4 py-2 border rounded focus:outline-none @error('job_type') border-red-500 @enderror"
                >
                    <option value="Full-Time"  {{old('job_type') == 'Full-Time' ? "selected" : ""}}>Full-Time</option>
                    <option value="Part-Time" {{old('job_type') == 'Part-Time' ? "selected" : ""}}>Part-Time</option>
                    <option value="Contract" {{old('job_type') == 'Contract' ? "selected" : ""}}>Contract</option>
                    <option value="Temporary" {{old('job_type') == 'Temporary' ? "selected" : ""}}>Temporary</option>
                    <option value="Intern" {{old('job_type') == 'Intern' ? "selected" : ""}}>Intern</option>
                    <option value="Volunteer" {{old('job_type') == 'Volunteer' ? "selected" : ""}}>Volunteer</option>
                    <option value="On-Call" {{old('job_type') == 'On-Call' ? "selected" : ""}}>On-Call</option>
                </select>
                @error('job_type')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror

            </div>

            <div class="mb-4">
                <label class="block text-gray-700" for="remote">Remote</label>
                <select
                    id="remote"
                    name="remote"
                    class="w-full px-4 py-2 border rounded focus:outline-none"
                >
                    <option value="false">No</option>
                    <option value="true">Yes</option>
                </select>
            </div>

            <x-inputs.text id="address" name="address" lable="address" placeholder="123 Main St"/>
            <x-inputs.text id="city" name="city" lable="City" placeholder="Albany"/>
            <x-inputs.text id="state" name="state" lable="state" placeholder="NY"/>
            <x-inputs.text id="zipcode" name="zipcode" lable="zipcode" placeholder="12201"/>


            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>

            <x-inputs.text id="company_name" name="company_name" lable="Company Name" placeholder="Apple"/>
            <x-inputs.text id="company_description" name="company_description" lable="Company Description" placeholder="Company Description"/>
            <x-inputs.text id="company_website" name="company_website" lable="Company Website" placeholder="Apple.com"/>
            <x-inputs.text id="contact_phone" name="contact_phone" lable="Contact Phone" placeholder="Enter phone"/>
            <x-inputs.text id="contact_email" type="email"  name="contact_email" lable="Contact Email" placeholder="Email where you want to receive applications"/>


            <div class="mb-4">
                <label class="block text-gray-700" for="company_logo"
                >Company Logo</label
                >
                <input
                    id="company_logo"
                    type="file"
                    name="company_logo"
                    class="w-full px-4 py-2 border rounded focus:outline-none @error('company_logo') border-b-red-500 @enderror"
                />
                @error('company_logo')
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
                Save
            </button>
        </form>
    </div>
 </x-layout>


<x-layout>
    <div class="bg-white rounded-lg shadow-md md:max-w-xl w-full mx-auto mt-12 p-8 py-12">
        <h2 class="text-4xl text-center font-bold mb-4">
            Register
        </h2>
        <form action="{{route('register.store')}}" method="post">
            @csrf
            <x-inputs.text id="name" name="name" placeholder="Full name"></x-inputs.text>
            <x-inputs.text id="email" type="email" name="email" placeholder="Email address"></x-inputs.text>
            <x-inputs.text id="password" type="password" name="password" placeholder="Enter your Password"></x-inputs.text>
            <x-inputs.text id="password_confirmation" type="password" name="password_confirmation" placeholder="password confirmation"></x-inputs.text>
            <button class=" w-full bg-blue-500 hover:bg-blue-600 px-4 py-2 rounded focus:outline-none text-white" type="submit">
                Register
            </button>
            <p class="mt-4 text-gray-500">
                Already have an account?
                <a class="text-blue-900" href="{{route('login')}}">Login</a>
            </p>
        </form>
    </div>
</x-layout>

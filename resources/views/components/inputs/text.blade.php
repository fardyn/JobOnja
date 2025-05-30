@props(['id', 'name', 'lable' => null, 'type' => 'text', 'value' => '', 'placeholder'=> ''])

<div class="mb-4">
    <label class="block text-gray-700" for="{{$id}}">{{$lable}}</label>
    <input
        id="{{$id}}"
        type="{{$type}}"
        name="{{$name}}"
        class="w-full px-4 py-2 border rounded focus:outline-none @error($name) border-red-500 @enderror"
        placeholder="{{$placeholder}}"
        value="{{old('title')}}"/>
    @error($name)
    <p class="text-red-500 text-sm mt-1">{{$message}}</p>
    @enderror

</div>

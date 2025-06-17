@props(['id', 'name', 'label' => null, 'value' => '', 'placeholder'=> ''])

<div class="mb-4">
    <label class="block text-gray-700" for="description"
    >{{$label}}</label
    >
    <textarea
        cols="30"
        rows="7"
        id="description"
        name="description"
        class="w-full px-4 py-2 border rounded focus:outline-none @error('description') border-red-500 @enderror"
        placeholder="{{$placeholder}}"
    >{{old('description')}}</textarea>
    @error('description')
    <p class="text-red-500 text-sm mt-1">{{$message}}</p>
    @enderror
</div>

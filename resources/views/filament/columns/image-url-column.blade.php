<div class="flex items-center gap-2">
    @if($getState())
        <img src="{{ $getState() }}" alt="Product image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;" />
    @else
        <span class="text-gray-500">No image</span>
    @endif
</div>

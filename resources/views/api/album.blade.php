<div>
    <h2 class="font-bold">
        {{$album->name}} ({{$album->products->count()}})
    </h2>
    <div class="flex">
    @foreach($album->products()->orderBy('id', 'DESC')->get() as $product)
        <label for="product_id">
            <input type="radio" wire:model="product_id" value="{{$product->id}}">
                <img class="object-cover rounded-tl-lg rounded-tr-lg" width="150px"
                     src="{{asset('storage/albums/'.$album->id.'/s_'.$product->picture)}}"/>
        </label>
    @endforeach
    </div>
</div>

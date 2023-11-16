<div>
    <h2 class="font-bold">
        {{$album->name}}
    </h2>
    <div class="grid grid-flow-col auto-cols-max">
    @foreach($album->products()->orderBy('id', 'DESC')->get() as $product)
        <label for="product_id_{{$product->id}}" class="p-2">
            <input type="radio" id="product_id_{{$product->id}}" wire:model="product_id" value="{{$product->id}}">
                <img class="object-cover rounded-tl-lg rounded-tr-lg" width="150px"
                     src="{{asset('storage/albums/'.$album->id.'/s_'.$product->picture)}}"/>
        </label>
    @endforeach
    </div>
</div>

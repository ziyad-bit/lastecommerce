
{{-- profile details --}}

@foreach ($items as $item)
<div class="card mb-3" style="width: 36rem;" >
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ asset('images/items/' . $item->photo) }}" class="card-img image-item" alt="..." />
        </div>
        <div class="col-md-8" >
            <ul class="list-group">
                <li class="list-group-item active">
                    <h4>information</h4>
                </li>
                <li class="list-group-item items_list">
                    <span class="name_item">name</span>:
                    <span id="name" class="item_name">{{ $item->name  }}</span>
                </li>

                <li class="list-group-item items_list ">
                    <span class="email">email</span>:
                    <span id="email" class="user_email">{{ $item->rate == 0 ? 'no rate': $item->rate }}</span>
                </li>

                <li class="list-group-item items_list">
                    <span class="created_at"> created at</span>:
                    {{$item->price}}
                </li>
            </ul>
        </div>
    </div>
</div>
@endforeach







{{--@foreach ($items as $item)
<div class="col-sm-3" id="more_items">
    <div  class="col-sm-3" >
        <div class="card" style="width: 14rem;"  >
            <img src="{{ asset('images/items/' . $item->photo) }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 class="card-title">{{ $item->name }}</h3>
                <ul class="list-group">
                    <li class="list-group-item items"><span class="status">status</span>:{{ $item->condition }} </li>
                    <li class="list-group-item items"><span class="status">review</span>: {{ $item->rate == 0 ? 'no rate': $item->rate }} </li>
                    <li class="list-group-item items"><span class="price">price</span>:${{ $item->price }} </li>
                    <li class="list-group-item items"><span class="date">date</span>:{{ $item->date }} </li>
                </ul>
                <a class="btn btn-success" href="{{url('items/details/'.$item->slug)}}">details</a>
            </div>
            
        </div>
    </div>
</div>
@endforeach
--}}
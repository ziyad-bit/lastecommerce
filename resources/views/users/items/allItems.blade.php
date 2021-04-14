
<div class="row">
    @foreach ($items as $item)
            <div class="col-sm">
                <div class="card" style="width: 18rem; margin-right: 20px">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$item->name}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
    @endforeach
    
</div>




  {{-- <div class="card mb-3" style="width: 36rem;" >
        <div class="row no-gutters">
            <div class="col-md-4">
                <a href="{{url('items/details/'.$item->slug)}}"><img src="{{ asset('images/items/' . $item->photo) }}"
                    class="card-img image-item" alt="no image" style="max-height: 210px;"/></a>
            </div>
            <div class="col-md-8" >
                <ul class="list-group">
                    <li class="list-group-item active">
                        <a href="{{url('items/details/'.$item->slug)}}" style="text-decoration: none;color:white;" ><h4 class="link">information</h4></a>
                    </li>
                    <li class="list-group-item items_list">
                        <span class="name_item" style=" color: #2ecc71;font-weight: bold">name</span>:
                        <span id="name" class="item_name">{{ $item->name  }}</span>
                    </li>
    
                    <li class="list-group-item items_list ">
                        <span class="email" style="margin-right: 12px; color: #2ecc71;font-weight: bold">rate</span>:
                        <span id="email" class="user_email">{{ $item->rate == 0 ? 'no rate': $item->rate }}</span>
                    </li>
    
                    <li class="list-group-item items_list">
                        <span class="created_at" style="margin-right: 5px; color: #2ecc71;font-weight: bold"> price</span>:
                        {{$item->price}}
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}
@extends('layouts.app')

@section('header')
    <title>{{ env('APP_NAME', 'items - zikolaravelecommerce') }}</title>
    <meta name="keywords"
        content="enjoy shopping, buy products by one click, you can find top brands at low prices in zikolaravelecommerce">
    <link href="{{ asset('css/users/items/show.css') }}" rel="stylesheet">
@endsection

@section('content')
    <h1 class="text-center">items</h1>
    <a class="btn btn-primary" style="margin-bottom: 15px" href="{{ url('items/create') }}">add item</a>
    <div class="row">
        <div class="col-sm-3 ">

            <form method="POST" action="{{ url('items/get') }}" id="filter_form">
                @csrf
                {{-- filter price --}}
                <div class="pb-3">
                    <h3>Price</h3>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="price" value="price_0_500"
                                {{ isset($price) && $price == 'price_0_500' ? 'checked' : '' }}> 0 - 500
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="price" value="price_501_1500"
                                {{ isset($price) && $price == 'price_501_1500' ? 'checked' : '' }}> 501 - 1500
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="price" value="price_1501_3000"
                                {{ isset($price) && $price == 'price_1501_3000' ? 'checked' : '' }}> 1501 - 3000
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="price" value="price_3001_5000"
                                {{ isset($price) && $price == 'price_3001_5000' ? 'checked' : '' }}> 3001 - 5000
                        </label>
                    </div>
                </div>

                <input type="hidden" value="{{ $search }}" name="search" />

                {{-- filter category --}}
                <div class="pb-3">
                    <h3>category</h3>
                    @foreach ($category as $cate)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="category" id="category"
                                    value="{{ $cate->id }}"
                                    {{ isset($selected_category) && $selected_category == $cate->id ? 'checked' : '' }}>{{ $cate->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="pb-3">
                    <h3>brands</h3>
                    @foreach ($brands as $brand)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="brands[]" id="brand"
                                    value="{{ $brand->id }}"
                                    {{ isset($selected_brands) && in_array($brand->id, $selected_brands) ? 'checked' : '' }}>{{ $brand->name }}
                            </label>
                        </div>
                    @endforeach

                </div>

                <button class="btn btn-primary" type="submit">
                    Apply
                </button>
                <a class="btn btn-secondary reset" href="{{ url('items/get') }}">
            </form>

            Reset
            </a>
        </div>


        {{-- items --}}
        <div id="more_items">
            @include('users.items.allItems')
        </div>
    </div>

    <div id="load" style="margin-top: 30px" class="text-center" style="display: none">
        <img src="{{ asset('images/items/200.gif') }}" />
        loading more items
    </div>

@endsection
@section('script')
    <script>
        function loadMore(page){
            let Items_request=new XMLHttpRequest();
            Items_request.onreadystatechange=function(){
                if(this.readyState == 4 && this.status == 200){
                    let res=JSON.parse(this.responseText);
                    let items=res.html;
                    let load=document.getElementById('load');
                    
                    if(items == ''){
                        load.textContent='no more items';
                        return;
                    }
                    
                    let more_items=document.getElementById('more_items');
                    more_items.insertAdjacentHTML('afterend',items);
                    load.style.display='none';
                }
            }
            let filter_form=document.getElementById('filter_form');
            let formData=new FormData(filter_form);
            formData.append('agax',1)

            Items_request.open('post','?page='+page);
            Items_request.send(formData)
        }

        let page=1
        window.onscroll=function(){
            if(window.scrollY+ window.innerHeight >= document.body.clientHeight){
                document.getElementById('load').style.display='';
                page++;
                loadMore(page);
            }
        }

    </script>
@endsection

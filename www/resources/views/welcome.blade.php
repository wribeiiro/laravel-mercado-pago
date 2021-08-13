@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach (\App\Models\Product::all() as $product)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{$product->name}}
                    </div>

                    <div class="card-body text-center">
                        <img class="img-fluid mb-2" src="https://bitsofco.de/content/images/2018/12/broken-1.png">
                        <h3 class="text-center mt-2">R$ {{number_format($product->price, 2, ',', '.')}}</h3>

                        <form action="{{route('payment.create')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                            <button type="submit" class="btn btn-success" href=""> Comprar </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

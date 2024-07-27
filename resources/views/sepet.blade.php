@extends('layouts.master')
@section('title', 'Kategori')
@section('content')

    <div class="container">
        <div class="bg-content">
            <h2>Sepet</h2>
            @include('layouts.partials.alert')

            @if(count(Cart::content()) > 0)
                <table class="table table-bordered table-hover">
                    <tr>
                        <th colspan="2" >Ürün</th>
                        <th>Adet Fiyatı</th>
                        <th>Adet</th>
                        <th>Tutar</th>
                    </tr>
                    @foreach(Cart::content() as $urunCartItem)
                        <tr>
                            <td style="width: 120px;">
                                <img src="http://lorempixel.com/120/100/food/2">
                            </td>
                            <td>
                                <a href="#">{{ $urunCartItem->name }}</a>
                                <form action="{{ route('sepet.kaldir',$urunCartItem->rowId) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="submit" class="btn btn-danger btn-xs" value="Sepetten Kaldır" >
                                </form>
                            </td>
                            <td>{{ $urunCartItem->price }}</td>
                            <td>
                                <a href="#" class="btn btn-xs btn-default urun-adet-azalt">-</a>
                                <span style="padding: 10px 20px">{{ $urunCartItem->qty }}</span>
                                <a href="#" class="btn btn-xs btn-default urun-adet-artir">+</a>
                            </td>
                            <td class="text-right">{{ $urunCartItem->subtotal }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="4" class="text-right">Alt Toplam</th>
                        <th>{{ Cart::subtotal() }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">KDV</th>
                        <th>{{ Cart::tax() }}</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-right">Genel Toplam</th>
                        <th>{{ Cart::total() }}</th>
                    </tr>
                </table>

                <div>
                    <form action="{{ route('sepet.bosalt') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-info pull-left" value="Sepeti Boşalt" >
                    </form>
                    <a href="{{ route('odeme') }}" class="btn btn-success pull-right btn-lg">Ödeme Yap</a>
                </div>

            @else
                <p>Sepetinizde Ürün Bulunmamakta</p>
            @endif

        </div>
    </div>

@endsection
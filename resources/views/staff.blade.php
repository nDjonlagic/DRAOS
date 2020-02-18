@extends('layouts.app')

@section('content')
  <section id="cover">
    <div class="cover-background">
      <img src="hhttps://wallpaperaccess.com/full/1306229.jpg" />
    </div>
    <div class="cover-content cover-staff">
      <a href="{{ url('payments') }}" class="cover-staff__option">
        <img src="https://www.bootgum.com/wp-content/uploads/2018/07/Wallet_Cash_550px.gif" />
        <span>Payments</span>
      </a>
      <a href="{{ url('preparation') }}" class="cover-staff__option">
        <img  src="https://cdn.dribbble.com/users/645440/screenshots/3266490/loader-2_food.gif" />
        <span>Prepare order</span>
      </a>
    </div>
  </section>
@endsection

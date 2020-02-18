@extends('layouts.app')

@section('content')
  <section id="cover">
    <div class="cover-background">
      <img src="https://wallpaperaccess.com/full/1306229.jpg" />
    </div>
    <div class="cover-content">
      <h1>Tasty To Go</h1>
      <span class="des">Order your food within seconds</span>
      <span class="details">
        Sometimes you need treat and you deserve a nice one… check out our brand-new menu and book a table or order a delivery. Tasty To Go is the solution which makes your food ordering easy and sustainable. With just a few clicks create and place your order through our system and be notified once it is done.
      </span>
      <div>
        <a href="{{ url('login') }}" class="btn-action">
          Order the food
        </a>
        <a href="{{ url('register') }}" class="btn-action">
          Create account
        </a>
      </div>
    </div>
  </section>
@endsection

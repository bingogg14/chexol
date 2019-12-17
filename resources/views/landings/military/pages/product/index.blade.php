@extends('landings.military.layouts.default')

@section('article')
  <!-- Article -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-push-6 col-lg-6 col-lg-push-6">
          <header>
            <h1 class="article__title"><b class="accent">Противоударный чехол</b> защитит ваш {{$product->title}}, даже если ним колоть орехи</h1>
            <p class="aricle__description"></p>
          </header>
          <figure class="visible-xs">
            <img class="article__img" src="{{ Storage::url($product->image_landing) }}" alt="Противоударные чехлы для телефонов Samsung | Extrasale.in.ua" width="" height="">
          </figure>
          <div class="box-offer">
            <footer>
              <p class="product__price">Цена: <mark><b class="accent">{{$product->price_new}}<span>грн</span></b></mark><span class="old-price">{{$product->price}}<span>грн</span></span></p>
              <p class="article__content">Бесплатная доставка действует:</p>
              <div class="your-clock">
                <ul id="clockdiv" class="countDown">
                  <li>
                    <span class="hours circle"></span>
                    <div class="text-clock">Часов</div>
                  </li>
                  <li>
                    <span class="minutes circle"></span>
                    <div class="text-clock">Минут</div>
                  </li>
                  <li>
                    <span class="seconds circle"></span>
                    <div class="text-clock">Секунд</div>
                  </li>
                </ul>
              </div>
              <div class="section__block__special__offer">
                <form action="{{$product->slug}}/call" method="post" id="special__offer__form__offer__first">
                  <input type="text" class="phone" name="phone" placeholder="Телефон: " required>
                  <button class="actions-entry actions-entry__buy actions-entry__item--green">Зафиксировать бесплатную доставку</button>
                </form><!-- #form special__offer__form -->
              </div>
              <p class="article__desc">Введите номер телефона и наш менеджер свяжется с вами в рабочее время</p>
            </footer>
          </div>
        </div>
        <div class="col-sm-6 col-sm-pull-6 col-lg-6 col-lg-pull-7">
          <figure class="hidden-xs">
            <img class="article__img" src="{{ Storage::url($product->image_landing) }}" alt="Противоударные чехлы для телефонов Samsung | Extrasale.in.ua" width="" height="">
          </figure>
        </div>
      </div><!-- #End row class-->
    </div><!-- #End container class-->
  </article><!-- #End article semantic-->
@stop

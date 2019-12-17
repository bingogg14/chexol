@extends('landings.military.layouts.default')

@section('scripts')
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-102566183-21"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-102566183-21');
  </script>


  <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1764971083589713');
    fbq('track', 'PageView');
    fbq('track', 'Lead');
  </script>
  <noscript><img height="1" width="1" style="display:none"
                 src="https://www.facebook.com/tr?id=1764971083589713&ev=PageView&noscript=1"
    /></noscript>
  <!-- End Facebook Pixel Code -->
@stop


@section('article')
  <!-- Article -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-push-6 col-lg-6 col-lg-push-6">
          <header>
            <h1 class="article__title"><b class="accent">Защитное стекло для твоего смартфона,</b>  покупай вместе с чехлом и получай скидку</h1>
            <p class="aricle__description"></p>
          </header>
          <figure class="visible-xs">
            <img class="article__img" src="{{ Storage::url($product->image_upsale) }}" alt="Противоударные чехлы для телефонов Samsung | Extrasale.in.ua" width="" height="">
          </figure>
          <div class="box-offer">
            <footer>
              <p class="product__price">Цена: <mark><b class="accent">{{$product->price_upsale_new}}<span>грн</span></b></mark><span class="old-price">{{$product->price_upsale}}<span>грн</span></span></p>
              <div class="section__block__special__offer">
                <form action="upsale" method="post" id="special__offer__form__offer__first">
                  <input type="hidden" name="phone" value="{{$phone}}">
                  <button class="actions-entry actions-entry__buy actions-entry__item--green">Получить скидку</button>
                </form><!-- #form special__offer__form -->

                <form action="notupsale" method="post" id="special__offer__form__offer__first">
                  <input type="hidden" name="phone" value="{{$phone}}">
                  <button class="actions-entry actions-entry__buy actions-entry__item--red">Нет, спасибо</button>
                </form><!-- #form special__offer__form -->
              </div>
            </footer>
          </div>
        </div>
        <div class="col-sm-6 col-sm-pull-6 col-lg-6 col-lg-pull-7">
          <figure class="hidden-xs">
            <img class="article__img" src="{{ Storage::url($product->image_upsale) }}" alt="Противоударные чехлы для телефонов Samsung | Extrasale.in.ua" width="" height="">
          </figure>
        </div>
      </div><!-- #End row class-->
    </div><!-- #End container class-->
  </article><!-- #End article semantic-->
@stop

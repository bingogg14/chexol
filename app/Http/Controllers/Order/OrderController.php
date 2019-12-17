<?php

namespace App\Http\Controllers\Order;

use App\Models\Product\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function createlo(Request $request, $slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $pattern = "/^\+38\s\(\d{3}\)\s\d{3}\-\d{2}\-\d{2}$/"; // Pattern Check Number
        $token = "242437557:AAHaRf-ibPffEoDfJTmk70fYNYt4JVQb2OY";
        $chat_id = "-312490257";
        if (isset($request['phone']) && preg_match($pattern, $request['phone'])) {
            $phone  = $request['phone'];
            $site   = $_SERVER['HTTP_HOST'];
            $siteip = $_SERVER['REMOTE_ADDR'];
            if (isset($request['name'])) {$name = $request['name'];}

            /**
             ***************** SEND EMAIL ******************
             **/
            $address  = 'admin@extrasale.in.ua';
            $mes = "Тема: Заказ ".$product->title." \nТелефон: $phone";
            $sub="Заказ ".$product->title;
            $email='zakaz@admin.ua';
            $send = mail ($address,$sub,$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
            /**
             ***************** #SEND EMAIL END ******************
             **/

            /**
             ***************** SEND TELEGRAM BOT ******************
             **/
            $link_phone = $result = preg_replace("/[^,.0-9]/", '', $phone);
            $link_phone = substr_replace($link_phone, null, 0, 2);
            $mesTelegram = "<b>Тема:</b> ".$product->title." %0A"."<b>Телефон: </b>".$link_phone."%0A<b>Slug: </b>".$product->slug."%0A";
            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$mesTelegram}","r");
            /**
             ***************** #SEND TELEGRAM END ******************
             **/
            /**
             ***************** SEND LP CRM ******************
             **/
            //***************** Страница с завершением заказа ******************


            // формируем массив с товарами в заказе (если товар один - оставляйте только первый элемент массива)
            $products_list = array(
                0 => array(
                    'product_id' => $product->lp_product_id,    //код товара 7 (из каталога CRM)
                    'count'      => '1',    //количество товара 1
                ),
            );
            $products = urlencode(serialize($products_list));
            $sender = urlencode(serialize($_SERVER));
            // параметры запроса
            $data = array(
                'key'             => '2c6b6886af907b2e803759613c673067', //Ваш секретный токен
                'order_id'        => number_format(round(microtime(true)*10),0,'.',''), //идентификатор (код) заказа (*автоматически*)
                'country'         => 'UA',                         // Географическое направление заказа
                'office'          => '1',                          // Офис (id в CRM)
                'products'        => $products,                    // массив с товарами в заказе
                'bayer_name'      => $request['name'],            // покупатель (Ф.И.О)
                'phone'           => $phone,           // телефон
                'email'           => $request['email'],           // электронка
                'comment'         => $request['product_name'],    // комментарий
                'delivery'        => 1,                            // способ доставки (id в CRM)
                'delivery_adress' => $request['delivery_adress'], // адрес доставки
                'payment'         => 4,                           // вариант оплаты (id в CRM)
                'sender'          => $sender,
                //'utm_source'      => $_SESSION['utms']['utm_source'],  // utm_source
                //'utm_medium'      => $_SESSION['utms']['utm_medium'],  // utm_medium
                //'utm_term'        => $_SESSION['utms']['utm_term'],    // utm_term
                //'utm_content'     => $_SESSION['utms']['utm_content'], // utm_content
                //'utm_campaign'    => $_SESSION['utms']['utm_campaign'],// utm_campaign
                'additional_1'    => '',                               // Дополнительное поле 1
                'additional_2'    => '',                               // Дополнительное поле 2
                'additional_3'    => '',                               // Дополнительное поле 3
                'additional_4'    => ''                                // Дополнительное поле 4
            );

            // запрос
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://extrasale.lp-crm.top/api/addNewOrder.html');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $out = curl_exec($curl);
            curl_close($curl);

            if ($product->image_upsale > "") {
                return view('landings.military.pages.product.upsale', compact(['product', 'phone']));
            } else {
                return view('landings.military.pages.product.thanks')->with('phone', $phone);
            }
        } else {
            return view('landings.military.pages.product.error');
        }
    }

    public function upsale(Request $request, $slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $pattern = "/^\+38\s\(\d{3}\)\s\d{3}\-\d{2}\-\d{2}$/"; // Pattern Check Number
        $token = "242437557:AAHaRf-ibPffEoDfJTmk70fYNYt4JVQb2OY";
        $chat_id = "-312490257";
        if (isset($request['phone']) && preg_match($pattern, $request['phone'])) {
            $phone  = $request['phone'];
            $site   = $_SERVER['HTTP_HOST'];
            $siteip = $_SERVER['REMOTE_ADDR'];
            if (isset($request['name'])) {$name = $request['name'];}

            /**
             ***************** SEND EMAIL ******************
             **/
            $address  = 'admin@extrasale.in.ua';
            $mes = "Тема: Заказ Защитное Стекло для ".$product->title." \nТелефон: $phone";
            $sub="Заказ ".$product->title;
            $email='zakaz@admin.ua';
            $send = mail ($address,$sub,$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
            /**
             ***************** #SEND EMAIL END ******************
             **/

            /**
             ***************** SEND TELEGRAM BOT ******************
             **/
            $link_phone = $result = preg_replace("/[^,.0-9]/", '', $phone);
            $link_phone = substr_replace($link_phone, null, 0, 2);
            $mesTelegram = "<b>Тема:</b> Защитное Стекло для ".$product->title." %0A"."<b>Телефон: </b>".$link_phone."%0A<b>Slug: </b>".$product->slug."%0A";
            $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$mesTelegram}","r");
            /**
             ***************** #SEND TELEGRAM END ******************
             **/
            /**
             ***************** SEND LP CRM ******************
             **/
            //***************** Страница с завершением заказа ******************


            // формируем массив с товарами в заказе (если товар один - оставляйте только первый элемент массива)
            $products_list = array(
                0 => array(
                    'product_id' => $product->lp_product_id_upsale,    //код товара 7 (из каталога CRM)
                    'count'      => '1',    //количество товара 1
                ),
            );
            $products = urlencode(serialize($products_list));
            $sender = urlencode(serialize($_SERVER));
            // параметры запроса
            $data = array(
                'key'             => '2c6b6886af907b2e803759613c673067', //Ваш секретный токен
                'order_id'        => number_format(round(microtime(true)*10),0,'.',''), //идентификатор (код) заказа (*автоматически*)
                'country'         => 'UA',                         // Географическое направление заказа
                'office'          => '1',                          // Офис (id в CRM)
                'products'        => $products,                    // массив с товарами в заказе
                'bayer_name'      => "Защитное Стекло для" . $request['name'],            // покупатель (Ф.И.О)
                'phone'           => $phone,           // телефон
                'email'           => $request['email'],           // электронка
                'comment'         => "Защитное Стекло для" . $request['product_name'],    // комментарий
                'delivery'        => 1,                            // способ доставки (id в CRM)
                'delivery_adress' => $request['delivery_adress'], // адрес доставки
                'payment'         => 4,                           // вариант оплаты (id в CRM)
                'sender'          => $sender,
                'additional_1'    => '',                               // Дополнительное поле 1
                'additional_2'    => '',                               // Дополнительное поле 2
                'additional_3'    => '',                               // Дополнительное поле 3
                'additional_4'    => ''                                // Дополнительное поле 4
            );

            // запрос
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'http://extrasale.lp-crm.top/api/addNewOrder.html');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $out = curl_exec($curl);
            curl_close($curl);
            return view('landings.military.pages.product.thanks')->with('phone', $phone);
        } else {
            return view('landings.military.pages.product.error');
        }
    }

    public function notupsale(Request $request, $slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        $pattern = "/^\+38\s\(\d{3}\)\s\d{3}\-\d{2}\-\d{2}$/"; // Pattern Check Number
        if (isset($request['phone']) && preg_match($pattern, $request['phone'])) {
            $phone  = $request['phone'];
            return view('landings.military.pages.product.thanks')->with('phone', $phone);
        } else {
            return view('landings.military.pages.product.error');
        }
    }

    public function error(Request $request, $slug) {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('landings.military.pages.product.error');
    }
}

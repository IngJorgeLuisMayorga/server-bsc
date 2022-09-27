<?php
$HOST = 'http://ec2-3-131-94-227.us-east-2.compute.amazonaws.com/server-bsc/public';
?>

@extends('emails.shared.layout')


@section('user_name')
    <h1
        style="
    @if ($status === 's1_ordered') background-color: #F7C0CD;
    @elseif ($status === 's2_shipped')
        background-color: #FFF6C2; 
    @elseif ($status === 's3_delivered')
        background-color: #C1E9F4;
    @else @endif
    padding: 5px 35px; font-weight: 300; width:fit-content; font-size:24px; margin:0 0 20px 0;">
        <strong style="font-weight: 600;">¡Gracias por tu compra </strong> <br> {{ $order->user_name }} !
    </h1>
@stop


@section('order_date')

    <h5 class="label--ref"># {{ $order->id }}</h5>

    <h4 class="label--date">
        @if ($status === 's1_ordered')
            <strong>Pedido recibido</strong> {{ date('d F , Y', strtotime($order->updated_at)) }}
        @elseif ($status === 's2_shipped')
            <strong>Pedido enviado</strong> {{ date('d F , Y', strtotime($order->updated_at)) }}
        @elseif ($status === 's3_delivered')
            <strong>Pedido entregado</strong> {{ date('d F , Y', strtotime($order->updated_at)) }}
        @else
        @endif
    </h4>

    <div class="label--status">
        @if ($status === 's1_ordered')
            <img width="100%" src="{{ $HOST . '/images/emails/status__ordered_1.svg' }}">
        @elseif ($status === 's2_shipped')
            <img width="100%" src="{{ $HOST . '/images/emails/status__shipping.png' }}">
        @elseif ($status === 's3_delivered')
            <img width="100%" src="{{ $HOST . '/images/emails/status__delivered.png' }}">
        @else
        @endif
    </div>

@stop


@section('order_products')
    @foreach ($products as $item)
        <tr style="padding-top: 0px;">
            <td>
                <img src="{{ $item->image1_src }}" style="width: 120px; heigth:120px;">
            </td>
            <td>
                <table>
                    <tr style="vertical-align:top">
                        <td class="tg-0lax" colspan="3">
                            <h1 style="padding-left:10px; font-size: 16px;text-align: left;font-weight: 300; margin:0px; padding-bottom: 0px;">
                                {{ $item->name }}
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="3">
                            <h2 style="padding:0px; margin:0px; padding-left:10px; font-size: 18px; text-align: left;">
                                @if ($item->quantity > 0)
                                    <span style="font-size: 16px;"> {{ $item->quantity }} x </span>
                                @endif
                                @money($item->price * (1 - 0.01 * $item->discount))
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="tg-0lax" colspan="3">
                            <h2 style="  text-decoration: line-through; padding:0px; margin:0px; padding-left:10px; font-size: 14px; text-align: left; font-weight: 300; ">
                                @money($item->price)
                            </h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    @endforeach
@stop



@section('order_total')
    @if ($status === 's1_ordered')
        <tr style="padding-top: 0px;">
            <td style="width:33%"> </td>
            <td  style="width:33%"> </td>
            <td  style="width:33%; text-align: right"> 
                <div class="box box-pink" style="width: 100%; max-width:100%; padding-right: 90px">
                    <h1 style="background-color: #F7C0CD;border:1px solid black;
                        padding: 5px 35px; font-weight: 300; width:fit-content; font-size:24px; margin:0 0 20px 0;    
                        font-weight: 300; font-size:30px">
                        Total<strong> @money($order->order_total) </strong>
                    </h1>
                </div>
                <h2 style="font-weight: 600; font-size: 16px; padding-right: 19px;">Yay! Tienes envio gratis! </h2>
            </td>
        </tr>
    @elseif ($status === 's2_shipped')
        <tr style="padding-top: 0px;">
            <td  colspan="3" style="width:100%; text-align: right"> 
                <div class="box" style="
                    padding-right: 0px;   
                    background-color: #FFF6C2;
                    border:1px solid black;">
                    <h1 style="
                        text-align:center;
                        padding: 5px 35px; 
                        font-weight: 300; 
                        width:fit-content; 
                        font-size:24px; 
                        margin: 0 auto;   
                        font-weight: 300; 
                        display: -ms-flexbox;
                        display: -webkit-flex;
                        display: flex;
                        -webkit-flex-direction: row;
                        -ms-flex-direction: row;
                        flex-direction: row;
                        -webkit-flex-wrap: nowrap;
                        -ms-flex-wrap: nowrap;
                        flex-wrap: nowrap;
                        -webkit-justify-content: center;
                        -ms-flex-pack: center;
                        justify-content: center;
                        -webkit-align-content: center;
                        -ms-flex-line-pack: center;
                        align-content: center;
                        -webkit-align-items: center;
                        -ms-flex-align: center;
                        align-items: center;
                        ">
                        ¡Gracias por visitar 
                        <strong style="padding-left: 5px"> 
                            bubblesskincare.com 
                        </strong>
                    </h1>
                    <h2 style="font-weight: 300; 
                    font-size: 14px; padding-right: 0px;text-align:center;
                    ">
                        Tu pedido está en camino. Hemos enviado tu(s) producto(s)
                        a través de la empresa transportadora “Envía”
                        y este es tu número de guía
                    </h2>
                    <div style="width: fit-content;
                    margin: 0 auto;
                    margin-bottom: 10px;
                    text-align:center; padding:5px; background-color: black; color: white">
                        GUIA # {{ $order->shipping_guide_ref }} {{ $order->shipping_guide_company }}
                    </div>
                </div>
            </td>
        </tr>
    @elseif ($status === 's3_delivered')
    <tr style="padding-top: 0px;">
        <td  colspan="3" style="width:100%; text-align: right"> 
            <div class="box" style="
                padding-right: 0px;   
                background-color: #C1E9F4;
                border:1px solid black;">
                <h1 style="
                    text-align:center;
                    padding: 5px 35px; 
                    font-weight: 300; 
                    width:fit-content; 
                    font-size:24px; 
                    margin: 0 auto;   
                    font-weight: 300; 
                    display: -ms-flexbox;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-flex-direction: row;
                    -ms-flex-direction: row;
                    flex-direction: row;
                    -webkit-flex-wrap: nowrap;
                    -ms-flex-wrap: nowrap;
                    flex-wrap: nowrap;
                    -webkit-justify-content: center;
                    -ms-flex-pack: center;
                    justify-content: center;
                    -webkit-align-content: center;
                    -ms-flex-line-pack: center;
                    align-content: center;
                    -webkit-align-items: center;
                    -ms-flex-align: center;
                    align-items: center;
                    ">
                    ¡Gracias por visitar 
                    <strong style="padding-left: 5px"> 
                        bubblesskincare.com 
                    </strong>
                </h1>
                <h2 style="font-weight: 300; 
                font-size: 14px; padding-right: 0px;text-align:center;
                ">
                    Recuerda que con cada compra en BSC acumulas #BubblePoints
                    redimibles 100% en productos de K-beauty, disfruta tu(s) producto(s)
                    y esperamos verte de nuevo <strong>
                        #BubbleLover 
                    </strong> <img src="{{ $HOST.'/images/emails/3CORAZONES.png' }}" alt="">
                </h2>
            </div>
            <br>
            <br>
            @include('emails.shared.ad')
        </td>
    </tr>
    @else 
    @endif
<tr style="width:400px; background-size: 100% auto;">
    <td style="width:50%;text-align: left">
        <div style="border:1px dotted black" >
            <h1 style="width: 170px;font-size:20px;  font-weight:300; padding-left: 10px">
                Datos de <strong style="font-weight:600; padding-right: 10px">entrega</strong>
            </h1>
        </div>
        <ul style="list-style-type: none; padding: 0; margin: 0; padding-left: 0.5em; border-bottom:1px dotted black">
            <br>
           <li style="font-weight: 300"> <strong>Nombre: </strong> {{ $order->user_name }}</li>
           <li style="font-weight: 300"> <strong>Ciudad: </strong> {{ $order->shipping_city }} </li>
           <li style="font-weight: 300"> <strong>Dirección: </strong> {{ $order->shipping_address }}</li>
           <li style="font-weight: 300"> <strong>Telefono: </strong> {{ $order->shipping_phone }}</li>
           <br>
       </ul>
       <br>
    </td>
    <td  style="width:50%"> </td>
</tr>
<tr style="width:100%;">
    <td colspan="1" style="width:100%; text-align: left; vertical-align: top;">
        <h1 style=" text-align: left; font-weight: 300; font-size:16px;">Puntos acumulados</h1>
            @if ($status === 's1_ordered')
             <h1 style="    width: fit-content; text-align: left; font-size:16px;background-color:#F7C0CD; font-weight:900; border-bottom: 1px dotted black;">{{ $order->order_points }} Bubble Points</h1>
            @elseif ($status === 's2_shipped')
             <h1 style="    width: fit-content; text-align: left; font-size:16px;background-color:#FFF6C2; font-weight:900; border-bottom: 1px dotted black;">{{ $order->order_points }}Bubble Points</h1>
            @elseif ($status === 's3_delivered')
             <h1 style="    width: fit-content; text-align: left; font-size:16px;background-color:#C1E9F4; font-weight:900;">{{ $order->order_points }} Bubble Points</h1>
            @else
            @endif
    </td>
    <td colspan="2">
        <br>
        <br>
        @if ($status === 's1_ordered')
        <img src="{{ $HOST.'/images/emails/CAJAROSADACORREO.jpg' }}" width="150px">
        @elseif ($status === 's2_shipped')
        <img src="{{ $HOST.'/images/emails/CAJAAMARILLACORREO.jpg' }}"  width="150px">        
        @elseif ($status === 's3_delivered')
        <img src="{{ $HOST.'/images/emails/CAJAAZULCORREO.jpg' }}" width="150px">       
         @else
        @endif
       
    </td>
</tr>
@stop



@section('content')
    @php
        $HOST = 'http://ec2-3-131-94-227.us-east-2.compute.amazonaws.com/server-bsc/public';
    @endphp

@stop

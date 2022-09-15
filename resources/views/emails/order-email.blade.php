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
            <img src="{{ $HOST . '/images/emails/status__ordered_1.svg' }}">
        @elseif ($status === 's2_shipped')
            <img src="{{ $HOST . '/images/emails/status__shipping.png' }}">
        @elseif ($status === 's3_delivered')
            <img src="{{ $HOST . '/images/emails/status__delivered.png' }}">
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
<tr style="padding-top: 0px;">
    <td style="width:33%"> </td>
    <td  style="width:33%"> </td>
    <td  style="width:33%; text-align: right"> 
        <div class="box box-pink" style="width: 100%; max-width:100%; padding-right: 90px">
            <h1 style="
                    @if ($status === 's1_ordered') background-color: #F7C0CD;
                    @elseif ($status === 's2_shipped')
                        background-color: #FFF6C2; 
                    @elseif ($status === 's3_delivered')
                        background-color: #C1E9F4;
                    @else @endif
                border:1px solid black;
                padding: 5px 35px; font-weight: 300; width:fit-content; font-size:24px; margin:0 0 20px 0;    
                font-weight: 300; font-size:30px">
                Total<strong> @money($order->order_total) </strong>
            </h1>
        </div>
        <h2 style="font-weight: 600; font-size: 16px; padding-right: 19px;">Yay! Tienes envio gratis! </h2>
    </td>
</tr>
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
@stop



@section('content')
    @php
        $HOST = 'http://ec2-3-131-94-227.us-east-2.compute.amazonaws.com/server-bsc/public';
    @endphp

@stop

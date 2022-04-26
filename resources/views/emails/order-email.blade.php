<?php
    $HOST = 'http://ec2-3-131-94-227.us-east-2.compute.amazonaws.com/server-bsc/public';
?>
<table class="email" cellspacing="0">

  <tr class="email--header pink">
    <td colspan="3">
        <h1> Holaaa </h1>
        <img src="{{ $HOST . '/images/emails/bsc_subline.png' }}">
    </td>
  </tr>

  <tr class="email--top pink">
    <td colspan="3">

            @if ($status === 'ORDERED')
                <div class="box box-pink">
                <h1>¡Gracias por tu compra</h1>
                <h2>{{ $user->name }}!</h2>
                </div>
            @elseif ($status === 'SHIPPED')
                <div class="box box-yellow">
                <h1>¡Tu pedido ha sido enviado</h1>
                <h2>{{ $user->name }}!</h2>
                </div>
            @elseif ($status === 'DELIVERED')
                <div class="box box-blue">
                <h1>¡Tu pedido ha sido entregado</h1>
                <h2>{{ $user->name }}!</h2>
                </div>
            @else
                
            @endif

       
    </td>
  </tr>

  <tr class="email--middle pink" style="width:400px">
    <td colspan="3" style="width: 100%;padding: 20px 60px;">
        
        <h5 class="label--ref"># {{ 18032 + $invoice->id}}</h5>
       
        @php
            setlocale(LC_TIME, 'es_ES', 'Spanish_Spain', 'Spanish'); 
        @endphp

      

        @if ($status === 'ORDERED')
                <h4 class="label--date"><strong>Pedido recibido</strong>  {{ date('d F , Y', strtotime($invoice-> updated_at)) }} </h4>
            @elseif ($status === 'SHIPPED')
                <h4 class="label--date"><strong>Pedido enviado</strong>  {{ date('d F , Y', strtotime($invoice-> updated_at)) }}</h4>
            @elseif ($status === 'DELIVERED')
                <h4 class="label--date"><strong>Pedido entregado</strong>  {{ date('d F , Y', strtotime($invoice-> updated_at)) }} </h4>
            @else
                
        @endif

        <div class="label--status">
          
            @if ($status === 'ORDERED')
                <img src="{{ $HOST . '/images/emails/status__ordered_1.svg' }}">
            @elseif ($status === 'SHIPPED')
                <img src="{{ $HOST . '/images/emails/status__shipping.png' }}">
            @elseif ($status === 'DELIVERED')
                <img src="{{ $HOST . '/images/emails/status__delivered.png' }}">
            @else
                
            @endif
           
        </div>

   

        <table style="padding-top: 50px">

            @foreach ($products as $item)
         
                <tr style="padding-top: 50px;">
                    <td colspan="1" style="vertical-align: top ;     position: relative;">
                        <img  src="{{$item->image1_src}}" style="width: 120px; heigth:120px;">
                        @if ($item->discount > 0)
                            <span style="
                                    display: block;
                                    position: absolute;
                                    background-color: white;
                                    border: 1px solid black;
                                    width: 43px;
                                    text-align: center;
                                    padding-top: 4px;
                                    border-radius: 0px;
                                    padding-bottom: 3px;
                                    font-weight: 600;
                                    top: 72px;
                                    left: 59px;
                                    text-align: center;
                                    padding-right: 0.5em;
                                    padding-left: 1em;
                        ">{{ $item->discount }} % </span>
                        @endif
                        <label style="
                        display: block;
                        position: absolute;
                        background-color: white;
                        border: 1px solid black;
                        width: 1.5em;
                        text-align: center;
                        padding-top: 4px;
                        border-radius: 17px;
                        padding-bottom: 3px;
                        font-weight: 600;
                        top: -10px;
                        left: -10px;">{{ $loop->index }}</label>
                    </td>
                    <td colspan="2" style="vertical-align: top; padding-top: 0px;">
                        <h1 style="font-size: 20px;text-align: left;font-weight: 300; padding-bottom: 0px;">
                            {{  $item->name }}
                        </h1>
                        @if ($item->discount > 0)
                            <h2 style="font-size: 30px; text-align: left;">
                                @if ($item->quantity > 1)
                                 <span style="font-size: 20px;">{{ $item->quantity}} x </span>
                                @endif
                                  @money($item->price * (1 - 0.01*$item->discount ))
                            </h2>
                            <h3 style="
                            padding:0px;
                            margin:0px;
                            padding-
                            font-weight:300;
                            font-size: 20px; 
                            text-align: left; 
                            text-decoration: line-through;
                            padding-left: 6px;
                            ">  @money($item->price)  </h3>
                        @else
                            <h2 style="
                            font-size: 30px; 
                            text-align: left;
                            ">
                                @money($item->price)
                            </h2>
                        @endif
                    </td>
                </tr>

            @endforeach

            <tr>
                <td colspan="2">
                    
                </td>
                <td colspan="1">
                    <div style="position: relative; left: 55px">

                     
                        @if ($status === 'ORDERED')
                        <div class="box box-pink" style="width: 100%; max-width:100%; padding-right: 90px">
                            <h1 style="font-weight: 300; font-size:30px">Total<strong> @money($invoice->total) </strong> </h1>
                        </div>

                        @elseif ($status === 'SHIPPED')
                        <div class="box box-yellow" style="width: 100%; max-width:100%; padding-right: 90px">
                            <h1 style="font-weight: 300; font-size:30px">Total<strong> @money($invoice->total) </strong> </h1>
                        </div>

                        @elseif ($status === 'DELIVERED')
                        <div class="box box-blue" style="width: 100%; max-width:100%; padding-right: 90px">
                            <h1 style="font-weight: 300; font-size:30px">Total<strong> @money($invoice->total) </strong> </h1>
                        </div>

                        @else
                            
                        @endif

                        <h2 style="font-weight: 600; font-size: 24px;">Yay! Tienes envio gratis! </h2>
                    </div>
                </td>
            </tr>

        </table>



    </td>
  </tr>

  <tr class="email--middle pink" style="width:400px">
    <td colspan="3" style="width: 100%;padding: 20px 60px;">
        <div style="border:1px dotted black" >
            <h1 style="
                width: 170px;
                font-size:20px; 
                font-weight:300;
            "
            >Datos de <strong style="font-weight:600">entrega</strong> </h1>
        </div>
    </td>
  </tr>

    <tr class="email--middle pink" style="width:400px">
        <td colspan="3" style="width: 100%;padding: 20px 60px;">
            <ul style="list-style-type: none; padding: 0; margin: 0; padding-left: 0.5em;">
                 <br>
                <li style="font-weight: 300"> <strong>Nombre: </strong> {{ $user->name }}</li>
                <li style="font-weight: 300"> <strong>Documento: </strong> {{ $user->nid_type }} {{ $user->nid_number}}</li>
                <li style="font-weight: 300"> <strong>Ciudad: </strong> {{ $user->city }} </li>
                <li style="font-weight: 300"> <strong>Dirección: </strong> {{ $user->address }}</li>
                <li style="font-weight: 300"> <strong>Telefono: </strong> {{ $user->phone }}</li>
            </ul>
     
            <br>
            <div style="width: 120px; heigth:1px; border:1px dotted black"></div>
            <br>
     
            <h1 style=" text-align: left; font-weight: 300; font-size:16px;">Puntos acumulados</h1>
     
         
            @if ($status === 'ORDERED')
             <h1 style="    width: fit-content; text-align: left; font-size:16px;background-color:#F7C0CD; font-weight:900">313 Bubble Points</h1>
            @elseif ($status === 'SHIPPED')
             <h1 style="    width: fit-content; text-align: left; font-size:16px;background-color:#FFF6C2; font-weight:900">313 Bubble Points</h1>
            @elseif ($status === 'DELIVERED')
             <h1 style="    width: fit-content; text-align: left; font-size:16px;background-color:#C1E9F4; font-weight:900">313 Bubble Points</h1>
            @else
                
            @endif
            
            <br>
            <div style="width: 120px; heigth:1px; border:1px dotted black"></div>
            <br>
     
            <h1 style=" text-align: left; font-weight: 300; font-size:16px;">Metodo de pago</h1>
            <h1 style=" text-align: left; font-weight: 300; font-size:16px;">Bancolombia</h1>
         </td>
    </tr>

    
  <tr class="email--bottom pink">
    <td colspan="3" style="height: 270px;">
        
        <br>
        <br>
    </td>
  </tr>

 

</table>

<div class="email">

    <h1 style="font-weight: 300; font-size: 24px">¡Gracias por visitar <strong> bubblesskincare.com! </strong></h1>
    <p style="font-weight: 300; font-size: 18px; text-align: center">
        Tu pedido será enviado al siguiente día hábil del pago, 
        recibirás un correo electrónico cuando tu pedido sea enviado 
        y puedes hacerle seguimiento con el número de guía.
    </p>

</div>


<div class="footer-container">
<table style="width: 600px; margin: 0 auto">
    <tr class="footer">
        <td colspan="2" style="width:50%;text-align:right">
                <img src="/images/footer/BSC LOGO.png" style="width: 100%;
MAX-WIDTH: 250px;
margin: 0 auto;">
        </td>
        <td colspan="2" 
        style="width:50%;text-align:left; vertical-align:bottom"
        >
            <h1 style="text-align:left; font-size:18px; padding-top:8px">© 2022 BSC | Bubbles Skin Care</h1>
            <h2 style="text-align:left; font-size:18px; padding-top:8px" >Todos los derechos reservados.</h2>
            <ul>
                <li>
                    <a href="">
                        <img src="/images/footer/FB BLANCO.png">
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="/images/footer/IG BLANCO.png">
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="/images/footer/TK BLANCO.png">
                    </a>
                </li>
            </ul>
        </td>
    </tr>
</table>
</div>


<style>
.footer-container{
    font-family: 'Helvetica';
        color:white;
        background-color: #333;
        background-size: cover;
        background-position: center;
        width: 100%;
        margin: 0 auto;
}
    table.footer{
        font-family: 'Helvetica';
        color:white;
        background-color: #333;
        background-size: cover;
        background-position: center;
        width: 600px;
        margin: 0 auto;
    }
    .footer{
        font-family: 'Helvetica';
        color:white;
        background-color: #333;
        background-size: cover;
        background-position: center;
   
    }
    .footer ul{
        list-style-type: none; /* Remove bullets */
        padding: 0; /* Remove padding */
        margin: 0; /* Remove margins */

        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: row;
        -ms-flex-direction: row;
        flex-direction: row;
        -webkit-flex-wrap: nowrap;
        -ms-flex-wrap: nowrap;
        flex-wrap: nowrap;
        -webkit-justify-content: space-around;
        -ms-flex-pack: distribute;
        justify-content: space-around;
        -webkit-align-content: center;
        -ms-flex-line-pack: center;
        align-content: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;

        padding-bottom:1em;

    }

    .footer h1{
        padding-left:1em;
        font-size: 22px;
        padding-top: 1em;
        padding-bottom: 0.5em;
        margin: 0px;
    }
    
    .footer h2{
        padding-left:1em;
        font-size: 22px;
        padding-top: 1em;
        padding-bottom: 0.5em;
        margin: 0px;
}
</style>




<style>

    
    .email--top{
        background-color: #fff;
        height: fit-content;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100% auto;
        position: relative;
    }

    .email--middle{
        
        background-color: #fff;
        height: fit-content;
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        position: relative;
    }

    .email--bottom{
        
        background-color: #fff;
        height: fit-content;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }

    .email--top.pink{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_top.png' }}");
    }
    .email--middle.pink{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_middle.png' }}");
    }
    .email--bottom.pink{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_bottom.png' }}");
    }

    .email--top.yellow{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_top.png' }}");
    }
    .email--middle.yellow{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_middle.png' }}");
    }
    .email--bottom.yellow{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_bottom.png' }}");
    }

    .email--top.blue{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_top.png' }}");
    }
    .email--middle.blue{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_middle.png' }}");
    }
    .email--bottom.blue{
        background-image: url("{{ $HOST . '/images/emails/bsc_bg_bottom.png' }}");
    }

    .label--status, .label--status img{
        width: 100%;
    }
    .label--date{
        font-weight: normal;
    }
    .label--date strong{
        font-weight: bold;
    }
</style>


<!-- Style::Table -->
<style>
    .email--top{}
    .email--top .box{
        max-width: 300px;
        padding: 0px;
    }
    .email--top h1{
        font-weight: bold;
        font-size: 24px;
        margin: 0 auto;
        padding: 8px 0px;
        width: fit-content;
    }
    .email--top h2{
        font-weight: normal;
        font-size: 18px;
        margin: 0 auto;
        padding: 8px 0px;
        width: fit-content;
    }
</style>

<!-- Style::Header -->
<style>
    
    .email{
        width: 100%;
        max-width: 500px;
        margin:0px auto;
        padding:0px;
        color: #333333;
    }
    
    .email--header{

    }
    .email--header h1{
        display:block;
        width: 100%;
        margin:0px;
        padding:16px 8px;
        text-align: center;

        font-size: 72px;
    }
    .email--header img{
        display:block;
        width: 100%;
        max-width: 150px;
        margin:0px auto;
        padding:0px;
        padding-bottom: 16px;
    }

</style>

<!-- Style::Box -->
<style>
    .box{
        display: block;
        width: 100%;
        max-width: 200px;
        margin: 0 auto;
        border: 1px solid #333333;
    }
    .box-pink{
        background-color: #F7C0CD;
    }
    .box-yellow{
        background-color: #FFF6C2;
    }
    .box-blue{
        background-color: #C1E9F4;
    }
</style>

<!-- Style::Fonts -->
<style>
    /**
    // Fonts
    */   
    @font-face {
            font-family: 'Roboto';
            src: url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
    } 
    .email{
        width: 100%;
        max-width: 600px;
        margin:0 auto;
        font-family: 'Roboto', sans-serif;
    }

    h1,h2 {
        display:block;
        width: 100%;
        margin:0px;
        padding:8px 8px;
        text-align: center;
        font-size: 48px;
    }
    
</style>
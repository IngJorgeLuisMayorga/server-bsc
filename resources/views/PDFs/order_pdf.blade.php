<!DOCTYPE html>
<html lang="es">
<head>
    <title>BSC Invoice</title>
    <meta name="description" content="Our first page">
    <meta name="keywords" content="html tutorial template">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;0,700;0,900;1,300&display=swap');
        header h1,header h2, header h3, header h4,header h5{
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            text-align: right;
            font-weight: 400;
        }
        header{
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-flex-direction: row;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-flex-wrap: nowrap;
            -ms-flex-wrap: nowrap;
            flex-wrap: nowrap;
            -webkit-justify-content: space-between;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-align-content: stretch;
            -ms-flex-line-pack: stretch;
            align-content: stretch;
            -webkit-align-items: flex-start;
            -ms-flex-align: start;
            align-items: flex-start;
        }
        header .col1{}
        header .col2{
           
        }
        header .col1 img{
            width: 250px;
        }
        header h2.title, footer h2.title{
            font-size: 16px;
            font-weight: 700;
        }
        main, footer{
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            font-weight: 400;
        }
        .products-title{
            color: black;
            font-weight: 500;
            background-color: rgb(214, 214, 214);
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            margin: 0px;
            font-size: 16px;
            padding: 5px;
            margin-top: 25px;
        }
        .products-total{
            color: black;
            font-weight: 500;
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            margin: 0px;
            font-size: 16px;
            padding: 5px;
            margin-top: 25px; 
        }
        .products-total strong{
            font-weight: 900;
        }

        .shipping-title{
            color: black;
            font-weight: 500;
            background-color: rgb(214, 214, 214);
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            margin: 0px;
            font-size: 16px;
            padding: 5px;
            margin-top: 25px;
        }

        footer h1,footer h2, footer h3, footer h4,footer h5{
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
            padding: 0px;
            margin: 0px;
            font-size: 14px;
            text-align: left;
            font-weight: 400;
        }

        main, header,footer{
            padding: 0em;
            width: 100%;
            box-sizing: border-box;
            font-family: system-ui;
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
    <body>

        <header>
            <div class="col1">
                <img src="data:image/png;base64,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">
            </div>
            <div class="col2">
                <h2 class="title">{{ ucfirst($fecha->translatedFormat('F')) }} / {{ $fecha->year }}</h2>
                <h5>#{{ sprintf('%02d', ($order->id)) }}</h5>
                <h5>{{ $order->updated_at }}</h5>
                <h5>{{ $order->user_email }}</h5>
                <h5>W: {{ $order->payment_wompi_id }} </h5>

            </div>
        </header>

        
        <!-- Wrap the subject matter content of your PDF inside a main tag -->
        <main>

            <h1 class="products-title">Productos</h1>
            <br>

            <div style="page-break-after: avoid;">

                @foreach ($products as $product)
                   1 X  _____ {{ $product['name'] }}
                   <br>
                @endforeach
                

            </div>

            <div style="margin-top:25px; border-bottom: 1px dotted black; width: 10em; heigth:1px; background-color:rgb(255, 255, 255)"></div>

            <h1 class="products-total">
                Total <strong>{{ count($products)}} productos<strong>
            </h1>

            <br>
            <br>
            <br>




        </main>

        <footer>
            <h2 class="shipping-title">
                Envío
            </h2>
            <br>
            <h2 class="title">{{ $order->shipping_city}}</h2>
            <h5>{{ $order->user_name}}</h5>
            <h5>{{ $order->shipping_address}}</h5>
            <h5>{{ $order->shipping_phone}}</h5>
        </footer>



    </body>
</html>
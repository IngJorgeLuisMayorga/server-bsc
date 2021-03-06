<html>
    <head>
        <style>
            /** 
                Set the margins of the pdf page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every pdf page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;

                background-color: #f4bece;
                color: #333333;
                width: 100%;

            }

            header h1 {
                margin:0px;
                padding:0px;
                text-align: center;
                width: 100%;
                padding:1em 0em;
                font-family: 'Helvetica';
                font-size: 24px;
            }

            /** Define the footer rules **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;

                font-family: 'Helvetica';
                background-color: #333;
                background-size: cover;
                background-position: center;
                width: 100%;

                color:white;
      
            }
        </style>
    </head>
    <body>

        <header>
            <!-- <img src="{{url('/pdfs/order/header.png')}}" width="100%" height="100%"/> -->
            <h1> BSC </h1>
        </header>

        <footer>
            <!-- <img src="{{url('/pdfs/order/footer.png')}}" width="100%" height="100%"/> -->
            All Rights Reserved. Copyright © 
            @php 
                echo date("Y"); 
            @endphp
        </footer>


        <!-- Wrap the subject matter content of your PDF inside a main tag -->
        <main>

            <h2>Orden de Compra (Recibo) </h2>

            <div style="page-break-after: always;">

                <h4>  Usuario </h4>
                <ul> 
                    <li>Id: {{ $user->id }} </li>
                    <li>Name: {{ $user->name }}</li>
                    <li>Email: {{ $user->email }}</li>
                    <li>CC: {{ $user->nit_type }} {{ $user->nit_number}}</li>
                    <li>Points: {{ $user->points }} </li>
                    <li>Phone: {{ $user->phone }} </li>
                    <li>City: {{ $user->city }} </li>
                    <li>Address: {{ $user->address }} </li>
                </ul>

                <br>

                <h4> Pago </h4>
                <ul> 
                    <li>Id:  {{ $payment->id }} </li>
                    <li>Method:  {{ $payment->method }} </li>
                    <li>Amount:  @money( $payment->amount ) </li>
                </ul>

                <br>

                <h4> Status </h4>

                <ul>
                    <li> ordered_at: {{ $invoice->ordered_at }} </li>
                    <li> shipped_at: {{ $invoice->shipped_at }}</li>
                    <li> delivered_at: {{ $invoice->delivered_at }} </li>
                </ul>


                <br>
                <br>

                <h4> subtotal:  @money($invoice->subtotal) </h4>
                <h4> taxes:   @money($invoice->taxes)  </h4>
                <h4> discounts:   @money($invoice->discounts)  </h4>
                <h4> points: {{ $invoice->points }} </h4>

                <br>

                <h4> total: {{ $invoice->total }} </h4>
                <h4> no_guia: {{ $invoice->no_guia }} </h4>

                <br>



            </div>


            <p style="page-break-after: always;">
               Tamaño :: count :: {{ count($products) }}
            </p>

            <p style="page-break-after: always;">

                @foreach ($products as $product)
                    product :: {{ $product['id'] }} - {{ $product['name'] }}  ::  @money($product['price']*(1 - 0.01*$product['discount']))  
                    <br>
                @endforeach

            </p>

            <br>
            <br>
            <br>
            <br>
            
        </main>

    </body>
</html>
<?php
    $HOST = 'http://ec2-18-116-13-36.us-east-2.compute.amazonaws.com';
    $UI_DEV = 'http://soliun-ui--dev.s3-website.us-east-2.amazonaws.com';
?>
<style>
        @font-face {
            font-family: Poppins;
            src: url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,600;1,500&display=swap');
        }

    body,
    table,
    thead,
    tbody,
    tr {
        width: 100%;
        margin: 0px;
        padding: 0px;
        border-collapse: collapse;
        font-family: Poppins;
        color: #575756;
    }
</style>
<div class="soliun-email recovery-password-email">
    <table class="" style="background-color: #fff4f5">
        <thead>
            <tr style="
                    background-color: white;
                    background-image:url('{{ $HOST . '/images/email_bg.png' }}')">
                <th
                    colspan="3"
                    style="
                          background-image: url(http://ec2-18-116-13-36.us-east-2.compute.amazonaws.com/images/email_clouds.png), url(http://ec2-18-116-13-36.us-east-2.compute.amazonaws.com/images/email_letters.png);
                        background-size: 250px, 128px;
                        background-repeat: no-repeat;
                        background-position: bottom right, center left;
                ">
                    <img
                        src="{{ $HOST . '/images/email_soliun_logo.png' }}"
                        width="160px"
                        style="padding: 1em 0em"
                    />
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" style="width:100%;">
                    <div style=" width: 100%; box-sizing:border-box; padding:1em;
                    max-width: 600px;
                    min-width: 300px;
                    background-color:white;
                    margin: 0 auto">
                    <br>
                        <h1 style="color:#575756; font-size:22px; font-weight: 600; text-align:center;">¿Una nueva contraseña ?</h1>
                        <h2 style="color:#575756; font-size:16px;  font-weight: 300; text-align:center;">
                            Crea tu nueva contraseña y continúa ayudando al
                            mundo.
                        </h2>
                        <br>
                        <a target="_blank" style="
                        text-decoration: none;
                        display:block;
                        width:fit-content;
                        margin: 0 auto;
                        padding:0.5em 1.5em;
                        background-color:#58B999;
                        border-color:#58B999;
                        border-radius: 0.75em;
                        color: white;
                        font-size:16px;
                        outline:none;
                        shadow:none;
                        border:none;
                        font-weight: 600;   ">
                        CREAR MI NUEVA CONTRASEÑA
                    </a>
                           <br>
                        <p style="
                          width: 436px;margin: 0 auto; display: block;
                            font-size:14px;  font-weight: 100; text-align:center;
                            color:#9D9D9C;
                        ">
                            Si no solicitaste el cambio de contraseña, ignora
                            este correo. Tu contraseña continuará siendo la
                            misma.
                        </p>
                        <br>
                        <p style="
                        margin: 0 auto; display: block;
                        width: 320px;
                        font-size:12px;  font-weight: 100; text-align:center;
                        color:#9D9D9C;
                    ">
                            ¿Tienes problemas para acceder? Responde a este <br>
                            correo y te ayudaremos a ingresar.
                        </p>

                        <br>
                        <br>

                    </div>

                    <div style=" width: 100%;
                    max-width: 600px;
                    min-width: 300px;
                    margin: 0 auto">
                           <img
                           src="{{ $HOST . '/images/FUNDACIÓN-SOLIUN-01.png' }}"
                           width="100px"
                           style="padding: 1em 0em; display:block; margin: 0 auto;"
                       />
                        <h3  style="
                        margin: 0 auto; display: block;
                        width: 100%;
                        font-size:10px;  font-weight: 100; text-align:center;
                        color:#575756;
                    ">
                            Teléfonos: (031) 765 3016 / 301 319 0819 Carrera 70
                            C # 48-55, Bogotá D.C. / NIT: 901310814-7
                        </h3>
                        <br>
                        <h4  style="
                        margin: 0 auto; display: block;
                        width: 320px;
                        font-size:10px;  font-weight: 100; text-align:center;
                        color:#575756C;
                    ">
                            Recibes este correo por que contiene información
                            importante acerca de tu cuenta en la FUNDACIÓN
                            SOLIUN
                        </h4>
                        <br>
                        <br>
                    </div>
                </td>

            </tr>
        </tbody>
    </table>
</div>

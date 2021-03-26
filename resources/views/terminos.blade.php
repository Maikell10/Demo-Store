@extends('plantilla.tienda')

@section('titulo','Términos y Condiciones | TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection

@section('contenido')


<div class="super_container_inner">
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center bg-white">
                <h1 class="h1">Términos y Condiciones de Uso</h1>
              </div>
            <div class="card-body">
                <h2 class="card-title h2">INFORMACIÓN RELEVANTE</h2>
                <p class="card-text text-justify" style="text-indent: 10px">Es requisito necesario para la adquisición de los productos que se ofrecen en este sitio, que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan. El uso de nuestros servicios así como la compra de nuestros productos implicará que usted ha leído y aceptado los Términos y Condiciones de Uso en el presente documento. Todas los productos que son ofrecidos por nuestro sitio web pudieran ser creadas, cobradas, enviadas o presentadas por una página web ó compañía tercera y en tal caso estarían sujetas a sus propios Términos y Condiciones. En algunos casos, para adquirir un producto, será necesario el registro por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.</p>
                <p class="card-text text-justify" style="text-indent: 10px">El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en caso de que se haya registrado y que sea necesario para la compra de alguno de nuestros productos.<a href="https://www.tuminimercado.com" class="btn btn-link p-0">www.tuminimercado.com</a> no asume la responsabilidad en caso de que entregue dicha clave a terceros.</p>
                <p class="card-text text-justify" style="text-indent: 10px">Todas las compras y transacciones que se lleven a cabo por medio de este sitio web, están sujetas a un proceso de confirmación y verificación, el cual podría incluir la verificación del stock y disponibilidad de producto, validación de la forma de pago, validación de la factura (en caso de existir) y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado. En algunos casos puede que se requiera una verificación por medio de correo electrónico.</p>
                <p class="card-text text-justify" style="text-indent: 10px">Los precios de los productos ofrecidos en esta Tienda Online son válidos solamente en las compras realizadas en este sitio web.</p>
                <p class="card-text text-justify" style="text-indent: 10px">Somos un sitio web que sirve de plataforma a personas naturales y jurídicas, que puedan o no tener tienda física, para que ofrezcan sus productos o servicios en esta plataforma virtual, los cuales no nos hacemos responsables por compras a vendedores no verificados, ya que cada vendedor tiene sus propios términos y condiciones y sus propias políticas de privacidad, los cuales el usuario puede pedirle como información al vendedor en nuestra plataforma de preguntas ó mensajes directos antes de la compra.</p>
                <p class="card-text text-justify" style="text-indent: 10px">Para que un vendedor se muestre como verificado en este sitio web, el mismo anteriormente ya nos entregó información y documentos relevantes para la identificación del vendedor, los mismos no se divulgarán sin el consentimiento de los dueños, salvo que sea requerido por un juez con una orden judicial como se explica en nuestras políticas de privacidad.</p>
                <p class="card-text text-justify" style="text-indent: 10px">Damos facilidad para realizar el pago de los productos publicados en este sitio web a través de aplicaciones de terceros.</p>

                <h2 class="card-title h2">LICENCIA</h2>
                <p class="card-text text-justify" style="text-indent: 10px">TuMiniMercado a través de su sitio web concede una licencia para que los usuarios utilicen los productos que son vendidos en este sitio web de acuerdo a los Términos y Condiciones que se describen en este documento.</p>

                <h2 class="card-title h2">USO NO AUTORIZADO</h2>
                <p class="card-text text-justify" style="text-indent: 10px">En caso de que aplique (para venta de software, templates, u otro producto de diseño y programación) usted no puede colocar uno de nuestros productos, modificado o sin modificar, en un CD, sitio web o ningún otro medio y ofrecerlos para la redistribución o la reventa de ningún tipo.</p>

                <h2 class="card-title h2">PROPIEDAD</h2>
                <p class="card-text text-justify" style="text-indent: 10px">Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros productos, modificado o sin modificar. Todos los productos son propiedad de los proveedores del contenido. En caso de que no se especifique lo contrario, nuestros productos se proporcionan sin ningún tipo de garantía, expresa o implícita. En ninguno esta compañía será responsable de ningún daño incluyendo, pero no limitado a, daños directos, indirectos, especiales, fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros productos.</p>

                <h2 class="card-title h2">POLÍTICA DE REEMBOLSO Y GARANTÍA</h2>
                <p class="card-text text-justify" style="text-indent: 10px">En el caso de productos que sean mercancías irrevocables no-tangibles, no realizamos reembolsos después de que se envíe el producto, usted tiene la responsabilidad de entender antes de comprarlo. Le pedimos que lea cuidadosamente antes de comprarlo. Hay algunos productos que pudieran tener garantía y posibilidad de reembolso pero este será especificado al comprar el producto. En tales casos la garantía solo cubrirá fallas de fábrica y sólo se hará efectiva cuando el producto se haya usado correctamente. La garantía no cubre averías o daños ocasionados por uso indebido. Los términos de la garantía están asociados a fallas de fabricación y funcionamiento en condiciones normales de los productos y sólo se harán efectivos estos términos si el equipo ha sido usado correctamente. Esto incluye:</p>
                <ul>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>De acuerdo a las especificaciones técnicas indicadas para cada producto.</li>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>En condiciones ambientales acorde con las especificaciones indicadas por el fabricante.</li>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>En uso específico para la función con que fue diseñado de fábrica.</li>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>En condiciones de operación eléctricas acorde con las especificaciones y tolerancias indicadas.</li>
                </ul>

                <h2 class="card-title h2">COMPROBACIÓN ANTIFRAUDE</h2>
                <p class="card-text text-justify" style="text-indent: 10px">La compra del cliente puede ser aplazada para la comprobación antifraude. También puede ser suspendida por más tiempo para una investigación más rigurosa, para evitar transacciones fraudulentas.</p>

                <h2 class="card-title h2">PRIVACIDAD</h2>
                <p class="card-text text-justify" style="text-indent: 10px">Este<a href="https://www.tuminimercado.com" class="btn btn-link p-0">www.tuminimercado.com</a> garantiza que la información personal que usted envía cuenta con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una validación de los pedidos no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales.</p>
                <p class="card-text text-justify" style="text-indent: 10px">La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría ser seleccionada al momento de crear su cuenta.</p>
                <p class="card-text text-justify" style="text-indent: 10px">TuMiniMercado reserva los derechos de cambiar o de modificar estos términos sin previo aviso.</p>
            </div>
        </div>
    </div>
</div>

@endsection
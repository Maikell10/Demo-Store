@extends('plantilla.tienda')

@section('titulo', __('Terms and Conditions of Use') . ' | TuMiniMercado')

@section('estilos')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/main_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/styles/responsive.css') }}">

@endsection

@section('contenido')


<div class="super_container_inner">
    <div class="container mt-3">
        <div class="card">
            <div class="card-header text-center bg-white">
                <h1 class="h1">{{__('Terms and Conditions of Use')}}</h1>
            </div>
            <div class="card-body">
                <h2 class="card-title h2">{{__('RELEVANT INFORMATION')}}</h2>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('It is a necessary requirement for the acquisition of the products offered on this site, that you read and accept the following Terms and Conditions that are written below. The use of our services as well as the purchase of our products will imply that you have read and accepted the Terms and Conditions of Use in this document. All the products that are offered by our website could be created, collected, sent or presented by a website or third party company and in such case they would be subject to their own Terms and Conditions. In some cases, to acquire a product, the user will need to register, with the entry of reliable personal data and definition of a password.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('The user can choose and change the password for his account administration access at any time, if he has registered and that is necessary for the purchase of any of our products.')}}<a href="https://www.tuminimercado.com" class="btn btn-link p-0">www.tuminimercado.com</a> {{__('does not assume responsibility in the event that you give said key to third parties.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('All purchases and transactions carried out through this website are subject to a confirmation and verification process, which could include verification of the stock and product availability, validation of the payment method, validation of the invoice (if there is any invoice) and compliance with the conditions required by the selected means of payment. In some cases, verification by email may be required.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('The prices of the products offered in this Online Store are valid only for purchases made on this website.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('We are a website that serves as a platform for natural and legal persons, who may or may not have a physical store, to offer their products or services on this virtual platform, which we are not responsible for purchases from unverified sellers, since each The seller has its own terms and conditions and its own privacy policies, which the user can request as information from the seller on our platform for questions or direct messages before the purchase.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('For a seller to be shown as verified on this website, the same previously gave us information and documents relevant to the identification of the seller, they will not be disclosed without the consent of the owners, unless required by a judge with a court order as explained in our privacy policies.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('We make it easy to pay for the products published on this website through third-party applications.')}}</p>

                <h2 class="card-title h2">{{__('LICENSE')}}</h2>
                <p class="card-text text-justify" style="text-indent: 10px">{{__('TuMiniMercado through its website grants a license for users to use the products that are sold on this website in accordance with the Terms and Conditions described in this document.')}}</p>

                <h2 class="card-title h2">{{__('UNAUTHORIZED USE')}}</h2>
                <p class="card-text text-justify" style="text-indent: 10px">{{__('In case it applies (for the sale of software, templates, or other design and programming products) you cannot place one of our products, modified or unmodified, on a CD, website or any other means and offer them for redistribution. or resale of any kind.')}}</p>

                <h2 class="card-title h2">{{__('PROPERTY')}}</h2>
                <p class="card-text text-justify" style="text-indent: 10px">{{__('You cannot declare intellectual or exclusive property to any of our products, modified or unmodified. All products are the property of the content providers. Unless otherwise specified, our products are provided without warranty of any kind, express or implied. In no way will this company be liable for any damages including, but not limited to, direct, indirect, special, incidental or consequential damages or other losses resulting from the use or inability to use our products.')}}</p>

                <h2 class="card-title h2">{{__('REFUND AND GUARANTEE POLICY')}}</h2>
                <p class="card-text text-justify" style="text-indent: 10px">{{__('In the case of products that are irrevocable non-tangible merchandise, we do not issue refunds after the product is shipped, you have the responsibility to understand before buying. We ask that you read carefully before purchasing. There are some products that may have a guarantee and possibility of reimbursement but this will be specified when buying the product. In such cases the warranty will only cover factory faults and will only be effective when the product has been used correctly. The warranty does not cover breakdowns or damage caused by improper use. The warranty terms are associated with manufacturing and operating faults under normal product conditions and these terms will only be effective if the equipment has been used correctly. This includes:')}}</p>
                <ul>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>{{__('According to the technical specifications indicated for each product.')}}</li>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>{{__('Under environmental conditions in accordance with the specifications indicated by the manufacturer.')}}</li>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>{{__('In specific use for the function with which it was designed at the factory.')}}</li>
                    <li class="ml-5"><i class="fa fa-circle mr-1" aria-hidden="true"></i>{{__('Under electrical operating conditions in accordance with the specifications and tolerances indicated.')}}</li>
                </ul>

                <h2 class="card-title h2">{{__('ANTI-FRAUD CHECK')}}</h2>
                <p class="card-text text-justify" style="text-indent: 10px">{{__("The customer's purchase can be postponed for the anti-fraud check. It can also be suspended for a longer time for a more rigorous investigation, to avoid fraudulent transactions.")}}</p>

                <h2 class="card-title h2">{{__('PRIVACY')}}</h2>
                <p class="card-text text-justify" style="text-indent: 10px">{{__('This')}}<a href="https://www.tuminimercado.com" class="btn btn-link p-0">www.tuminimercado.com</a> {{__('guarantees that the personal information you send has the necessary security. The data entered by the user or in the case of requiring a validation of the orders will not be delivered to third parties, unless it must be disclosed in compliance with a court order or legal requirements.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('Subscription to advertising email newsletters is voluntary and could be selected when creating your account.')}}</p>

                <p class="card-text text-justify" style="text-indent: 10px">{{__('TuMiniMercado reserves the rights to change or modify these terms without prior notice.')}}</p>
            </div>
        </div>
    </div>
</div>

@endsection
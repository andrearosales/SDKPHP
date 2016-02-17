<?php

require_once 'lib/PayU.php';
PayU::$apiKey = "6u39nqhq8ftd0hlvnjfs66eh8c"; //Ingrese aquí su propio apiKey.
PayU::$apiLogin = "11959c415b33d0c"; //Ingrese aquí su propio apiLogin.
PayU::$merchantId = "500238"; //Ingrese aquí su Id de Comercio.
PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
PayU::$isTest = false; //Dejarlo True cuando sean pruebas.
// URL de Pagos
Environment::setPaymentsCustomUrl("https://stg.api.payulatam.com/payments-api/4.0/service.cgi");
// URL de Consultas
Environment::setReportsCustomUrl("https://stg.api.payulatam.com/reports-api/4.0/service.cgi");
// URL de Suscripciones para Pagos Recurrentes
Environment::setSubscriptionsCustomUrl("https://stg.api.payulatam.com/payments-api/rest/v4.3/");

$reference = "payment_test_5616";
$value = "20000";

$parameters = array(
    //Ingrese aquí el identificador de la cuenta.
    PayUParameters::ACCOUNT_ID => "500538",
    //Ingrese aquí el código de referencia.
    PayUParameters::REFERENCE_CODE => $reference,
    //Ingrese aquí la descripción.
    PayUParameters::DESCRIPTION => "payment test",
    // -- Valores --
    //Ingrese aquí el valor.        
    PayUParameters::VALUE => $value,
    //Ingrese aquí la moneda.
    PayUParameters::CURRENCY => "COP",
    //Ingrese aquí el email del comprador.
    PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
    //Ingrese aquí el nombre del pagador.
    PayUParameters::PAYER_NAME => "First name and second buyer  name",
    //Ingrese aquí el documento de contacto del pagador.
    PayUParameters::PAYER_DNI => "5415668464654",
    //Ingrese aquí el nombre del método de pago
    //"BALOTO" || "EFECTY" || "BANK_REFERENCED"
    PayUParameters::PAYMENT_METHOD => "EFECTY",
    //Ingrese aquí el nombre del pais.
    PayUParameters::COUNTRY => PayUCountries::CO,
    //Ingrese aquí la fecha de expiración.
    PayUParameters::EXPIRATION_DATE => "2016-02-20T00:00:00",
    //IP del pagadador
    PayUParameters::IP_ADDRESS => "127.0.0.1",
);

$response = PayUPayments::doAuthorizationAndCapture($parameters);

if ($response) {
    $response->transactionResponse->orderId;
    $response->transactionResponse->transactionId;
    $response->transactionResponse->state;
    if ($response->transactionResponse->state == "PENDING") {
        $response->transactionResponse->pendingReason;
        $response->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_HTML;
        $response->transactionResponse->extraParameters->REFERENCE;
    }
    $response->transactionResponse->responseCode;
}
print_r($response);
?>

<?php

require_once '../lib/PayU.php';
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

$reference = "payment_test_1984";
$value = "100";

$parameters = array(
    //Ingrese aquí el identificador de la cuenta.
    PayUParameters::ACCOUNT_ID => "509171",
    //Ingrese aquí el código de referencia.
    PayUParameters::REFERENCE_CODE => $reference,
    //Ingrese aquí la descripción.
    PayUParameters::DESCRIPTION => "payment test",
    // -- Valores --
    //Ingrese aquí el valor.        
    PayUParameters::VALUE => $value,
    //Ingrese aquí la moneda.
    PayUParameters::CURRENCY => "ARS",
    //Ingrese aquí el email del comprador.
    PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
    //Ingrese aquí el nombre del pagador.
    PayUParameters::PAYER_NAME => "First name and second buyer name",
    //Ingrese aquí el documento de contacto del pagador.
    PayUParameters::PAYER_DNI => "5415668464654",
    //Ingrese aquí el nombre del método de pago
    //"PAGOFACIL"||"BAPRO"||"COBRO_EXPRESS"||"RAPIPAGO"||"RIPSA"
    PayUParameters::PAYMENT_METHOD => "COBRO_EXPRESS",
    //Ingrese aquí el nombre del pais.
    PayUParameters::COUNTRY => PayUCountries::AR,
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
        $response->transactionResponse->trazabilityCode;
        $response->transactionResponse->authorizationCode;
        $response->transactionResponse->extraParameters->URL_PAYMENT_RECEIPT_HTML;
        $response->transactionResponse->extraParameters->REFERENCE;
        $response->transactionResponse->extraParameters->BAR_CODE;
    }
    $response->transactionResponse->responseCode;
}

print_r($response);
?>

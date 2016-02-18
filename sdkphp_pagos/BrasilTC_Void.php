<?php

require_once '../lib/PayU.php';
PayU::$apiKey = "676k86ks53la6tni6clgd30jf6"; //Ingrese aquí su propio apiKey.
PayU::$apiLogin = "403ba744e9827f3"; //Ingrese aquí su propio apiLogin.
PayU::$merchantId = "500365"; //Ingrese aquí su Id de Comercio.
PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
PayU::$isTest = false; //Dejarlo True cuando sean pruebas.
// URL de Pagos
Environment::setPaymentsCustomUrl("https://stg.api.payulatam.com/payments-api/4.0/service.cgi");
// URL de Consultas
Environment::setReportsCustomUrl("https://stg.api.payulatam.com/reports-api/4.0/service.cgi");
// URL de Suscripciones para Pagos Recurrentes
Environment::setSubscriptionsCustomUrl("https://stg.api.payulatam.com/payments-api/rest/v4.3/");

$parameters = array(
	//Ingrese aquí el identificador de la cuenta.
	PayUParameters::ACCOUNT_ID => "500719",
	//Ingrese aquí el identificador de la orden.
	PayUParameters::ORDER_ID => "7725738",
	//Ingrese aquí el identificador de la transacción.
	PayUParameters::TRANSACTION_ID => "4c4731aa-86b3-491c-9c6d-9478fc5ee9ae",
);

$response = PayUPayments::doVoid($parameters);

if ($response) {
	$response->transactionResponse->orderId;
	$response->transactionResponse->transactionId;
	$response->transactionResponse->state;
	$response->transactionResponse->paymentNetworkResponseCode;
	$response->transactionResponse->paymentNetworkResponseErrorMessage;
	$response->transactionResponse->trazabilityCode;
	$response->transactionResponse->responseCode;
	$response->transactionResponse->responseMessage;        
}
print_r($response);
?>
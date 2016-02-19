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

$parameters = array(
	//Ingresa aquí el identificador del pagador.
	//PayUParameters::PAYER_ID => "10",
	//Ingresa aquí el identificador del token.
	PayUParameters::TOKEN_ID => "8f25a8f0-c61a-4f33-a2cb-c43ec8da4333",
	//Ingresa aquí la fecha inicial desde donde filtrar con la fecha final hasta donde filtrar.
	//PayUParameters::START_DATE=> "2010-01-01T12:00:00",
	//PayUParameters::END_DATE=> "2015-01-01T12:00:00"
);

$response=PayUTokens::find($parameters);
   
if($response) {
	$credit_cards = $response->creditCardTokenList;
	foreach ($credit_cards as $credit_card) { 
		$credit_card->creditCardTokenId;
		$credit_card->maskedNumber;
		$credit_card->payerId;
		$credit_card->identificationNumber;
		$credit_card->paymentMethod;
	}         
} 
print_r($response);
?>
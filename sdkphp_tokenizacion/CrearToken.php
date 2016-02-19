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
	//Ingrese aquí el nombre del pagador.
	PayUParameters::PAYER_NAME => "REJECTED",
	//Ingrese aquí el identificador del pagador.
	PayUParameters::PAYER_ID => "id_pagador_05",
	//Ingrese aquí el documento de identificación del comprador.
	PayUParameters::PAYER_DNI => "32144457",
	//Ingrese aquí el número de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_NUMBER => "4111111111111111",
	//Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "2018/10",
	//Ingrese aquí el nombre de la tarjeta de crédito
	PayUParameters::PAYMENT_METHOD => "VISA"
);
	
$response = PayUTokens::create($parameters);   
if($response){
	//podrás obtener el token de la tarjeta
	$response->creditCardToken->creditCardTokenId;
}

print_r($response);
?>
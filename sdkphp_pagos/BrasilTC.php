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

$reference = "payment_test_651321";
$value = "100";

$parameters = array(
	//Ingrese aquí el identificador de la cuenta.
	PayUParameters::ACCOUNT_ID => "500719",
	//Ingrese aquí el código de referencia.
	PayUParameters::REFERENCE_CODE => $reference,
	//Ingrese aquí la descripción.
	PayUParameters::DESCRIPTION => "payment test",
	
	// -- Valores --
	//Ingrese aquí el valor.        
	PayUParameters::VALUE => $value,
	//Ingrese aquí la moneda.
	PayUParameters::CURRENCY => "BRL",
	
	// -- Comprador 
	//Ingrese aquí el nombre del comprador.
	PayUParameters::BUYER_NAME => "First name and second buyer  name",
	//Ingrese aquí el email del comprador.
	PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
	//Ingrese aquí el teléfono de contacto del comprador.
	PayUParameters::BUYER_CONTACT_PHONE => "(11)756312633",
	//Ingrese aquí el documento de contacto del comprador.
	PayUParameters::BUYER_DNI => "811.807.405-64",
	// or 
	//PayUParameters::BUYER_CNPJ => "32593371000110",

	
	//Ingrese aquí la dirección del comprador.
	PayUParameters::BUYER_STREET => "calle 100",
	PayUParameters::BUYER_STREET_2 => "5555487",
	PayUParameters::BUYER_CITY => "Sao paulo",
	PayUParameters::BUYER_STATE => "SP",
	PayUParameters::BUYER_COUNTRY => "BR",
	PayUParameters::BUYER_POSTAL_CODE => "01019-030",
	PayUParameters::BUYER_PHONE => "(11)756312633",
	
	// -- pagador --
	//Ingrese aquí el nombre del pagador.
	PayUParameters::PAYER_NAME => "PENDING",  
	
	// -- Datos de la tarjeta de crédito -- 
	//Ingrese aquí el número de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_NUMBER => "4097440000000004",
	//Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "2016/12",
	//Ingrese aquí el código de seguridad de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_SECURITY_CODE=> "321",
	//Ingrese aquí el nombre de la tarjeta de crédito
	//"VISA" || "AMEX" || "DINERS" || "ELO" || "HIPERCARD" || "MASTERCARD"
	PayUParameters::PAYMENT_METHOD => "VISA",
	
	//Ingrese aquí el número de cuotas.
	PayUParameters::INSTALLMENTS_NUMBER => "1",
	//Ingrese aquí el nombre del pais.
	PayUParameters::COUNTRY => PayUCountries::BR, 
	
	//IP del pagadador
	PayUParameters::IP_ADDRESS => "127.0.0.1",	
	);

$response = PayUPayments::doAuthorizationAndCapture($parameters);

if($response){
	$response->transactionResponse->orderId;
	$response->transactionResponse->transactionId;
	$response->transactionResponse->state;
	if($response->transactionResponse->state=="PENDING"){
		$response->transactionResponse->pendingReason;	
	}
	$response->transactionResponse->paymentNetworkResponseCode;
	$response->transactionResponse->paymentNetworkResponseErrorMessage;
	$response->transactionResponse->trazabilityCode;
	$response->transactionResponse->responseCode;
	$response->transactionResponse->responseMessage;   
}
print_r($response);
?>
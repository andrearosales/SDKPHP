<?php

require_once '../lib/PayU.php';
PayU::$apiKey = "6u39nqhq8ftd0hlvnjfs66eh8c"; //Ingrese aquí su propio apiKey.
PayU::$apiLogin = "11959c415b33d0c"; //Ingrese aquí su propio apiLogin.
PayU::$merchantId = "500238"; //Ingrese aquí su Id de Comercio.
PayU::$language = SupportedLanguages::ES; //Seleccione el idioma.
PayU::$isTest = true; //Dejarlo True cuando sean pruebas.
// URL de Pagos
Environment::setPaymentsCustomUrl("https://stg.api.payulatam.com/payments-api/4.0/service.cgi");
// URL de Consultas
Environment::setReportsCustomUrl("https://stg.api.payulatam.com/reports-api/4.0/service.cgi");
// URL de Suscripciones para Pagos Recurrentes
Environment::setSubscriptionsCustomUrl("https://stg.api.payulatam.com/payments-api/rest/v4.3/");

$reference = "payment_test_984651";
$value = "100";

$parameters = array(
	//Ingrese aquí el identificador de la cuenta.
	PayUParameters::ACCOUNT_ID => "500547",
	//Ingrese aquí el código de referencia.
	PayUParameters::REFERENCE_CODE => $reference,
	//Ingrese aquí la descripción.
	PayUParameters::DESCRIPTION => "payment test",
	
	// -- Valores --
	//Ingrese aquí el valor.        
	PayUParameters::VALUE => $value,
	//Ingrese aquí la moneda.
	PayUParameters::CURRENCY => "MXN",
	
	// -- Comprador 
	//Ingrese aquí el nombre del comprador.
	PayUParameters::BUYER_NAME => "First name and second buyer  name",
	//Ingrese aquí el email del comprador.
	PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
	//Ingrese aquí el teléfono de contacto del comprador.
	PayUParameters::BUYER_CONTACT_PHONE => "7563126",
	//Ingrese aquí el documento de contacto del comprador.
	PayUParameters::BUYER_DNI => "5415668464654",
	//Ingrese aquí la dirección del comprador.
	PayUParameters::BUYER_STREET => "Calle Salvador Alvarado",
	PayUParameters::BUYER_STREET_2 => "8 int 103",
	PayUParameters::BUYER_CITY => "Guadalajara",
	PayUParameters::BUYER_STATE => "Jalisco",
	PayUParameters::BUYER_COUNTRY => "MX",
	PayUParameters::BUYER_POSTAL_CODE => "000000",
	PayUParameters::BUYER_PHONE => "7563126",
	
	// -- pagador --
	//Ingrese aquí el nombre del pagador.
	PayUParameters::PAYER_NAME => "First name and second payer name",
	//Ingrese aquí el email del pagador.
	PayUParameters::PAYER_EMAIL => "payer_test@test.com",
	//Ingrese aquí el teléfono de contacto del pagador.
	PayUParameters::PAYER_CONTACT_PHONE => "7563126",
	//Ingrese aquí el documento de contacto del pagador.
	PayUParameters::PAYER_DNI => "5415668464654",
	//OPCIONAL fecha de nacimiento del pagador YYYY-MM-DD, importante para autorización de pagos en México.
	PayUParameters::PAYER_BIRTHDATE => '1980-06-22',

	//Ingrese aquí la dirección del pagador.
	PayUParameters::PAYER_STREET => "Calle Zaragoza esquina",
	PayUParameters::PAYER_STREET_2 => "calle 5 de Mayo",
	PayUParameters::PAYER_CITY => "calle 5 de Mayo",
	PayUParameters::PAYER_STATE => "Nuevo Leon",
	PayUParameters::PAYER_COUNTRY => "MX",
	PayUParameters::PAYER_POSTAL_CODE => "64000",
	PayUParameters::PAYER_PHONE => "7563126",
	
	// DATOS DEL TOKEN
	PayUParameters::TOKEN_ID => "0c03f24a-7521-4cf6-974d-c866414cc936",
	
	//Ingrese aquí el nombre de la tarjeta de crédito
	//"VISA" || "MASTERCARD"    
	PayUParameters::PAYMENT_METHOD => "VISA",
	
	//Ingrese aquí el número de cuotas.
	PayUParameters::INSTALLMENTS_NUMBER => "1",
	//Ingrese aquí el nombre del pais.
	PayUParameters::COUNTRY => PayUCountries::MX,
	
	//Session id del device.
	PayUParameters::DEVICE_SESSION_ID => "vghs6tvkcle931686k1900o6e1",
	//IP del pagadador
	PayUParameters::IP_ADDRESS => "127.0.0.1",
	//Cookie de la sesión actual.
	PayUParameters::PAYER_COOKIE=>"pt1t38347bs6jc9ruv2ecpv7o2",
	//Cookie de la sesión actual.        
	PayUParameters::USER_AGENT=>"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
);
	
$response = PayUPayments::doAuthorizationAndCapture($parameters);

if ($response) {
	$response->transactionResponse->orderId;
	$response->transactionResponse->transactionId;
	$response->transactionResponse->state;
	if ($response->transactionResponse->state=="PENDING") {
		$response->transactionResponse->pendingReason;	
	}
	$response->transactionResponse->paymentNetworkResponseCode;
	$response->transactionResponse->paymentNetworkResponseErrorMessage;
	$response->transactionResponse->trazabilityCode;
	$response->transactionResponse->authorizationCode;
	$response->transactionResponse->responseCode;
	$response->transactionResponse->responseMessage;   	
}    
print_r($response);
?>
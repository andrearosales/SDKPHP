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

$reference = "payment_test_5416";
$value = "10000";

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
	//Ingrese aquí el email del pagador.
	PayUParameters::PAYER_EMAIL => "payer_test@test.com",
	//Ingrese aquí el teléfono de contacto del pagador.
	PayUParameters::PAYER_CONTACT_PHONE=> "7563126",
		   
	// -- infarmación obligatoria para PSE --
	//Ingrese aquí el código pse del banco.
	PayUParameters::PSE_FINANCIAL_INSTITUTION_CODE => "1051",
	//Ingrese aquí el tipo de persona (N natural o J jurídica)
	PayUParameters::PAYER_PERSON_TYPE => "N",
	//Ingrese aquí el documento de contacto del pagador.
	PayUParameters::PAYER_DNI => "123456789",
	//Ingrese aquí el tipo de documento del pagador: CC, CE, NIT, TI, PP,IDC, CEL, RC, DE.
	PayUParameters::PAYER_DOCUMENT_TYPE => "CC",

	//Ingrese aquí el nombre del método de pago
	PayUParameters::PAYMENT_METHOD => PaymentMethods::PSE,
   
	//Ingrese aquí el nombre del pais.
	PayUParameters::COUNTRY => PayUCountries::CO,
	
	//IP del pagadador
	PayUParameters::IP_ADDRESS => "127.0.0.1",
	//Cookie de la sesión actual.
	PayUParameters::PAYER_COOKIE=>"pt1t38347bs6jc9ruv2ecpv7o2",
	//Cookie de la sesión actual.        
	PayUParameters::USER_AGENT=>"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0",
	
	//Página de respuesta a la cual será redirigido el pagador.     
	PayUParameters::RESPONSE_URL=>"http://www.test.com/response"
	
);
	
$response = PayUPayments::doAuthorizationAndCapture($parameters);

if($response){
	$response->transactionResponse->orderId;
	$response->transactionResponse->transactionId;
	$response->transactionResponse->state;
	if($response->transactionResponse->state)
	if($response->transactionResponse->state=="PENDING"){
		$response->transactionResponse->pendingReason;
		$response->transactionResponse->extraParameters->BANK_URL;		
	}
	$response->transactionResponse->responseCode;		  
}
print_r($response);
?>
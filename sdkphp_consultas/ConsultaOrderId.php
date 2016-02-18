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

//Ingresa aquí el código de referencia de la orden.
$parameters = array(PayUParameters::ORDER_ID => "7717231");

$order = PayUReports::getOrderDetail($parameters);    

if ($order) {
	$order->accountId;
	$order->status;
	$order->referenceCode;
	$order->additionalValues->TX_VALUE->value;
	$order->additionalValues->TX_TAX->value;
	if ($order->buyer) {
		$order->buyer->emailAddress;
		$order->buyer->fullName;
	}
	$transactions=$order->transactions;
	foreach ($transactions as $transaction) {
		$transaction->type;
		$transaction->transactionResponse->state;
		$transaction->transactionResponse->paymentNetworkResponseCode;
		$transaction->transactionResponse->trazabilityCode;
		$transaction->transactionResponse->responseCode;
		if ($transaction->payer) {
			$transaction->payer->fullName;
			$transaction->payer->emailAddress;
		}
	}
}

print_r($order);
?>
<?php

date_default_timezone_set('America/La_Paz');
$cuis1="C5CD5D6";
$cuis0="57C54491";


$codigoPuntoVenta=0;
$cuis=$cuis0;

$nit="1010413026";
$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJpbXB1ZXN0b3Nfc2VsYTI2QGhvdG1haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjM3MTUxNUI0QjE2Q0UwRTNBOTE2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNME1EUXdNVFEyTURJREFLa1FHMHdLQUFBQSIsImlkIjo1MjM3NDgyLCJleHAiOjE3OTg3MTMwNzIsImlhdCI6MTc2ODgzMzA0Miwibml0RGVsZWdhZG8iOjEwMTA0MTMwMjYsInN1YnNpc3RlbWEiOiJTRkUifQ.zNYCnKSUrrsiolNlHC3PuYUQ0pNap_YjLWJPOYJ2kDZPNdc6imqUZmAnQxUgrokBxwNOWiE0M7NugDESR68geA";
$codigoAmbiente=2;
$codigoSistema="371515B4B16CE0E3A916";
$modalidad=1;

$contador = 1;

for ($i=0; $i < $contador; $i++) {
    $client = new \SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionCodigos?WSDL",  [
        'stream_context' => stream_context_create([
            'http' => [
                'header' => "apikey: TokenApi " . $token,
            ]
        ]),
        'cache_wsdl' => WSDL_CACHE_NONE,
        'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP | SOAP_COMPRESSION_DEFLATE,
        'trace' => 1,
        'use' => SOAP_LITERAL,
        'style' => SOAP_DOCUMENT,
    ]);
    $data = [
        "SolicitudCufd"=>[
            "codigoAmbiente"=>$codigoAmbiente,
            "codigoModalidad"=>$modalidad,
            "codigoPuntoVenta"=>$codigoPuntoVenta,
            "codigoSistema"=>$codigoSistema,
            "codigoSucursal"=>0,
            "cuis"=>$cuis,
            "nit"=>$nit,
        ]
    ];
    $result= $client->cufd($data);
    var_dump($result);
//    exit();
}
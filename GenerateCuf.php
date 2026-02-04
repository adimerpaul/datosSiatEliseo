<?php

date_default_timezone_set('America/La_Paz');
$cuis1="FC72FDEE";
$cuis0="B398BC11";


$codigoPuntoVenta=0;
$cuis=$cuis0;

$nit="329448023";
$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJleWdpbGFjaGFjb2xsbzdAZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjcyMUQ0NDQ0MDBBRTA0QjEwQ0JGQURFIiwibml0IjoiSDRzSUFBQUFBQUFBQURNMnNqUXhzVEF3TWdZQWZBZTRnd2tBQUFBPSIsImlkIjo1MzEyNTc5LCJleHAiOjE4MDA5MzUyNTgsImlhdCI6MTc2OTQxMzYyOCwibml0RGVsZWdhZG8iOjMyOTQ0ODAyMywic3Vic2lzdGVtYSI6IlNGRSJ9.JyaMLhLx4B9u8C1jwlXK_Zj9o_R2__RoV0S3groe8rusxEVtEK76EettvmMGyW_Mv9e4y5fVWFRPicfvhlE02g";
$codigoAmbiente=2;
$codigoSistema="721D444400AE04B10CBFADE";
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
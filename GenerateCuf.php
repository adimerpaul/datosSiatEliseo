<?php

date_default_timezone_set('America/La_Paz');
$cuis1="ECB7F858";
$cuis0="CB4C4B6F";


$codigoPuntoVenta=0;
$cuis=$cuis0;

$nit="555441026";
$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJheWFsYWVkc29uMjAxM0BnbWFpbC5jb20iLCJjb2RpZ29TaXN0ZW1hIjoiMzUyMjkyREE1Mzk0ODUyMTVCQkUiLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0xTlRVeE1UUXdNZ01BbnFhbE1Ba0FBQUE9IiwiaWQiOjUwNjIzNzIsImV4cCI6MTc2NzIxMDc2NywiaWF0IjoxNzU4NjcxNTM3LCJuaXREZWxlZ2FkbyI6NTU1NDQxMDI2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.g5L5FEVm6OUo0h1nzlf3iATSp_THBZMVWFU8nPsgzooncshKMnhILmg5O8m5T6UqG-sbDUWNE6ClIquVW0uPRw";
$codigoAmbiente=2;
$codigoSistema="352292DA539485215BBE";
$modalidad=2;

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
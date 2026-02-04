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

$contador = 1;

for ($i=0; $i < $contador; $i++) {
    $client = new \SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionSincronizacion?WSDL",  [
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
        "SolicitudSincronizacion"=>[
            "codigoAmbiente"=>$codigoAmbiente,
            "codigoPuntoVenta"=>$codigoPuntoVenta,
            "codigoSistema"=>$codigoSistema,
            "codigoSucursal"=>0,
            "cuis"=>$cuis,
            "nit"=>$nit,
        ]
    ];
    $result= $client->sincronizarActividades($data);
//    error_log(json_encode($result));
//    var_dump($result);
//    exit();

    $result= $client->sincronizarFechaHora($data);
//    var_dump($result);

    $result= $client->sincronizarListaActividadesDocumentoSector($data);
//    var_dump($result);

    $result= $client->sincronizarListaLeyendasFactura($data);
//    var_dump($result);

    $result= $client->sincronizarListaMensajesServicios($data);
//    var_dump($result);

    $result= $client->sincronizarListaProductosServicios($data);
//    error_log(json_encode($result));
    var_dump($result);

    $result= $client->sincronizarParametricaEventosSignificativos($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaMotivoAnulacion($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaPaisOrigen($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTipoDocumentoIdentidad($data);
//    var_dump($result);
//    error_log(json_encode($result));

    $result= $client->sincronizarParametricaTipoDocumentoSector($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTipoEmision($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTipoHabitacion($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTipoMetodoPago($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTipoMoneda($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTipoPuntoVenta($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaTiposFactura($data);
//    var_dump($result);

    $result= $client->sincronizarParametricaUnidadMedida($data);
//    var_dump($result);
//    error_log(json_encode($result));
}
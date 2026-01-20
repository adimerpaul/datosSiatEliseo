<?php

date_default_timezone_set('America/La_Paz');
$cuis1="C5CD5D6";
$cuis0="57C54491";
$codigoPuntoVenta=1;
$cuis=$cuis1;

$nit="1010413026";
$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJpbXB1ZXN0b3Nfc2VsYTI2QGhvdG1haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjM3MTUxNUI0QjE2Q0UwRTNBOTE2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNME1EUXdNVFEyTURJREFLa1FHMHdLQUFBQSIsImlkIjo1MjM3NDgyLCJleHAiOjE3OTg3MTMwNzIsImlhdCI6MTc2ODgzMzA0Miwibml0RGVsZWdhZG8iOjEwMTA0MTMwMjYsInN1YnNpc3RlbWEiOiJTRkUifQ.zNYCnKSUrrsiolNlHC3PuYUQ0pNap_YjLWJPOYJ2kDZPNdc6imqUZmAnQxUgrokBxwNOWiE0M7NugDESR68geA";
$codigoAmbiente=2;
$codigoSistema="371515B4B16CE0E3A916";

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
    var_dump($result);
//    exit();

    $result= $client->sincronizarFechaHora($data);
    var_dump($result);

    $result= $client->sincronizarListaActividadesDocumentoSector($data);
    var_dump($result);

    $result= $client->sincronizarListaLeyendasFactura($data);
    var_dump($result);

    $result= $client->sincronizarListaMensajesServicios($data);
    var_dump($result);

    $result= $client->sincronizarListaProductosServicios($data);
    var_dump($result);

    $result= $client->sincronizarParametricaEventosSignificativos($data);
    var_dump($result);

    $result= $client->sincronizarParametricaMotivoAnulacion($data);
    var_dump($result);

    $result= $client->sincronizarParametricaPaisOrigen($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTipoDocumentoIdentidad($data);
    var_dump($result);
//    error_log(json_encode($result));

    $result= $client->sincronizarParametricaTipoDocumentoSector($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTipoEmision($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTipoHabitacion($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTipoMetodoPago($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTipoMoneda($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTipoPuntoVenta($data);
    var_dump($result);

    $result= $client->sincronizarParametricaTiposFactura($data);
    var_dump($result);

    $result= $client->sincronizarParametricaUnidadMedida($data);
    var_dump($result);
//    error_log(json_encode($result));
}
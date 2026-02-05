<?php
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
require 'vendor/autoload.php';

require 'CUF.php';



date_default_timezone_set('America/La_Paz');
$cuis1="FC72FDEE";
$codigo1="BQWVDd15nQUE=NzDRCMTBDQkZBREU=QmVrZ3FKRkNhVUJIxRDQ0NDQwMEFFM";
$codigoControl1="9B271D1C5C8AF74"; //2023-03-01T16:56:05.359-04:00

$cuis0="B398BC11";
$codigo0="BQUFlQ3deZ0FBNzDRCMTBDQkZBREU=QsKhQm5rSkZDYVVIxRDQ0NDQwMEFFM";
$codigoControl0="8969041C5C8AF74"; //2023-03-01T16:55:06.383-04:00


$codigoPuntoVenta=1;
$codigoControl=$codigoControl1;
$cufd=$codigo1;
$cuis=$cuis1;

$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJleWdpbGFjaGFjb2xsbzdAZ21haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjcyMUQ0NDQ0MDBBRTA0QjEwQ0JGQURFIiwibml0IjoiSDRzSUFBQUFBQUFBQURNMnNqUXhzVEF3TWdZQWZBZTRnd2tBQUFBPSIsImlkIjo1MzEyNTc5LCJleHAiOjE4MDA5MzUyNTgsImlhdCI6MTc2OTQxMzYyOCwibml0RGVsZWdhZG8iOjMyOTQ0ODAyMywic3Vic2lzdGVtYSI6IlNGRSJ9.JyaMLhLx4B9u8C1jwlXK_Zj9o_R2__RoV0S3groe8rusxEVtEK76EettvmMGyW_Mv9e4y5fVWFRPicfvhlE02g";
$codigoAmbiente=2;
$codigoDocumentoSector=1;
$codigoEmision=1;
$codigoModalidad=1;

$cantidad=1;

$codigoSistema="721D444400AE04B10CBFADE";
$codigoSucursal=0;

$nit="329448023";
$tipoFacturaDocumento=1;//1 con credito 2 sin credito 3 nota


$temision=1;
$cdf=1;
$tds=1;//1 compra venta, 2 servicios basicos, 3 nota credito debito, 4 nota conciliacion
$nf=1;
deleteFile();
//     * @param nit NIT emisor
//     * @param fh Fecha y Hora en formato yyyyMMddHHmmssSSS
//     * @param sucursal
//     * @param mod Modalidad
//     * @param temision Tipo de Emision
//     * @param cdf Codigo Documento Fiscal
//     * @param tds Tipo Documento Sector
//     * @param nf Numero de Factura
//     * @param pos Punto de Venta

for ($i=1;$i<=$cantidad;$i++){

    $miliSegundo=str_pad($i, 3, '0', STR_PAD_LEFT);
    $fechaEnvio=date("Y-m-d\TH:i:s").".$miliSegundo";
    $cuf = new CUF();
    $cuf = $cuf->obtenerCUF($nit, date("YmdHis$miliSegundo"), $codigoSucursal, $codigoModalidad, $temision, $cdf, $tds, $nf, $codigoPuntoVenta);
    $cuf=$cuf.$codigoControl;
    error_log('CUF: '.$cuf);

    $data ="<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
<facturaElectronicaCompraVenta xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:noNamespaceSchemaLocation='facturaElectronicaCompraVenta.xsd'>
<cabecera>
        <nitEmisor>$nit</nitEmisor>
        <razonSocialEmisor>Carlos Loza</razonSocialEmisor>
        <municipio>La Paz</municipio>
        <telefono>2846005</telefono>
        <numeroFactura>1</numeroFactura>
        <cuf>$cuf</cuf>
        <cufd>$cufd</cufd>
        <codigoSucursal>0</codigoSucursal>
        <direccion>AV. JORGE LOPEZ #123</direccion>
        <codigoPuntoVenta>$codigoPuntoVenta</codigoPuntoVenta>
        <fechaEmision>$fechaEnvio</fechaEmision>
        <nombreRazonSocial>Mi razon social</nombreRazonSocial>
        <codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad>
        <numeroDocumento>5115889</numeroDocumento>
        <complemento xsi:nil='true'/>
        <codigoCliente>51158891</codigoCliente>
        <codigoMetodoPago>1</codigoMetodoPago>
        <numeroTarjeta xsi:nil='true'/>
        <montoTotal>99</montoTotal>
        <montoTotalSujetoIva>99</montoTotalSujetoIva>
        <codigoMoneda>1</codigoMoneda>
        <tipoCambio>1</tipoCambio>
        <montoTotalMoneda>99</montoTotalMoneda>
        <montoGiftCard xsi:nil='true'/>
        <descuentoAdicional>1</descuentoAdicional>
        <codigoExcepcion xsi:nil='true'/>
        <cafc xsi:nil='true'/>
        <leyenda>Ley N° 453: Tienes derecho a recibir información sobre las características y contenidos de los
            servicios que utilices.
        </leyenda>
        <usuario>pperez</usuario>
        <codigoDocumentoSector>1</codigoDocumentoSector>
    </cabecera>
        <detalle>
        <actividadEconomica>5911000</actividadEconomica>
        <codigoProductoSin>1003870</codigoProductoSin>
        <codigoProducto>JN-131231</codigoProducto>
        <descripcion>JUGO DE NARANJA EN VASO</descripcion>
        <cantidad>1</cantidad>
        <unidadMedida>1</unidadMedida>
        <precioUnitario>100</precioUnitario>
        <montoDescuento>0</montoDescuento>
        <subTotal>100</subTotal>
        <numeroSerie>124548</numeroSerie>
        <numeroImei>545454</numeroImei>
    </detalle>
</facturaElectronicaCompraVenta>";


    $xml = new SimpleXMLElement($data);
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $nameFile=microtime();
    $dom->save("archivos/".$nameFile.'.xml');

    firmar("archivos/".$nameFile.'.xml');

    $xml = new DOMDocument();
    $xml->load("archivos/".$nameFile.'.xml');
    if (!$xml->schemaValidate('./facturaElectronicaCompraVenta.xsd')) {
        echo "invalid";
    }
    else {
//    echo "validated";
    }
    $file = "archivos/".$nameFile.'.xml';
    $gzfile = "archivos/".$nameFile.'.xml'.'.gz';
    $fp = gzopen ($gzfile, 'w9');
    gzwrite ($fp, file_get_contents($file));
    gzclose($fp);

    $archivo=getFileGzip("archivos/".$nameFile.'.xml'.'.gz');
    $hashArchivo=hash('sha256', $archivo);

    $client = new \SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionCompraVenta?WSDL",  [
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
    $result= $client->recepcionFactura([
        "SolicitudServicioRecepcionFactura"=>[
            "codigoAmbiente"=>$codigoAmbiente,
            "codigoDocumentoSector"=>$codigoDocumentoSector,
            "codigoEmision"=>$codigoEmision,
            "codigoModalidad"=>$codigoModalidad,
            "codigoPuntoVenta"=>$codigoPuntoVenta,
            "codigoSistema"=>$codigoSistema,
            "codigoSucursal"=>$codigoSucursal,
            "cufd"=>$cufd,
            "cuis"=>$cuis,
            "nit"=>$nit,
            "tipoFacturaDocumento"=>$tipoFacturaDocumento,
            "archivo"=>$archivo,
            "fechaEnvio"=>$fechaEnvio,
            "hashArchivo"=>$hashArchivo,
        ]
    ]);
    var_dump($result);

////    exit();
////    sleep(1);
     $client = new \SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionCompraVenta?WSDL",  [
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
         "codigoAmbiente"=>$codigoAmbiente,
         "codigoDocumentoSector"=>$codigoDocumentoSector,
         "codigoEmision"=>$codigoEmision,
         "codigoModalidad"=>$codigoModalidad,
         "codigoPuntoVenta"=>$codigoPuntoVenta,
         "codigoSistema"=>$codigoSistema,
         "codigoSucursal"=>$codigoSucursal,
         "cufd"=>$cufd,
         "cuis"=>$cuis,
         "nit"=>$nit,
         "tipoFacturaDocumento"=>$tipoFacturaDocumento,
         "codigoMotivo"=>"1",
//         "cuf"=>"4522A0B5D29A38257E2BEE26C7AF4441330C9E06AF9EC5AD1DC87AF74",
            "cuf"=>$cuf,
     ];
//     error_log(print_r($data, true));
    $result= $client->anulacionFactura([
        "SolicitudServicioAnulacionFactura"=> $data
    ]);
    var_dump($result);
//    exit();
    $result= $client->reversionAnulacionFactura([
        "SolicitudServicioReversionAnulacionFactura"=>[
            "codigoAmbiente"=>$codigoAmbiente,
            "codigoDocumentoSector"=>$codigoDocumentoSector,
            "codigoEmision"=>$codigoEmision,
            "codigoModalidad"=>$codigoModalidad,
            "codigoPuntoVenta"=>$codigoPuntoVenta,
            "codigoSistema"=>$codigoSistema,
            "codigoSucursal"=>$codigoSucursal,
            "cufd"=>$cufd,
            "cuis"=>$cuis,
            "nit"=>$nit,
            "tipoFacturaDocumento"=>$tipoFacturaDocumento,
            "cuf"=>$cuf,
        ]
    ]);
    var_dump($result);
////    exit();
}



function getFileGzip($fileName)
{
    $fileName = $fileName;

    $handle = fopen($fileName, "rb");
    $contents = fread($handle, filesize($fileName));
    fclose($handle);

    return $contents;
}
function deleteFile()
{
    $files = glob('archivos/*'); //obtenemos todos los nombres de los ficheros
    foreach($files as $file){
        if(is_file($file))
            unlink($file); //elimino el fichero
    }
}

function firmar($fileName){
    $doc = new DOMDocument();
    $doc->load($fileName);

    $objDSig = new XMLSecurityDSig();
    $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
    $objDSig->addReference(
        $doc,
        XMLSecurityDSig::SHA256,
        array('http://www.w3.org/2000/09/xmldsig#enveloped-signature','http://www.w3.org/TR/2001/REC-xml-c14n-20010315#WithComments'),
        array('force_uri' => true)
    );
    $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, array('type'=>'private'));
    /*
    If key has a passphrase, set it using
    $objKey->passphrase = '<passphrase>';
    */
    $objKey->loadKey('key/privateKey.pem', TRUE);

    $objDSig->sign($objKey);

    $objDSig->add509Cert(file_get_contents('key/publicKey.pem'));

    $objDSig->appendSignature($doc->documentElement);
    $doc->save($fileName);
}
?>

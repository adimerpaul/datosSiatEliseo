<?php
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
require 'vendor/autoload.php';

require 'CUF.php';



date_default_timezone_set('America/La_Paz');
$cuis1="C5CD5D6";
$codigo1="JBQTlDTkVCQkE=ZDRTBFM0E5MTY=QkFhT3lLVUJhVUMzcxNTE1QjRCMT";
$codigoControl1="84F98C52987AF74"; //2023-03-01T16:56:05.359-04:00

$cuis0="57C54491";
$codigo0="FBQTlDTkVCQkE=ZDRTBFM0E5MTY=QjlPM2hMVUJhVUMzcxNTE1QjRCMT";
$codigoControl0="22ABCBD2987AF74"; //2023-03-01T16:55:06.383-04:00


$codigoPuntoVenta=1;
$codigoControl=$codigoControl1;
$cufd=$codigo1;
$cuis=$cuis1;

$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJpbXB1ZXN0b3Nfc2VsYTI2QGhvdG1haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjM3MTUxNUI0QjE2Q0UwRTNBOTE2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNME1EUXdNVFEyTURJREFLa1FHMHdLQUFBQSIsImlkIjo1MjM3NDgyLCJleHAiOjE3OTg3MTMwNzIsImlhdCI6MTc2ODgzMzA0Miwibml0RGVsZWdhZG8iOjEwMTA0MTMwMjYsInN1YnNpc3RlbWEiOiJTRkUifQ.zNYCnKSUrrsiolNlHC3PuYUQ0pNap_YjLWJPOYJ2kDZPNdc6imqUZmAnQxUgrokBxwNOWiE0M7NugDESR68geA";
$codigoAmbiente=2;
$codigoDocumentoSector=1;
$codigoEmision=1;
$codigoModalidad=1;

$cantidad=1;

$codigoSistema="371515B4B16CE0E3A916";
$codigoSucursal=0;

$nit="1010413026";
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
        <actividadEconomica>841001</actividadEconomica>
        <codigoProductoSin>99100</codigoProductoSin>
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
    /*$data="<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
<facturaComputarizadaCompraVenta xsi:noNamespaceSchemaLocation='facturaComputarizadaCompraVenta.xsd' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'>
    <cabecera>
        <nitEmisor>$nit</nitEmisor>
        <razonSocialEmisor>Carlos Loza</razonSocialEmisor>
        <municipio>La Paz</municipio>
        <telefono>78595684</telefono>
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
        <actividadEconomica>463000</actividadEconomica>
        <codigoProductoSin>62121</codigoProductoSin>
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
</facturaComputarizadaCompraVenta>";*/

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
    $result= $client->anulacionFactura([
        "SolicitudServicioAnulacionFactura"=>[
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
            "cuf"=>$cuf,
        ]
    ]);
    var_dump($result);
//    exit();
//    $result= $client->reversionAnulacionFactura([
//        "SolicitudServicioReversionAnulacionFactura"=>[
//            "codigoAmbiente"=>$codigoAmbiente,
//            "codigoDocumentoSector"=>$codigoDocumentoSector,
//            "codigoEmision"=>$codigoEmision,
//            "codigoModalidad"=>$codigoModalidad,
//            "codigoPuntoVenta"=>$codigoPuntoVenta,
//            "codigoSistema"=>$codigoSistema,
//            "codigoSucursal"=>$codigoSucursal,
//            "cufd"=>$cufd,
//            "cuis"=>$cuis,
//            "nit"=>$nit,
//            "tipoFacturaDocumento"=>$tipoFacturaDocumento,
//            "cuf"=>$cuf,
//        ]
//    ]);
//    var_dump($result);
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

<?php
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
require 'vendor/autoload.php';

require 'CUF.php';



date_default_timezone_set('America/La_Paz');
$cuis1="E0904311";
$codigo1="BQTlDTkVCQkE=NzjdEODFGRDM1NkU=QnwzQ1BQZUJhVUJIwREU2OTlBMjJBR";
$codigoControl1="35D8CD29EA7AF74"; //2023-03-01T16:56:05.359-04:00

$cuis0="2C3C1F15";
$codigo0="BQUE5Q05FQkJBNzjdEODFGRDM1NkU=QsKhI3dhUGVCYVVIwREU2OTlBMjJBR";
$codigoControl0="9DB54F39EA7AF74"; //2023-03-01T16:55:06.383-04:00


$codigoPuntoVenta=0;
$codigoControl=$codigoControl0;
$cufd=$codigo0;
$cuis=$cuis0;

$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJpbXB1ZXN0b3Nfc2VsYTI2QGhvdG1haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjcyMERFNjk5QTIyQUY3RDgxRkQzNTZFIiwibml0IjoiSDRzSUFBQUFBQUFBQURNME1EUXdNVFEyTURJREFLa1FHMHdLQUFBQSIsImlkIjo1MjM3NDgyLCJleHAiOjE3OTg3MTE1ODksImlhdCI6MTc2OTQzNjM1OSwibml0RGVsZWdhZG8iOjEwMTA0MTMwMjYsInN1YnNpc3RlbWEiOiJTRkUifQ.BQGlUf3cZLru_PtCPws35vqMrnvDfkyHTqxgizkt99Y0QuddVPFoNzv1_PM1SKyld8aPGaC6dbwnuyBRFogDFQ";
$codigoAmbiente="2";
$codigoDocumentoSector=13; //1 compra venta, 13 servicios basicos, 24 nota credito debito, 29 nota conciliacion
$codigoEmision=1;
$codigoModalidad=1;

$codigoSistema="720DE699A22AF7D81FD356E";
$codigoSucursal=0;

$nit="1010413026";
$tipoFacturaDocumento=1;


$temision=1;
$cdf=1;
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

for ($i=1;$i<=1;$i++){
    $miliSegundo=str_pad($i, 3, '0', STR_PAD_LEFT);
    $fechaEnvio=date("Y-m-d\TH:i:s").".$miliSegundo";
    $cuf = new CUF();
    $cuf = $cuf->obtenerCUF($nit, date("YmdHis$miliSegundo"), $codigoSucursal, $codigoModalidad, $temision, $cdf, $codigoDocumentoSector, $nf, $codigoPuntoVenta);
    $cuf=$cuf.$codigoControl;
    $xml = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
<facturaElectronicaServicioBasico xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance'
                                  xsi:noNamespaceSchemaLocation='facturaElectronicaServicioBasico.xsd'>
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
        <mes>Marzo</mes>
        <gestion>2022</gestion>
        <ciudad>La Paz</ciudad>
        <zona>Alto Obrajes</zona>
        <numeroMedidor>3456</numeroMedidor>
        <fechaEmision>$fechaEnvio</fechaEmision>
        <nombreRazonSocial>Mi razon social</nombreRazonSocial>
        <domicilioCliente>Av. Tejada Sorzano 231</domicilioCliente>
        <codigoTipoDocumentoIdentidad>1</codigoTipoDocumentoIdentidad>
        <numeroDocumento>5115889</numeroDocumento>
        <complemento xsi:nil='true'/>
        <codigoCliente>51158891</codigoCliente>
        <codigoMetodoPago>1</codigoMetodoPago>
        <numeroTarjeta xsi:nil='true'/>
        <montoTotal>100.50</montoTotal>
        <montoTotalSujetoIva>86</montoTotalSujetoIva>
        <consumoPeriodo xsi:nil='true'/>
        <beneficiarioLey1886 xsi:nil='true'/>
        <montoDescuentoLey1886 xsi:nil='true'/>
        <montoDescuentoTarifaDignidad xsi:nil='true'/>
        <tasaAseo>5</tasaAseo>
        <tasaAlumbrado>2</tasaAlumbrado>
        <ajusteNoSujetoIva>5</ajusteNoSujetoIva>
        <detalleAjusteNoSujetoIva>{'Ajuste por Reclamo':5}</detalleAjusteNoSujetoIva>
        <ajusteSujetoIva>10</ajusteSujetoIva>
        <detalleAjusteSujetoIva>{'Cobropor Reconexión':10}</detalleAjusteSujetoIva>
        <otrosPagosNoSujetoIva>7</otrosPagosNoSujetoIva>
        <detalleOtrosPagosNoSujetoIva>{'Pago Cuota Cooperativa':7}</detalleOtrosPagosNoSujetoIva>
        <otrasTasas>0.50</otrasTasas>
        <codigoMoneda>1</codigoMoneda>
        <tipoCambio>1</tipoCambio>
        <montoTotalMoneda>100.50</montoTotalMoneda>
        <descuentoAdicional xsi:nil='true'/>
        <codigoExcepcion xsi:nil='true'/>
        <cafc xsi:nil='true'/>
        <leyenda>Una leyenda</leyenda>
        <usuario>vjcm</usuario>
        <codigoDocumentoSector>13</codigoDocumentoSector>
    </cabecera>
    <detalle>
        <actividadEconomica>841001</actividadEconomica>
        <codigoProductoSin>991009</codigoProductoSin>
        <codigoProducto>123456</codigoProducto>
        <descripcion>Servicio Mes Febrero</descripcion>
        <cantidad>1</cantidad>
        <unidadMedida>58</unidadMedida>
        <precioUnitario>76</precioUnitario>
        <montoDescuento xsi:nil='true'/>
        <subTotal>76</subTotal>
    </detalle>
</facturaElectronicaServicioBasico>
    ");
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());
    $nameFile=microtime();
    $dom->save("archivos/".$nameFile.'.xml');

    firmar("archivos/".$nameFile.'.xml');

    $xml = new DOMDocument();
    $xml->load("archivos/".$nameFile.'.xml');
    if (!$xml->schemaValidate('./facturaElectronicaServicioBasico.xsd')) {
        echo "invalid";
    }
    else {
//        echo "validated";
    }
//    exit;
    $file = "archivos/".$nameFile.'.xml';
    $gzfile = "archivos/".$nameFile.'.xml'.'.gz';
    $fp = gzopen ($gzfile, 'w9');
    gzwrite ($fp, file_get_contents($file));
    gzclose($fp);

    $archivo=getFileGzip("archivos/".$nameFile.'.xml'.'.gz');
    $hashArchivo=hash('sha256', $archivo);

    $client = new \SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionServicioBasico?WSDL",  [
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
    $client = new \SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/ServicioFacturacionServicioBasico?WSDL",  [
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
    error_log(print_r($data, true));
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
    $objKey->loadKey('key/privatekey.pem', TRUE);

    $objDSig->sign($objKey);

    $objDSig->add509Cert(file_get_contents('key/publickey.pem'));

    $objDSig->appendSignature($doc->documentElement);
    $doc->save($fileName);
}
?>

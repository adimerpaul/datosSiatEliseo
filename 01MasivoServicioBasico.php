<?php
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
require 'vendor/autoload.php';

require 'CUF.php';



date_default_timezone_set('America/La_Paz');
$cuis1="C5CD5D6";
$codigo1="JBQTlDTkVCQkE=ZDRTBFM0E5MTY=Qjlrd0hKVkJhVUMzcxNTE1QjRCMT";
$codigoControl1="9EC5AD1DC87AF74"; //2023-03-01T16:56:05.359-04:00

$cuis0="57C54491";
$codigo0="FBQTlDTkVCQkE=ZDRTBFM0E5MTY=QkE7VnJJVkJhVUMzcxNTE1QjRCMT";
$codigoControl0="50369BBCC87AF74"; //2023-03-01T16:55:06.383-04:00


$codigoPuntoVenta=1;
$codigoControl=$codigoControl1;
$cufd=$codigo1;
$cuis=$cuis1;


$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJpbXB1ZXN0b3Nfc2VsYTI2QGhvdG1haWwuY29tIiwiY29kaWdvU2lzdGVtYSI6IjM3MTUxNUI0QjE2Q0UwRTNBOTE2Iiwibml0IjoiSDRzSUFBQUFBQUFBQURNME1EUXdNVFEyTURJREFLa1FHMHdLQUFBQSIsImlkIjo1MjM3NDgyLCJleHAiOjE3OTg3MTMwNzIsImlhdCI6MTc2ODgzMzA0Miwibml0RGVsZWdhZG8iOjEwMTA0MTMwMjYsInN1YnNpc3RlbWEiOiJTRkUifQ.zNYCnKSUrrsiolNlHC3PuYUQ0pNap_YjLWJPOYJ2kDZPNdc6imqUZmAnQxUgrokBxwNOWiE0M7NugDESR68geA";
$codigoAmbiente="2";
$codigoDocumentoSector=13; //1 compra venta, 13 servicios basicos, 24 nota credito debito, 29 nota conciliacion
$codigoEmision=3;//1 online, 2 offline, 3 masiva
$codigoModalidad=1;

$codigoSistema="371515B4B16CE0E3A916";
$codigoSucursal=0;

$nit="1010413026";
$tipoFacturaDocumento=1;


//$temision=1; //1 online, 2 offline, 3 masiva
$cdf=1; // 1 con credito fiscal 2 sin credito fiscal 3 nota credito debito
$nf=1;

$cantidadFacturas = 1;
$h="08";
$m="45";
$s="00";

for ($y=1;$y<=20;$y++){
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
    $c=-1;

    for ($i=1;$i<=$cantidadFacturas;$i++){
        $c++;
        $miliSegundo=str_pad($c, 3, '0', STR_PAD_LEFT);
        $fechaEnvio=date("Y-m-d\T$h:$m:$s").".$miliSegundo";
        $cuf = new CUF();
        $cuf = $cuf->obtenerCUF($nit, date("Ymd".$h.$m.$s."$miliSegundo"), $codigoSucursal, $codigoModalidad, $codigoEmision, $cdf, $codigoDocumentoSector, $nf, $codigoPuntoVenta);
        $cuf=$cuf.$codigoControl;
        $data = "<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
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
";
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
        if (!$xml->schemaValidate('./facturaElectronicaServicioBasico.xsd')) {
            echo "invalid";
        }
        else {
            echo "$i validated\n";
        }
    }
    $archiveName="archivos/archive".$y.".tar";
    createZip($archiveName);
    $archivo=getFileGzip($archiveName.".gz");
    $hashArchivo=hash('sha256', $archivo);
    $fechaEnvio=date('Y-m-d\TH:i:s.000');
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
    $result= $client->recepcionMasivaFactura([
        "SolicitudServicioRecepcionMasiva"=>[
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
            "cantidadFacturas"=>$cantidadFacturas,
//        "codigoEvento"=>619660,
//        "cafc"=>"1136CE62378D",
        ]
    ]);
    var_dump($result);

//var_dump($result->RespuestaServicioFacturacion->codigoRecepcion);
//exit();
//echo $result->RespuestaServicioFacturacion->codigoRecepcion;
    $sw=true;
    while ($sw){
        sleep(1);
        $result= $client->validacionRecepcionMasivaFactura([
            "SolicitudServicioValidacionRecepcionMasiva"=>[
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
                "codigoRecepcion"=>$result->RespuestaServicioFacturacion->codigoRecepcion
            ]
        ]);
        var_dump($result);
//    exit();
        if ($result->RespuestaServicioFacturacion->codigoDescripcion=="VALIDADA"){
            $sw=false;
        }
    }
    $svalInt = (int)$s+1;
    $s=str_pad($svalInt, 2, '0', STR_PAD_LEFT);
    error_log("s: ".$s);
}

function createZip($archiveName){
    try
    {
        $a = new PharData($archiveName);

        // ADD FILES TO archive.tar FILE
        $files = glob('archivos/*'); //obtenemos todos los nombres de los ficheros
        $count = 0;
        foreach($files as $file){
            error_log('creando zip: '.$file);
            $a->addFile($file); //Agregamos el fichero
            $count++;
            echo $count."\n";
        }

        // COMPRESS archive.tar FILE. COMPRESSED FILE WILL BE archive.tar.gz
        $a->compress(Phar::GZ);

        // NOTE THAT BOTH FILES WILL EXISTS. SO IF YOU WANT YOU CAN UNLINK archive.tar
//        unlink('archivos/archive.tar');
    }
    catch (Exception $e)
    {
        echo "Exception : " . $e;
    }
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

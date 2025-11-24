<?php
use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;
require 'vendor/autoload.php';

require 'CUF.php';



date_default_timezone_set('America/La_Paz');
$cuis1="ECB7F858";
$codigo1="JBQTlDcDM0QUE=k0ODUyMTVCQkU=Q3lpbGdUQktaVUMzUyMjkyREE1Mz";
$codigoControl1="11650A8C1D12F74"; //2023-03-01T16:56:05.359-04:00

$cuis0="CB4C4B6F";
$codigo0="FBQTlDcDM0QUE=k0ODUyMTVCQkU=Q28jSGdUQktaVUMzUyMjkyREE1Mz";
$codigoControl0="4251998C1D12F74"; //2023-03-01T16:55:06.383-04:00

//3573986
$codigoPuntoVenta=0;
$codigoControl=$codigoControl0;
$cufd=$codigo0;
$cuis=$cuis0;


$cantidad=1;
$codigoMotivoEvento=7;
$h="19";
$m="47";
$s="01";

//$codigoEvento=3629231;


//$s2=(int)$s+1;


$token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJheWFsYWVkc29uMjAxM0BnbWFpbC5jb20iLCJjb2RpZ29TaXN0ZW1hIjoiMzUyMjkyREE1Mzk0ODUyMTVCQkUiLCJuaXQiOiJINHNJQUFBQUFBQUFBRE0xTlRVeE1UUXdNZ01BbnFhbE1Ba0FBQUE9IiwiaWQiOjUwNjIzNzIsImV4cCI6MTc2NzIxMDc2NywiaWF0IjoxNzU4NjcxNTM3LCJuaXREZWxlZ2FkbyI6NTU1NDQxMDI2LCJzdWJzaXN0ZW1hIjoiU0ZFIn0.g5L5FEVm6OUo0h1nzlf3iATSp_THBZMVWFU8nPsgzooncshKMnhILmg5O8m5T6UqG-sbDUWNE6ClIquVW0uPRw";
$codigoAmbiente="2";
$codigoDocumentoSector=1; //1 compra venta, 13 servicios basicos, 24 nota credito debito, 29 nota conciliacion
$codigoEmision=2;//1 online, 2 offline, 3 masiva
$codigoModalidad=2;

$codigoSistema="352292DA539485215BBE";
$codigoSucursal=0;

$nit="555441026";
$tipoFacturaDocumento=1;




//$temision=1; //1 online, 2 offline, 3 masiva
$cdf=1; // 1 con credito fiscal 2 sin credito fiscal 3 nota credito debito
$nf=1;
$cafc="1011FCEF12A2C";

for ($y=1;$y<=10;$y++){
    deleteFile();
    $client = new SoapClient("https://pilotosiatservicios.impuestos.gob.bo/v2/FacturacionOperaciones?WSDL",  [
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
    $result= $client->registroEventoSignificativo([
        "SolicitudEventoSignificativo"=>[
            "codigoAmbiente"=>$codigoAmbiente,
            "codigoMotivoEvento"=>$codigoMotivoEvento,
            "codigoPuntoVenta"=>$codigoPuntoVenta,
            "codigoSistema"=>$codigoSistema,
            "codigoSucursal"=>$codigoSucursal,
            "cufd"=>$cufd,
            "cufdEvento"=>$cufd,
            "cuis"=>$cuis,
            "descripcion"=>$codigoMotivoEvento,
            "fechaHoraFinEvento"=>date("Y-m-d\T$h:$m:$s").".600",
            "fechaHoraInicioEvento"=>date("Y-m-d\T$h:$m:$s").".000",
            "nit"=>$nit
        ]
    ]);
    var_dump($result);
//    exit();
    $codigoEvento=$result->RespuestaListaEventos->codigoRecepcionEventoSignificativo;
//error_log("codigoMotivoEvento: ".json_encode($codigoMotivoEvento));
//exit;


    for ($i=1;$i<=$cantidad;$i++){
        $miliSegundo=str_pad($i, 3, '0', STR_PAD_LEFT);
        $fechaEnvio=date("Y-m-d\T$h:$m:$s").".$miliSegundo";
        $cuf = new CUF();
        $cuf = $cuf->obtenerCUF($nit, date("Ymd".$h.$m.$s."$miliSegundo"), $codigoSucursal, $codigoModalidad, $codigoEmision, $cdf, $codigoDocumentoSector, $nf, $codigoPuntoVenta);
        $cuf=$cuf.$codigoControl;
        $data="<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
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
        <cafc>$cafc</cafc>
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
</facturaComputarizadaCompraVenta>";
        $xml = new SimpleXMLElement($data);
        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xml->asXML());
        $nameFile=str_replace(' ', '', microtime());
        $dom->save("archivos/".$nameFile.'.xml');

//        firmar("archivos/".$nameFile.'.xml');

        $xml = new DOMDocument();
        $xml->load("archivos/".$nameFile.'.xml');
        if (!$xml->schemaValidate('./facturaComputarizadaCompraVenta.xsd')) {
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

    $result= $client->recepcionPaqueteFactura([
        "SolicitudServicioRecepcionPaquete"=>[
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
            "cantidadFacturas"=>$cantidad,
            "codigoEvento"=>$codigoEvento,
            "cafc"=>$cafc,
        ]
    ]);
    var_dump($result);
//    exit();
//var_dump($result->RespuestaServicioFacturacion);
//echo $result->RespuestaServicioFacturacion->codigoRecepcion;
    $sw=true;
    while ($sw){
        sleep(1);
        $result= $client->validacionRecepcionPaqueteFactura([
            "SolicitudServicioValidacionRecepcionPaquete"=>[
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
        if ($result->RespuestaServicioFacturacion->codigoDescripcion=="VALIDADA"){
            $sw=false;
        }
    }
    $svalInt = (int)$s+1;
    $s=str_pad($svalInt, 2, '0', STR_PAD_LEFT);
    error_log("s: ".$s);
//    exit();
}
exit();


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
    $file = $fileName;

    $handle = fopen($file, "rb");
    $contents = fread($handle, filesize($fileName));
    fclose($handle);

    return $contents;
}
function deleteFile()
{
    $files = glob('archivos/*'); //obtenemos todos los nombres de los ficheros
    foreach($files as $file){
        if(is_file($file)){
            unlink($file); //elimino el fichero
            error_log("borrando".$file);
        }
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

    $objDSig->add509Cert(file_get_contents('key/publicKey.pem'));

    $objDSig->appendSignature($doc->documentElement);
    $doc->save($fileName);
}
?>

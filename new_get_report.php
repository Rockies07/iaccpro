<?php

error_reporting(-1);
ini_set('display_errors', 1);

/*
$ml_id="53017735L";
$user_id="abkadm";
$api_key="MV14LOBHSXQNZOH2Q06BFJEFDA73W4APC";
$api_sec="JBFMJZKWASF29XLSG";
$product_code="BM";
$id_no="199800473M";
$id_type="UEN";
$nationality="SGP";
$is_pr="NO";
$id_name="A & T FREIGHT MANAGEMENT PTE LTD";
$loan_no="589";
$loan_type="UNSECURED";
$purpose_of_loan="BUSINESS";
$loan_amount="80000";
$income_pa="234033";
$income_6month="167016.50";
$ownership="OWNHDB3R";*/

$uen="198302653E";
$user_id="PGMGLBCAP2";
$api_key="R8ES5FLRF59PF6207CG489TTWNHR2PWED";
$api_sec="TT2C2ZEZWW6MY0R2Z";
$product_code="BM";
$id_no="200413022G";
$id_type="UEN";
$nationality="SGP";
$is_pr="NO";
$id_name="TEST";
$loan_no="1143";
$loan_type="UNSECURED";
$purpose_of_loan="BUSINESS";
$loan_amount="50000";
$income_pa="1";
$income_6month="0.5";
$ownership="OWNHDB3R";


$xml_str="<?xml version='1.0' encoding='utf-8'?>
<soap12:Envelope xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns:soap12='http://www.w3.org/2003/05/soap-envelope'>
  <soap12:Body>
    <GetMLCBRpt xmlns='mlcb.sg'>
      <MLInf>
        <MLId>$ml_id</MLId>
        <UsrId>$user_id</UsrId>
        <ApiKey>$api_key</ApiKey>
        <ApiSec>$api_sec</ApiSec>
      </MLInf>
      <ReqInf>
        <ProCod>$product_code</ProCod>
        <IDNo>$id_no</IDNo>
        <IDNam><![CDATA[$id_name]]></IDNam>
        <IDTyp>$id_type</IDTyp>
        <Nat>$nationality</Nat>
        <SPR>$is_pr</SPR>
        <LonAppNo>$loan_no</LonAppNo>
        <LonTyp>$loan_type</LonTyp>
        <LonPur>$purpose_of_loan</LonPur>
        <LonReqAmt>$loan_amount</LonReqAmt>
        <IncMon>$income_pa</IncMon>
        <IncPas6Mon>$income_6month</IncPas6Mon>
        <ProOwn>$ownership</ProOwn>
      </ReqInf>
    </GetMLCBRpt>
  </soap12:Body>
</soap12:Envelope>
";

$url = "https://203.117.203.142/mlcbws/mlcbws.asmx?WSDL";
$header  = "POST /MLCBWS/MLCBWS.asmx HTTP/1.1 \r\n";
$header .= "Host: www.mlcb.com.sg \r\n";
$header .= "Content-Type: application/soap+xml \r\n";
$header .= "Content-length: ".strlen($xml_str)." \r\n";
$header .= "Connection: close \r\n\r\n"; 
$header .= $xml_str;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 4);
//curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $header);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt($ch, CURLOPT_ENCODING, "UTF-8");


$response = curl_exec($ch); 

$xml = new SimpleXMLElement($response);
$sxml = simplexml_load_file($xml);

print_r($sxml);

var_dump($sxml);

echo "<br> $response";
var_dump($response);
$arr=json_encode($response);
print_r($arr);


?>
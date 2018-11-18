<?php

$sReceiver = '_____YOUR EMAIL HERE_____';

error_reporting(E_ALL);

/**
 * @throws Exception
 */
function checkApplePay()
{
    $sUrl = "https://smp-device-content.apple.com/static/region/v2/config.json";
    $oData = json_decode(file_get_contents($sUrl));

        $aReturn = array();

    foreach ($oData as $key_1 => $data_1) {
        switch ($key_1) {
            case 'SupportedRegions':
                foreach ($data_1 as $key_2 => $data_2) {
                    switch ($key_2) {
                        case 'US':
                        case 'GB':
                        case 'CA':
                        case 'AU':
                        case 'SG':
                        case 'CH':
                        case 'FR':
                        case 'MC':
                        case 'MQ':
                        case 'GF':
                        case 'RE':
                        case 'YT':
                        case 'MF':
                        case 'BL':
                        case 'PM':
                        case 'NC':
                        case 'WF':
                        case 'PF':
                        case 'CP':
                        case 'TF':
                        case 'AQ':
                        case 'GP':
                        case 'HK':
                        case 'RU':
                        case 'NZ':
                        case 'JP':
                        case 'ES':
                        case 'IE':
                        case 'GG':
                        case 'JE':
                        case 'IM':
                        case 'TW':
                        case 'IT':
                        case 'VA':
                        case 'SM':
                        case 'AE':
                        case 'SE':
                        case 'FI':
                        case 'DK':
                        case 'AX':
                        case 'IC':
                        case 'BR':
                        case 'UA':
                        case 'PL':
                        case 'NO':
                        case 'CN':
                            break;
                        default:
                            $aReturn[] = sprintf("New Region added: %s", $key_2);
                    }
                }
                break;
            case 'UnsupportedWebPaymentConfigurations':
            case 'version':
                break;
            default:
                throw new Exception("New Stage_1 Field", 1);
        }
    }

        return $aReturn;
}

try {
    $aReturn = checkApplePay($sReceiver);

        if(count($aReturn) !== 0) {
                $betreff = 'ApplePay - New Region found';

                $headers   = array();
                $headers[] = "MIME-Version: 1.0";
                $headers[] = "Content-type: text/plain; charset=utf-8";
                $headers[] = "From: {$sReceiver}";
                $headers[] = "Subject: {$betreff}";
                $headers[] = "X-Mailer: PHP/".phpversion();

        mail($sReceiver, $betreff, implode("\r\n", $aReturn), implode("\r\n",$headers), '-f'.$sReceiver);
        } else {
                #print 'nothing changed...';
        }
} catch (Exception $e) {
        #var_dump($e);
}

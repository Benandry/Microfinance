<?php
// src/Service/FileUploader.php
namespace App\Service;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode as QrCodeQrCode;
use Endroid\QrCode\Writer\PngWriter;

class QRcode {
    public function getQrCode($entity){
        $writer = new PngWriter();
        $qrCode = QrCodeQrCode::create("
                Code : ".$entity->getCodegroupe()." \n
                Nom :".$entity->getNomGroupe()."\n
                E-mail : ".$entity->getEmail()."\n
                Tel : ".$entity->getNumeroMobile())
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $label = Label::create('')->setFont(new NotoSans(8));
        $qrCodes['simple'] = $writer->write($qrCode,null,$label->setText('clientGroupe'))->getDataUri();

        return $qrCodes['simple'];
    }
}
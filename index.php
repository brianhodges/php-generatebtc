<?php
    require __DIR__ . '/vendor/autoload.php';
    require('QRGenerator.php');
    use BitWasp\Bitcoin\Bitcoin;
    use BitWasp\Bitcoin\Address;
    use BitWasp\Bitcoin\Key\PrivateKeyFactory;
    $br = "<br>";
    $network = Bitcoin::getNetwork();
    $compressed = false;
    $content = "";
    
    $privateKey = PrivateKeyFactory::create($compressed);
    $publicKey = $privateKey->getPublicKey();
    $compressed = true;
    $privateKeyCompressed = PrivateKeyFactory::fromHex($privateKey->getHex(), $compressed);
    $publicKeyCompressed = $privateKeyCompressed->getPublicKey();
    
    $content .= "<strong>Address:</strong>".$br.$publicKey->getAddress()->getAddress().$br;
    $qr_address = new QRGenerator($publicKey->getAddress()->getAddress(),100);
    $content .= "<img style='width: 200px; height: 200px;' src=".$qr_address->generate().">".$br;
    
    $content .= "<strong>Address (compressed):</strong>".$br.$publicKeyCompressed->getAddress()->getAddress().$br;
    $qr_address_compressed = new QRGenerator($publicKeyCompressed->getAddress()->getAddress(), 100);
    $content .= "<img style='width: 200px; height: 200px;' src=".$qr_address_compressed->generate().">".$br.$br.$br.$br;
    
    $content .= "<strong>Public Key:</strong>".$br.$publicKey->getHex().$br;
    $content .= "<strong>Public Key (compressed):</strong>".$br.$privateKeyCompressed->getPublicKey()->getHex().$br.$br.$br.$br;
    
    $content .= "<strong>Private Key (WIF):</strong>".$br.$privateKey->toWif($network).$br;
    $qr_priv_key = new QRGenerator($privateKey->toWif($network),100);
    $content .= "<img style='width: 200px; height: 200px;' src=".$qr_priv_key->generate().">".$br;
    
    $content .= "<strong>Private Key:</strong>".$br.$privateKey->getHex().$br;
    $qr_priv_key_compressed = new QRGenerator($privateKey->getHex(),100);
    $content .= "<img style='width: 200px; height: 200px;' src=".$qr_priv_key_compressed->generate().">".$br.$br;
    
    echo $content;
?>
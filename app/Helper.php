<?php

use peal\barcodegenerator\Facades\BarCode;

function getRelatedKeyword($query){
    $keywords = array();

}


function barcode($text=''){
    $barcontent = '<img class="barcode" src="data:image/png;base64,' . DNS1D::getBarcodePNG($text, 'C128') . '" alt="barcode"   />';

        return $barcontent;
}

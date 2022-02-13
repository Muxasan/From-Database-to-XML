<?php
class xmlconverter {

    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function createXMLfile($result) {

        $filePath = $this->filePath;
        $dom = new DOMDocument('1.0', 'utf-8'); 
        $root = $dom->createElement('kristall-voda');
        $i = 1;
        
        while($row = $result->fetch()){
            $product = $dom->createElement('product');
            $product->setAttribute(key($row), $i);
            
            foreach($row as $key => $rowe){
                if($rowe != NULL){
                    $next = $dom->createElement($key, $rowe);
                    $product->appendChild($next); 
                }
            }
            
            $root->appendChild($product);
            $i++;
        }
        
        $dom->appendChild($root); 
        $dom->save($filePath); 
    }
}


<h1> SOAP </h1>
<? 


//to flush wsdl catch of desrciptions in soap server on reediting
ini_set("soap.wsdl_cache_enabled", "0");


$client=new SoapClient('http://localhost/yii_framework/cms_demo/Ajax/quote');


echo CHtml::link("WSDL Description",Yii::app()->baseUrl."/Ajax/quote");
//print_r($client);
//echo $client->getPrice('GOOGLE');
echo "<h4>Soap Client :</h4>";
echo "<pre/>";
print_r($client);
echo "</pre>";

$model = $client->getUsers();
echo "<h4>data bringing up using soap object call :</h4>";
echo "<pre/>";
foreach ($model as $row)
    print_r($row->_attributes);

echo "<h4>Discription :</h4>";
echo "<iframe height='600px' width='100%' src=".$this->createUrl('/Ajax/quote')."></iframe>";
//print_r($model);

//foreach()
//{
//    
//}

?>
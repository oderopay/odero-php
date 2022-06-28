<?php
require_once "client.php";

$deleteCard = $oderopay->cards->delete('sample-card-token');

if($deleteCard->isSuccess()){
    dump($deleteCard->toArray());
}else{
    echo $deleteCard->message;
}

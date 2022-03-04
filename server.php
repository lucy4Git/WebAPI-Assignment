<?php

function isSetAll($elements){
    $isSet = [];
    foreach($elements as $element){
        if(!isset($_POST[$element])){
            array_push($isSet,false);
        }
    }
    $count = count($isSet);
    return $count;
}

function data($key){
    return $_POST[$key];
}

if(isSetAll(["name","email","phone_number","marital_status","gender","national_card"]) == 0 && isset($_FILES["picture"]) == 1){
    $image = $_FILES['picture']['tmp_name'];
    
    $user = $_POST["name"];
    $email = $_POST["email"];
    $image_id = $user.'_'.$email;
    $path = 'uploads/'.$image_id;
    
    copy($_FILES['picture']['tmp_name'], $path);
    $image_url = 'uploads/'.$image_id;
    
    echo '
    <p id="title">RESPONSE FROM SERVER</p>
    <div id="response__header">
            <img src="'.$image_url.'" alt="" id="receipt__img" width="100%">
        </div>
        <div id="response__footer">
            <span><strong>Name:</strong> '.data('name').'</span>
            <p>
            <span><strong>Email:</strong> '.data('email').'</span>
            </p>
            <p>
            <span><strong>Phone Number:</strong> '.data('phone_number').'</span>
            </p>
            <p>
            <span><strong>Marital Status:</strong> '.data('marital_status').'</span>
            </p>
            <p>
            <span><strong>Gender:</strong> '.data('gender').'</span>
            </p>
            <p>
            <span><strong>National ID Number:</strong> '.data('national_card').'</span>
            </p>
        </div>';
}
else{
    echo "Error with Data. Some Posted data isn't available.";
}

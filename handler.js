document.addEventListener("DOMContentLoaded",()=>{
    
    getRef("submit").addEventListener("click", function(e){
        e.preventDefault();
        makeRequest({name: getData("registrationForm__name"), email: getData("registrationForm__email"),phone_number: getData("registrationForm__phone"),marital_status: getData("registrationForm__marital"),gender: getData("registrationForm__gender"),national_card: getData("registrationForm__card"),picture: new File([getRef("registrationForm__pic").files[0]], 'picture')});
        getRef("response").style.boxShadow = "2px 2px 10px 2px rgba(0,0,0,.09)"
    })
});


function makeRequest(data){
    let xhr = new XMLHttpRequest();
    let formdata = new FormData();
    
    for( name in data ) {
    formdata.append( name, data[name]);
    }
  
    xhr.onreadystatechange = function(){
        if(xhr.status == 200 && xhr.readyState == 4){
	document.getElementById('formbody').style.display = "none";
            getRef("response").innerHTML = xhr.response;
        }
    };
    xhr.open("POST","server.php");
    xhr.send(formdata);
}

function getData(ref){
    return getRef(ref).value;
}

function getRef(ref){
    return document.getElementById(ref);
}

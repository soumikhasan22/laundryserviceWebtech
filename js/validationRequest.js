
function validateForm() {
    var isValid = true;

    
    document.getElementById('nameError').innerHTML = '';
    document.getElementById('addressError').innerHTML = '';
    document.getElementById('contactError').innerHTML = '';
    document.getElementById('dateError').innerHTML = '';
    document.getElementById('timeError').innerHTML = '';
    document.getElementById('itemsError').innerHTML = '';

   
    var name = document.getElementById('customername').value;
    var address = document.getElementById('customeraddress').value;
    var contact = document.getElementById('customercontact').value;
    var pickupDate = document.getElementById('pickupdate').value;
    var pickupTime = document.getElementById('pickuptime').value;
    var launderedItems = document.getElementById('laundereditems').value;
    
    
    var namePattern = /^[A-Za-z\s]+$/;
    if (name == "" || !namePattern.test(name)) {
        document.getElementById('nameError').innerHTML = "Please enter a valid customer name (alphabetic only).";
        isValid = false;
    }

    
    if (address == "" ) {
        document.getElementById('addressError').innerHTML = "Please enter a valid customer address.";
        isValid = false;
    }

    
    var phonePattern = /^01[3-9]\d{8}$/;
    if (contact == "" || !phonePattern.test(contact)) {
        document.getElementById('contactError').innerHTML = "Please enter a valid Bangladeshi phone number";
        isValid = false;
    }

    
    if (pickupDate == "") {
        document.getElementById('dateError').innerHTML = "Please select a pickup date.";
        isValid = false;
    }

  
    if (pickupTime == "") {
        document.getElementById('timeError').innerHTML = "Please select a pickup time.";
        isValid = false;
    }

   
    if (launderedItems == "") {
        document.getElementById('itemsError').innerHTML = "Please specify items to be laundered.";
        isValid = false;
    }

    return isValid;
}
    function searchrequest()
    {

        var request =document.getElementById("search").value;
        var xttp=new XMLHttpRequest();
        xttp.onreadystatechange=function()
        {
          if (this.readyState==4 && this.status==200)
        document.getElementById("show").innerHTML=this.responseText;
        };
        xttp.open("GET","../control/ajaxmanagement.php?search="+request,true);
        xttp.send();
}
    




function releaseKeyUn(x){
  readyCreateAccount();
}

function focusPassword(x){
  document.getElementsByClassName("requeriments")[0].style.display = "block";
}

function releaseKeyPsw(x){
  const element = document.getElementsByClassName("req");
  element[0].innerHTML = "&#10008;";
  element[1].innerHTML = "&#10008;";
  if((/(?=.*\d)/).test(x)) {
    element[0].innerHTML = "&#x2713;";  
  }
  if((/.{8,}/).test(x)) {
    element[1].innerHTML = "&#x2713;";  
  }
  readyCreateAccount();
}

function releaseKeyVerifyPsw(x){
  const element = document.getElementsByClassName("req");
  element[2].innerHTML = "&#10008;";
  if(x == document.getElementsByName("pw")[0].value) {
    element[2].innerHTML = "&#x2713;";  
  }
  readyCreateAccount();
}

function readyCreateAccount() {
  const valuePw = document.getElementsByName("pw")[0].value;
  const valueVPw = document.getElementsByName("vpw")[0].value;
  const valueUs =  document.getElementsByName("un")[0].value;
  document.getElementsByName("new-account-button")[0].disabled = !((valuePw == valueVPw) && (/(?=.*\d)/).test(valuePw) && (/.{8,}/).test(valuePw) && !(valueUs == "")); 
}

function blurQty(x) {
  if(isNaN(x) || x <= 0){
    alert ("Quantity should be greather than zero");
    document.getElementById("qty").value = 1;
    document.getElementById("qty").focus();
  }
}
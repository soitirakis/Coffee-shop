"use strict";

//validate the form
function showError(){
  var name = document.forms["regForm"]["nume"];
  var nr = document.forms["regForm"]["number"];
  var data = document.forms["regForm"]["reserve"];
  var message = document.forms["regForm"]["message"];
  var today = new Date().getDate();
  var local_hour = new Date().getHours();
  var ore_functionare = ["06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16"];

  var nameErr = document.querySelector("#nume + span.error");
  var nrErr = document.querySelector("#number + span.error");
  var dataErr = document.querySelector("#reserve + span.error");
  var messageErr = document.querySelector("#message + span.error");


  if(name.value === ""){
    nameErr.textContent = "Enter your name!";
    name.focus();
    return false;
  }else if (name.value.length < 3){
    nameErr.textContent = "Name not valid!";
    name.focus();
    return false;
  } else {
    nameErr.textContent = "";
  }

  if(nr.value === ""){
    nrErr.textContent = "Enter the number of persons!";
    nr.focus();
    return false;
  }else if (isNaN(nr.value)) {
    nrErr.textContent = "Insert a number!";
    nr.focus();
    return false;
  }else{
    nrErr.textContent = "";
  }

  if(data.value === ""){
    dataErr.textContent = "Select the date!";
    data.focus();
    return false;
  }else if (parseInt(data.value.substring(8,10)) < today) {
    dataErr.textContent = "Not valid day. Day in the past";
    data.focus();
    return false;
  }else if (ore_functionare.includes(data.value.substring(11,13)) === false) {
    dataErr.textContent = "Not in the working hours";
    data.focus();
    return false;
  }else if( (parseInt(data.value.substring(8,10)) == today) && (local_hour > 16 )){
    dataErr.textContent = "Already close. Come back tomorrow!";
    data.focus();
    return false;
  }else{
    dataErr.textContent = "";
    let ziua = data.value.substring(8,10);
    let ora = data.value.substring(11,13);
    console.log(data.value);
    console.log(today);
    console.log(parseInt(ziua));
    console.log(ora);
  }

  if(message.value === ""){
    messageErr.textContent = "Enter your message!";
    message.focus();
    return false;
  }

   return true;

}


//switch menu
function openMenu(evt, menuName){
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for(i = 0; i < tabcontent.length; i++){
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for(i = 0; i < tablinks.length; i++){
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.className += " active";
}

//add google map - Bucharest
function initMap(){
  var uluru = {lat: 44.426, lng: 26.102};
  var map = new google.maps.Map(
    document.getElementById("map"), {zoom: 4, center: uluru});
  var marker = new google.maps.Marker({position: uluru, map: map});
}

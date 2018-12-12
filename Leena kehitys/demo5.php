<!doctype html>
<html>
<head>

<script>
var pyynto;

function alusta_pyynto() {
    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
      pyynto=new XMLHttpRequest();
    }
    else {// code for IE6, IE5
      pyynto=new ActiveXObject("Microsoft.XMLHTTP");
    }
}

function kasittele_vastaus() { //tämä funktio käsittelee vastauksen
    if (pyynto.readyState==4 && pyynto.status==200){
        var pelaajat = JSON.parse(pyynto.responseText);
        naytaTaulukko(pelaajat);
    }
}


function suorita_pyynto() {
    alusta_pyynto();
    pyynto.onreadystatechange = kasittele_vastaus;
    pyynto.open("GET","http://magnesium/dat16syst/miko.leppanen/Leena%20kehitys/demo5_yhteys.php",true);
    pyynto.send();

}


function naytaTaulukko(pelaajat){
    var taulukko=[];
    for (var i = 0; i < pelaajat.length; i++) {
        for (var avain in pelaajat[i]) {
            if (taulukko.indexOf(avain) === -1) {
                taulukko.push(avain);
            }
        }
    }
    
    var table = document.createElement("table");
    
    for(var i = 0; i < pelaajat.length; i++){
        
        tr = table.insertRow(-1); //lisää rivin taulukon loppuun
            
        for(var j = 0; j < taulukko.length; j++) {
        
            var tabCell = tr.insertCell(-1); //lisää solun rivin loppuun
            tabCell.innerHTML = pelaajat[i][taulukko[j]];
        }
    }
    
    var sisaltodiv = document.getElementById("naytadata");
    sisaltodiv.innerHTML = "",
    sisaltodiv.appendChild(table);
}
 </script>
</head>
<body>
<input type="button" onclick="suorita_pyynto()" value="Luo taulukko">

<div id="naytadata"></div>

</body>
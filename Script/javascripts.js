function confirmDeleteAccount() {
    var x = confirm("Your account will be deleted");
    return x;
}

function confirmEditAccount() {
    var x = confirm("Your account will be edited");
    return x;
}

function confirmChangePassword() {
    var x = confirm("Your password will be changed");
    return x;
}

function validateEditPasswordForm(firstpassword, secondpassword) {
    if (!(validatePassword(firstpassword, secondpassword))) {
        return false;
    } else return confirmChangePassword();
}

function changePrize(index, maximalLength) {
    var zlava = getCookie("kupon");

    var celkovaCena = 0.0;

    var pocetKusov = document.getElementById(index).value.trim();

    var obj = new XMLHttpRequest();

    obj.open("GET", "home.txt", true);

    obj.send();

    var idMenenej = document.getElementById(index + "id").value.trim();

    var aktualnaCena = document.getElementById("cenaPolozky" + index).innerHTML;
    aktualnaCena = makeDoubleOfInput(aktualnaCena);
    aktualnaCena = aktualnaCena * pocetKusov;

    celkovaCena += parseFloat(aktualnaCena);


    for (let i = 0; i < maximalLength; i++) {
        if (index != i) {
            var celkovaCenaPolozky = document.getElementById("celkovaCenaPolozky" + i.toString()).innerHTML;
            celkovaCenaPolozky = makeDoubleOfInput(celkovaCenaPolozky);

            celkovaCena += parseFloat(celkovaCenaPolozky);
        }


    }


    celkovaCena = celkovaCena - (celkovaCena / 100 * zlava);

    obj.onreadystatechange = function () {

        aktualnaCena = formatOutputFromDouble(aktualnaCena);

        document.getElementById("celkovaCenaPolozky" + index).innerHTML = aktualnaCena;

        var cenaBezDph = celkovaCena;

        celkovaCena = formatOutputFromDouble(celkovaCena);

        document.getElementById("cenaDokopy").innerHTML = celkovaCena + " with VAT";

        cenaBezDph = cenaBezDph * 0.8;

        cenaBezDph = formatOutputFromDouble(cenaBezDph);

        document.getElementById("cenaBezDph").innerHTML = cenaBezDph + " without VAT";

        obj.open("GET", "../Controller/aktualizujPocetKusov.php?pocet=" + pocetKusov + "&idPolozky=" + idMenenej, true);
        obj.send();
    }

}

function makeDoubleOfInput(number) {
    number = number.slice(0, -2);
    number = number.replace(",", ".");

    return number;
}

function formatOutputFromDouble(input) {
    input = input.toFixed(2);
    input = input.replace(".", ",");
    input = input + " €";

    return input;
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function skontrolujKupon(maximalLength) {
    str = document.getElementById("textKupon").value;

    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let expires = getDate();

            const array = this.responseText.split(".");

            if (array[0].localeCompare("Coupon accepted") == 0) {

                document.cookie = "kupon" + "=" + array[1] + ";" + expires + ";path=/";
                document.cookie = "kodKuponu" + "=" + str + ";" + expires + ";path=/";
            }

            document.getElementById("upozornenieKupon").innerHTML = array[0];

            changePrize(0, maximalLength);

        }
    };
    xhttp.open("GET", "../Controller/skontrolujKupon.php?q="+str, true);
    xhttp.send();



}

function getDate() {
    const d = new Date();
    d.setTime(d.getTime() + (2*60*1000));
    let expires = "expires="+ d.toUTCString();

    return expires;

}

function getOption() {
    selectElement = document.querySelector('#balenieBox');
    output = selectElement.value;

    const splitArray = output.split("|");

    prize = splitArray[0];
    weight = splitArray[1];

    output = parseFloat(prize).toFixed(2);

    var obj = new XMLHttpRequest();

    obj.open("GET", "home.txt", true);

    obj.send();

    obj.onreadystatechange = function() {

        document.getElementById("cenaProduktu").innerHTML = output + " €";
    }


    let expires = getDate();

    document.cookie = "balenie" + "=" + weight + ";" + expires + ";path=/";
    document.cookie = "cena" + "=" + prize + ";" + expires + ";path=/";
}

function setFlavour() {
    let expires = getDate();

    selectElement = document.querySelector('#prichutBox');
    prichut = selectElement.value;

    document.cookie = "prichut" + "=" + prichut + ";" + expires + ";path=/";
}

function setPieces() {
    selectElement = document.querySelector('#pocetKusovBtn');
    pocet = selectElement.value;

    let expires = getDate();

    document.cookie = "pocetKusov" + "=" + pocet + ";" + expires + ";path=/";
}

function setDoprava(str) {
    let expires = getDate();

    document.cookie = "doprava" + "=" + str + ";" + expires + ";path=/";
}

function setPlatba(str) {
    let expires = getDate();

    document.cookie = "platba" + "=" + str + ";" + expires + ";path=/";
}

function nedostupne() {
    alert("This feature will be available soon!");
}

function openNav() {

    left = document.getElementById("categories-box").style.left;


    if (left.localeCompare("20vw") == 0) {
        document.getElementById("categories-box").style.left = "-30vw";
    } else {
        document.getElementById("categories-box").style.left = "20vw";
    }
}

const ids = ["myDropdown", "myDropdown2","myDropdown3","myDropdown4","myDropdown5","myDropdown6",
    "myDropdown7","myDropdown8","myDropdown9"];

function myFunction(number) {
    deleteBeforeOpenedMenu();
    document.getElementById(ids[number]).classList.toggle("show");

}



function deleteBeforeOpenedMenu() {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        deleteBeforeOpenedMenu();
    }
}



var limitFunc = function(){
    if (window.outerWidth>816){

        document.getElementById("categories-box").style.left = "12vw";

    } else {
        document.getElementById("categories-box").style.left = "-30vw";
    }
};

window.addEventListener("resize", limitFunc);
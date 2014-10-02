
//****  Weergave van RRnr van raw data uit DB ****//

window.onload = function () {
    // rijksregisternummer weergeven met tekens
    // array met alle divs (met rijksregisternummer)
    var arrRijksnummerElementen = document.getElementsByClassName("rijksregisternummer");
    var arrRijksnummer = new Array();
    var arrWeergaveRijksnummer = new Array();
    // maak nieuwe array met de waarde (rijksregisternummers) uit de array met divs
    for (i = 0; i < arrRijksnummerElementen.length; i++) {
        arrRijksnummer[i] = arrRijksnummerElementen[i].innerHTML;
        if (arrRijksnummer[i].length === 11) {
            arrRijksnummer[i] = arrRijksnummer[i].split('');
            arrRijksnummer[i] = arrRijksnummer[i][0] + arrRijksnummer[i][1] + "." + arrRijksnummer[i][2] + arrRijksnummer[i][3] + "." + arrRijksnummer[i][4] + arrRijksnummer[i][5] + "-" + arrRijksnummer[i][6] + arrRijksnummer[i][7] + arrRijksnummer[i][8] + "." + arrRijksnummer[i][9] + arrRijksnummer[i][10];
            arrRijksnummerElementen[i].innerHTML = arrRijksnummer[i];
        }
    }
};
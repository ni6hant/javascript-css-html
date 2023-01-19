

function compute() {
    p = document.getElementById("principal").value;
    if (p <= 0) {
        alert("Enter a positive number");
        document.getElementById("principal").focus();
    }
    var principal = document.getElementById("principal").value;
    var rate = document.getElementById("rate").value;
    var years = document.getElementById("years").value;
    var year = new Date().getFullYear() + parseInt(years);
    var interest = principal * years * rate / 100;
    document.getElementById("result").innerHTML = "If you deposit " + principal + ",\<br\>at an interest rate of " + rate + "%\<br\>You will receive an amount of " + interest + ",\<br\>in the year " + year + "\<br\>"
    changebackground();
}

function updateRate() {
    var rateval = document.getElementById("rate").value;
    document.getElementById("rate_val").innerText = rateval;
}

function changebackground() {
    document.getElementById('result').style.backgroundColor = 'yellow';
}
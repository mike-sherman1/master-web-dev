//input function
function input() {
    "use strict";
    var length = document.getElementById("length").value; //read value from user input
    if (isNaN(length)) {
        throw new Error("not a number."); //throw error if not a number
    }
    if (length === "") {
        throw new Error("empty."); //throw error if nothing entered
    }
    return document.getElementById("length").value; //return input value
}

//output function
function output(left, right) {
    "use strict";
    document.getElementById("result").innerHTML = left + " = " + right; //output results; input on left, output on right
    
}

//inches to centimeters
document.getElementById("in_to_cm").onclick = function () {
    "use strict";
    try {
        var inches = input(), cm = inches * 2.54; //convert inches to cm
        cm = cm.toFixed(2); //set decimal precision to 2
        inches = parseFloat(inches).toFixed(2); //set decimal precision to 2
        output(inches + " inches", cm + " centimeters"); //output results
    } catch (err) {
        document.getElementById("result").innerHTML = err; //catch and output errors
    }
};

//centimeters to inches
document.getElementById("cm_to_in").onclick = function () {
    "use strict";
    try {
        var cm = input(), inches = cm / 2.54; //convert cm to inches
        inches = inches.toFixed(2); //set decimal precision to 2
        cm = parseFloat(cm).toFixed(2); //set decimal precision to 2
        output(cm + " centimeters", inches + " inches"); //output results
    } catch (err) {
        document.getElementById("result").innerHTML = err; //catch and output errors
    }
};
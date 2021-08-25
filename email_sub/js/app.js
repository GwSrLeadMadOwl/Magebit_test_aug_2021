// document.getElementById("post_button").addEventListener("click", emailSubmit());
document.getElementById("submitForm").addEventListener("submit", (e) => {
    e.preventDefault();
    const email = document.getElementById('email_input').value;
    const checkTOS = document.getElementById('check_tos').checked;

    if (email === '') {
        document.getElementById("message").innerHTML = "Email address is required";
    }

    if (isEmailValid(email) && !checkTOS) {
        document.getElementById("message").innerHTML = "You should accept the terms and conditions";
    }

    if (!isEmailValid(email) && email !== '') {
        document.getElementById("message").innerHTML = "Please provide a valid e-mail address";
    }

    if (isEmailFromColumbia(email)) {
        document.getElementById("message").innerHTML = 'We are not accepting subscriptions from Colombia emails';
    }

    if (isEmailValid(email) && checkTOS) {
        document.getElementById("intro").classList.add("hide");
        document.getElementById("succeded").classList.remove("hide");
        document.getElementById("succeded").classList.add("show");

        //insert email into mysql database
        const http = new XMLHttpRequest();
        http.onreadystatechange = function () {
            if (http.readyState === 4) {
                if (http.status === 200) {
                    console.log(http.responseText);
                } else {
                    console.log("Unexpected result: " + http.status);
                }
            }
        };
        http.open("POST", "./php/process.php", true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http.send("email=" + email);
    }
});

const isEmailValid = (email) => {
    // regex pattern check if email is valid
    const regex = new RegExp('^\\w+@[a-zA-Z_]+?\\.[a-zA-Z]{2,3}$');

    return regex.test(email) !== isEmailFromColumbia(email);
};

const isEmailFromColumbia = (email) => {
    // regex pattern check if email is from Columbia with domain (.co and .CO)
    const regex = new RegExp('([\\\\.]co|[\\\\.]CO)$');

    return regex.test(email);
};


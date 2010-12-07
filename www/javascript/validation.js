/* REGISTRATION VALIDATION
 *
 * This code was inspired by the following tutorial:
 * http://www.webcheatsheet.com/javascript/form_validation.php
 */

function validateRegistration(form) {
	var reason = "";
	
	reason += validateUsername(form.newusername);
	reason += validatePassword(form.newpassword, form.newpwrepeat);
	reason += validateAnswers(form.answer1, form.answer2, form.answer3);

	if (reason != "") {
		alert("Some fields were not properly filled in:\n" + reason);
		return false;
	}

	return true;
}

function validateUsername(username) {
	var error = "";
	var illegalChars = /\W/;
	
	if (username.value == "") {
		username.style.background = 'yellow';
		error = "You didn't enter a username.\n";
	}
	else if (username.value.length > 20) {
		username.style.background = 'yellow';
		error = "Your username must be less than 20 characters long.\n";
	}
	else if (illegalChars.test(username.value)) {
		username.style.background = 'yellow';
		error = "Your username contains illegal characters.\n";
	}
	else {
		username.style.background = 'white';
	}
	return error;
}

function validatePassword(password, pwrepeat) {
	var error = "";
	
	if (password.value == "") {
		password.style.background = 'yellow';
		error = "You didn't enter a password.\n";
	}
	else if (password.value.length < 6) {
		password.style.background = 'yellow';
		error = "Your password must be at least 6 characters long.\n";
	}
	else if (password.value.length > 20) {
		password.style.background = 'yellow';
		error = "Your password must be less than 20 characters long.\n";
	}
	else if (password.value != pwrepeat.value) {
		pwrepeat.style.background = 'yellow';
		error = "The two passwords you entered do not match.\n";
	}
	else {
		pwrepeat.style.background = 'white';
		password.style.background = 'white';
	}
	return error;
}

function validateAnswers(answer1, answer2, answer3) {
	var error = "";
	
	if (answer1.value != "") {
		if (answer2.value == "" || answer3.value == "") {
			error = "You must answer all three questions, or leave them all blank."
			answer1.style.background = 'yellow';
			answer2.style.background = 'yellow';
			answer3.style.background = 'yellow';
		}
	}
	else if (answer2.value != "") {
		if (answer1.value == "" || answer3.value == "") {
			error = "You must answer all three questions, or leave them all blank."
			answer1.style.background = 'yellow';
			answer2.style.background = 'yellow';
			answer3.style.background = 'yellow';
		}
	}
	else if (answer3.value != "") {
		if (answer1.value == "" || answer2.value == "") {
			error = "You must answer all three questions, or leave them all blank."
			answer1.style.background = 'yellow';
			answer2.style.background = 'yellow';
			answer3.style.background = 'yellow';
		}
	}
	else {
		answer1.style.background = 'white';
		answer2.style.background = 'white';
		answer3.style.background = 'white';
	}

	return error;
}

/* AD VALIDATION */

function validateAd(form) {
	var reason = "";
	price = 0.10;
	//price = (int)"<?= $adPrice ?>";
	
	reason += validateContent(form.content);
	reason += validateCounter(form.counter);
	reason += validateKeywords(form.keyword1, form.keyword2, form.keyword3, form.keyword4
		form.keyword5, form.keyword6, form.keyword7, form.keyword8, form.keyword9, form.keyword10);

	if (reason != "") {
		alert("Some fields were not properly filled in:\n" + reason);
		return false;
	}
	else {
		return confirm("You will be billed $" + (price*form.counter) + ".\nDo you wish to continue?");
	}
}

function validateContent(content) {
	var error = "";
	
	if (username.value == "") {
		error = "You must enter content for your ad.\n";
	}
	else if (username.value.length > 500) {
		error = "Your ad is " + username.value.length + " characters long, the maximum size is 500.\n";
	}
	return error;
}

function validateCounter(counter) {
	// Check for int between 1 and 500 000 000
}

function validateKeywords(keyword1,keyword2,keyword3,keyword4,keyword5,keyword6,keyword7,keyword8,keyword9,keyword10) {
	// Check for word characters, length between 1 and 20
}

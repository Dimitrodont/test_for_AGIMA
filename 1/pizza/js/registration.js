console.log("include registration.js");

let form = document.getElementById("form");
let login = document.getElementById("login");
let login_span = document.getElementById("login_span");
let password = document.getElementById("password");
let password_span = document.getElementById("password_span");
let password_rep = document.getElementById("password_rep");
let password_rep_span = document.getElementById("password_rep_span");


let banChars = ['/', '|', '>', '<'];

form.onsubmit = function(){	// срабатывает при нажатии на submit
	let flag = true;
	for(let i = 0; i < banChars.length; i++){	// проверка логина на запрещенные символы
		if(login.value.includes(banChars[i])){
			flag = false;
			login_span.style.color = "red";
			break;
		}else{
			login_span.style.color = "black";
		}
	}
	if(password.value.length < 6){	// проверка длинны пароля
		flag = false;
		password_span.style.color = "red";
	}else{
		password_span.style.color = "black";
	}
	if(password.value != password_rep.value){	// проверка совпадения паролей
		flag = false;
		password_rep_span.style.color = "red";
	}else{
		password_rep_span.style.color = "black";
	}

	return flag;	/* если вернет true - форма отправится, если false - не отправится*/
}
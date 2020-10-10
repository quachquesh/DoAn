// Message Box/ msgbox
var msgBoxElement = document.getElementById('message-box');
var msgBoxOverLayElement = document.querySelector('.message-box__overlay');
var msgBoxButtonElement = document.querySelector('.message-body__button');
function ShowMsgBox(title, content, button, style = "success") {
	msgBoxElement.classList.add('show-box');

	msgBoxElement.querySelector('.message-body').classList = ['message-body'];

	msgBoxElement.querySelector('.message-body').classList.add(style);
	msgBoxElement.querySelector('.message-body__title').innerHTML = title;
	msgBoxElement.querySelector('.message-body__content').innerHTML = content;
	msgBoxElement.querySelector('.message-body__button').innerHTML = button;
}
msgBoxOverLayElement.onclick = function() {
	msgBoxElement.classList.remove('show-box');
}
msgBoxButtonElement.onclick = function() {
	msgBoxElement.classList.remove('show-box');
}
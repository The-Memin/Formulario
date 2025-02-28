jQuery(function ($) {
//beginning

const steps = document.querySelectorAll(".form-step");
let currentStep = 0;

// Cargar respuestas guardadas
loadAnswers();

document.querySelectorAll(".btn-next").forEach(button => {
	button.addEventListener("click", () => {
		if (isAnswerSelected()) {
			saveAnswers();
			showStep(currentStep + 1);
		} else {
			alert("Debes seleccionar una respuesta antes de continuar.");
		}
	});
});

function showStep(index) {
	if (index < steps.length) {
		steps[currentStep].classList.remove("is-active");
		steps[index].classList.add("is-active");
		currentStep = index;
		restoreAnswers();
	}
}

function saveAnswers() {
	const radios = document.querySelectorAll(".form-step.is-active input[type='radio']");
	radios.forEach(radio => {
		if (radio.checked) {
			localStorage.setItem(radio.name, radio.value);
		}
	});
}

function loadAnswers() {
	document.querySelectorAll("input[type='radio']").forEach(radio => {
		const savedValue = localStorage.getItem(radio.name);
		if (savedValue && radio.value === savedValue) {
			radio.checked = true;
		}
	});
}

function restoreAnswers() {
	const radios = document.querySelectorAll(".form-step.is-active input[type='radio']");
	radios.forEach(radio => {
		const savedValue = localStorage.getItem(radio.name);
		if (savedValue && radio.value === savedValue) {
			radio.checked = true;
		}
	});
}

function isAnswerSelected() {
	const radios = document.querySelectorAll(".form-step.is-active input[type='radio']");
	return Array.from(radios).some(radio => radio.checked);
}

//ending
});
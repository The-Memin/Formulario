jQuery(function ($) {
//beginning

	const formSteps = document.querySelectorAll(".form-step");
	const nextButtons = document.querySelectorAll(".btn-next");
	const prevButtons = document.querySelectorAll(".btn-prev");
	let currentStep = 0;

	function showStep(step) {
		formSteps.forEach((formStep, index) => {
			formStep.classList.toggle("is-active", index === step);
		});
	}

	nextButtons.forEach(button => {
		button.addEventListener("click", () => {
			if (currentStep < formSteps.length - 1) {
				currentStep++;
				showStep(currentStep);
			}
		});
	});

	prevButtons.forEach(button => {
		button.addEventListener("click", () => {
			if (currentStep > 0) {
				currentStep--;
				showStep(currentStep);
			}
		});
	});

	showStep(currentStep);

	

//ending
});
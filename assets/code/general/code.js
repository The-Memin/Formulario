jQuery(document).ready(function($) {

	const steps = document.querySelectorAll(".m-form-step");
	let currentStep = 0;


	$(".btn-next").off("click").on("click", function (e) {
		e.preventDefault();
		e.stopPropagation();
		if (isAnswerSelected()) {
			if (currentStep < steps.length - 1) { 
				showStep(currentStep + 1);
			}
		}
	});

	$(".btn-prev").off("click").on("click", function (e) {
		e.preventDefault();
		e.stopPropagation();
		if (currentStep > 0) {
			if (currentStep < steps.length ) { // Verifica que no sea el último paso
				showStep(currentStep - 1);
			}
		} 
	});
	
	function showStep(index) {
		if (index < steps.length) {
			$('.btn-next').removeClass('active');
			steps[currentStep].classList.remove("is-active");
			steps[index].classList.add("is-active");
			currentStep = index;
			if (isAnswerSelected()) {
				$('.btn-next').addClass('active');
			}
		}
	}
	function isAnswerSelected() {
		const radios = document.querySelectorAll(".m-form-step.is-active input[type='radio']");
		return Array.from(radios).some(radio => radio.checked);
	}

	$('.js-answer').change(function (e) { 
		if (isAnswerSelected()) {
			$('.btn-next').addClass('active');
			if (currentStep == steps.length-1) {
				$('.btn-finally').addClass('active');
			}
		}
	});

	$('#btn-finally').click(function (e) { 
		if (isAnswerSelected()) {
			const progressBar = document.querySelector(".progress-bar");
			progressBar.style.width = `100%`;
			$('#js-percent').html('100%');
            $('.m-form-step').removeClass('is-active');
			$("#email-section").addClass('is-active');
        } else {
            e.preventDefault(); // Prevent form submission if no answer is selected
        }
	});

	$('.btn-return').click(function (e) { 
		location.reload();
	});


	function updateProgressBar() {
		const progressBar = document.querySelector(".progress-bar");
		const totalSteps = document.querySelectorAll(".m-form-step").length;
		const progress = (currentStep  / totalSteps) * 100;
		$('#js-percent').html(`${progress.toFixed(1)}%`);
		progressBar.style.width = `${progress}%`;
	}
	
	// Llamar a la función en cada cambio de paso
	$(".btn-next, .btn-prev").click(function () {
		updateProgressBar();
	});
	
	// Llamar también al inicio para inicializar la barra
	updateProgressBar();
	

});

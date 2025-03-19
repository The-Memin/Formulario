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
	
	function obtenerPorcentajePorCategoria() {
		const seleccionados = {}; 
		const radios = document.querySelectorAll('#formulario input[type="radio"]:checked');
	
		radios.forEach(radio => {
			const name = radio.name; 
			const value = parseInt(radio.value); 
			const categoria = name.split('-')[2]; 
			if (!seleccionados[categoria]) {
				seleccionados[categoria] = [];
			}
			seleccionados[categoria].push(value);
		});
	
		const porcentajes = {};
		
		for (let categoria in seleccionados) {
			const respuestas = seleccionados[categoria];
			const sumaRespuestas = respuestas.reduce((a, b) => a + b, 0);
			const totalMaximo = respuestas.length * 5; 
			const porcentaje = (sumaRespuestas / totalMaximo) * 100;
			porcentajes[categoria] = porcentaje.toFixed(2); // Redondeamos a 2 decimales
		}
	
		return porcentajes;
	}
	function generarGraficaPorcentaje(categoria, porcentaje) {
		const ctx = document.getElementById(`canvas-${categoria}`).getContext('2d');  
	
		new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: [`${categoria} - ${porcentaje}%`], 
				datasets: [{
					label: categoria,
					data: [porcentaje, 100 - porcentaje], 
					backgroundColor: ['#116fc7', '#d7d7d7'], 
					borderColor: ['#d8d8d8', '#d8d8d8'],  
					borderWidth: 1,
				}]
			},
			options: {
				responsive: false,
				plugins: {
					tooltip: {
						callbacks: {
							label: function(tooltipItem) {
								return `${tooltipItem.raw}%`;
							}
						}
					},
					legend: {
						display: false 
					}
				}
			}
		});
	}
	function obtenerImagenesGraficas() {
		const imagenes = {};
	
		document.querySelectorAll("canvas").forEach(canvas => {
			const categoria = canvas.id.replace("canvas-", ""); // Extraer la categoría del ID
			imagenes[categoria] = canvas.toDataURL("image/png"); // Convertir a Base64
		});
	
		return imagenes;
	}
	function agregarImagenesAlFormulario() {
		const imagenes = obtenerImagenesGraficas();
		const form = document.getElementById("formulario");
	
		// Eliminar inputs ocultos previos
		document.querySelectorAll(".imagen-grafica").forEach(input => input.remove());
	
		// Crear nuevos inputs con las imágenes
		Object.keys(imagenes).forEach(categoria => {
			const input = document.createElement("input");
			input.type = "hidden";
			input.name = `imagen_${categoria}`; // Nombre dinámico
			input.value = imagenes[categoria];  // Base64
			input.classList.add("imagen-grafica");
	
			form.appendChild(input);
		});
	}
	
	// document.getElementById('formulario').addEventListener('submit', function(event) {
    //     event.preventDefault(); 
    //     const porcentajes = obtenerPorcentajePorCategoria();
    //     console.log(porcentajes);
	// 	for (let categoria in porcentajes) {
	// 		const porcentaje = porcentajes[categoria];
	// 		generarGraficaPorcentaje(categoria, porcentaje);
	// 	}
		
    // });
	

});

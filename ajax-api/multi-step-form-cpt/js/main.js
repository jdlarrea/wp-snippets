document.addEventListener('DOMContentLoaded', () => {
	const componentAssessmentForm = document.querySelector('.component-assessment-form');

	//Use on step 3 to select property type "Residential" or "Commercial"
	const squareChoice = document.querySelectorAll('label.square-choice');
	squareChoice.forEach(function(el) {
		el.addEventListener('click', function() {
			squareChoice.forEach(function(el) {
				el.classList.remove('selected');
			});
			el.classList.add('selected');
		});
	});

	if( componentAssessmentForm !== null ) {
		// **************************************************
		// **************************************************
		// ASSESSMENT INITIAL - Page Load Setup
		const resetPopupEl = componentAssessmentForm.querySelector('.reset-popup');

		initializeSliders();
		setupFormFields();
		// ... address autocomplete, input masking, comps grid, results and payment setup

		// Fancybox
		Fancybox.bind('[data-fancybox="gallery"]', {});

		// Current active page + progress bar step
		const assessmentStep = getAssessmentStep();
		componentAssessmentForm.querySelector('.page-' + assessmentStep).classList.add('active');

		for(let i=1; i <= assessmentStep; i++) {
			componentAssessmentForm.querySelector('.progress-step-' + i).classList.add('active');
		}

		// Back buttons - add click listeners
		const formBackButtons = document.querySelectorAll('.form-back');
		formBackButtons.forEach(function(el) {
			el.addEventListener('click', function() {
				moveStepBackward();
			});
		});

		// Back button for substeps - add click listeners
		const formBackSubButtons = document.querySelectorAll('.form-back-substep');
		formBackSubButtons.forEach(function(el) {
			el.addEventListener('click', function() {
				const step = this.dataset.step;
				moveSubstepBackward(step);
			});
		});

		// Reset buttons - add click listeners
		const btnResetAll = document.querySelectorAll('.btn-reset-all');
		btnResetAll.forEach(function(el) {
			el.addEventListener('click', function() {
				resetPopupEl.classList.remove('active');
				destroySession();
			});
		});

		// Reset cancel - add click listeners
		const resetCancelAll = document.querySelectorAll('.reset-cancel');
		resetCancelAll.forEach(function(el) {
			el.addEventListener('click', function() {
				resetPopupEl.classList.remove('active');
			});
		});

		// Popup triggers - add click listeners
		const popupTriggerAll = document.querySelectorAll('.trigger-popup');
		popupTriggerAll.forEach(function(el) {
			el.addEventListener('click', function() {
				resetPopupEl.classList.add('active');
			});
		});

		// Local Storage - set initial step (current or new) and substep
		localStorage.setItem('assessmentStep', assessmentStep);
		const assessmentSubstep = getAssessmentSubstep();
		localStorage.setItem('assessmentSubstep', assessmentSubstep);


		// **************************************************
		// **************************************************
		// ASSESSMENT STEP 1
		const formSubmit1 = document.querySelector('.form-submit-1');

		formSubmit1.addEventListener('click', function() {
			const formStep1 = document.getElementById('form-step-1');

			const step1Data = {
				last_step: 1,
				first_name: formStep1.elements.field_first_name.value,
				last_name: formStep1.elements.field_last_name.value,
				email: formStep1.elements.field_email.value
			}

			if( !( validateFields( step1Data ) ) ) {
				return;
			}
			else if( !( checkFieldChanges( step1Data ) ) ) {
				moveStepForward();
				return;
			}

			// Ajax, Local Storage, Progress
			sendAjaxRequestPost( 'create_assessment_1', step1Data );
			updateLocalAssessmentInfo( step1Data );
			moveStepForward();
		});


		// **************************************************
		// **************************************************
		// ASSESSMENT STEP 2
		const formSubmit2 = document.querySelector('.form-submit-2');

		formSubmit2.addEventListener('click', function() {
			const step2Data = {
				last_step: 2,
			}

			// Ajax, Local Storage, Progress
			sendAjaxRequestPost( 'modify_assessment_2', step2Data );
			updateLocalAssessmentInfo( step2Data );
			moveStepForward();
		});


		// **************************************************
		// **************************************************
		// ASSESSMENT STEP 3
		const formSubmit3 = document.querySelector('.form-submit-3');

		formSubmit3.addEventListener('click', function() {
			const formStep3 = document.getElementById('form-step-3');

			const step3Data = {
				last_step: 3,
				substep: formStep3.elements.substep.value,
				property_type: formStep3.elements.field_property_type.value,
			}

			const propertyType = step3Data.property_type.toLowerCase();

			if( !( validateFields( step3Data ) ) ) {
				return;
			}
			else if( !( checkFieldChanges( step3Data ) ) ) {
				moveSubstepForward(3, propertyType, 1);
				return;
			}

			// Ajax, Local Storage, Progress
			sendAjaxRequestPost( 'modify_assessment_3', step3Data );
			updateLocalAssessmentInfo( step3Data );
			moveSubstepForward(3, propertyType, 1);
		});


		// ... property details substeps, comps, results and payment
	}
});




// **************************************************
// **************************************************
// FUNCTIONS
// - checkFieldChanges
// - destroySession
// - getAssessmentInfo
// - getAssessmentStep
// - getAssessmentSubstep
// - getPostId
// - initializeSliders
// - moveStepBackward
// - moveStepForward
// - moveSubstepBackward
// - moveSubstepForward
// - sendAjaxRequestPost
// - setupFormFields
// - updateLocalAssessmentInfo
// - validateFields


// ******************************
// Function - diff check fields
function checkFieldChanges( fieldData ) {
	const assessmentInfo = getAssessmentInfo();

	for( key in fieldData ) {
		const fieldValue = fieldData[key];
		const currentValue = assessmentInfo[key];

		if( fieldValue != currentValue ) {
			return true;
		}
	}

	return false;
}

// ******************************
// Function - start over, destroy all local storage and session storage
function destroySession() {
	document.querySelectorAll('.component-assessment-form .page').forEach(page => {
		page.classList.remove('active');
	})
	// ... show the loading page

	localStorage.removeItem('assessmentInfo');
	localStorage.removeItem('assessmentId');
	localStorage.removeItem('assessmentStep');
	localStorage.removeItem('assessmentComps');
	localStorage.removeItem('assessmentResults');
	localStorage.removeItem('assessmentSubstep');
	//tbd maybe we still want to keep it
	//localStorage.removeItem('assessmentProperties');
	//localStorage.removeItem('assessmentRecentSales');

	// ... clear the server-side session, then send the user back to the start
}

// ******************************
// Function - Initialize swiperjs sliders
function initializeSliders() {
	const swiperStep2 = new Swiper('.swiper-step-2', {
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		}
	});
}

// ******************************
// Function - Decrement step counter
function moveStepBackward() {
	let assessmentStep = getAssessmentStep();
	let assessmentSubstep = getAssessmentSubstep();
	let assessmentInfo = getAssessmentInfo()
	const componentAssessmentForm = document.querySelector('.component-assessment-form');
	
	// Adjust classes for progress steps BEFORE step decrements
	componentAssessmentForm.querySelector('.progress-step-' + assessmentStep).classList.remove('active');

	// Decrement step
	assessmentInfo.last_step = --assessmentStep;

	// Adjust classes for pages
	componentAssessmentForm.querySelectorAll('.page').forEach(function(el) {
		el.classList.remove('active')
	});
	componentAssessmentForm.querySelector('.page-' + assessmentStep).classList.add('active');

	//if step 3 then check if .subpage.active is one subpage that has subpage.dataset.skipBackBtn == 1
	if(assessmentStep === 3 && assessmentInfo.property_type === 'residential') {
		componentAssessmentForm.querySelectorAll('.page-3 .subpage').forEach(function(el) {
			el.classList.remove('active')
		});
		const lastSubpage = componentAssessmentForm.querySelector('.page-3 .subpage-' + assessmentSubstep);
		if(lastSubpage && ((lastSubpage.dataset.skipBackBtn == 1) || (assessmentInfo.skip_assessment_value === true && lastSubpage.dataset.skipIfAssessment == 1))) {
			moveSubstepBackward(assessmentStep);
		} else {
			lastSubpage.classList.add('active');
		}
	}

	// Local Storage
	localStorage.setItem('assessmentStep', assessmentStep);
	localStorage.setItem('assessmentInfo', JSON.stringify(assessmentInfo));
}

// ******************************
// Function - Move substep backward
function moveSubstepBackward(assessmentStep) {
	let assessmentSubstep = getAssessmentSubstep();
	const componentAssessmentForm = document.querySelector('.component-assessment-form');

	assessmentSubstep--;
	let subpage = componentAssessmentForm.querySelector('.subpage-' + assessmentSubstep);

	const assessmentInfo = getAssessmentInfo();

	if(assessmentInfo && assessmentInfo.property_type === 'residential' && assessmentInfo.skip_assessment_value === true) {
		subpage = componentAssessmentForm.querySelector('.page-' + assessmentStep + ' .subpage-' + assessmentSubstep);
		if(subpage.dataset.skipIfAssessment === '1') {
			assessmentSubstep--;
		}
	}

	if(subpage && (subpage.dataset.skipBackBtn === '1')) {
		assessmentSubstep--;
	}

	componentAssessmentForm.querySelectorAll('.page-' + assessmentStep + ' .subpage').forEach(function(el) {
		el.classList.remove('active')
	});
	componentAssessmentForm.querySelector('.subpage-' + assessmentSubstep).classList.add('active');

	// Local Storage
	localStorage.setItem('assessmentSubstep', assessmentSubstep);
}

// ******************************
// Function - Increment step counter
function moveStepForward() {
	let assessmentStep = getAssessmentStep();
	const componentAssessmentForm = document.querySelector('.component-assessment-form');

	assessmentStep++;

	// Adjust classes for progress steps AFTER step increments
	componentAssessmentForm.querySelector('.progress-step-' + assessmentStep).classList.add('active');
	componentAssessmentForm.querySelectorAll('.progress-step').forEach(function(el) {
		el.classList.remove('partial-active')
	});

	// Adjust classes for pages
	componentAssessmentForm.querySelectorAll('.page').forEach(function(el) {
		el.classList.remove('active')
	});
	componentAssessmentForm.querySelector('.page-' + assessmentStep).classList.add('active');

	// Local Storage
	localStorage.setItem('assessmentStep', assessmentStep);
}

// ******************************
// Function - Move substep forward
function moveSubstepForward(assessmentStep, assessmentType, currentAssessmentSubstep) {
	const assessmentInfo = getAssessmentInfo();
	let assessmentSubstep = currentAssessmentSubstep + 1;
	const componentAssessmentForm = document.querySelector('.component-assessment-form');

	if(assessmentType === 'residential' && assessmentInfo && assessmentInfo.skip_assessment_value === true) {
		const subPage = componentAssessmentForm.querySelector('.page-' + assessmentStep + ' .subpage-' + assessmentSubstep);
		if(subPage.dataset.skipIfAssessment === '1') {
			assessmentSubstep++;
		}
	}

	localStorage.setItem('assessmentSubstep', assessmentSubstep)

	componentAssessmentForm.querySelectorAll('.page').forEach(function(el) {
		el.classList.remove('active')
	});
	componentAssessmentForm.querySelector('.page-' + assessmentStep).classList.add('active');

	//subpage
	componentAssessmentForm.querySelectorAll('.page-' + assessmentStep + ' .subpage').forEach(function(el) {
		el.classList.remove('active')
	});

	componentAssessmentForm.querySelector('.' +assessmentType + '.subpage-' + assessmentSubstep).classList.add('active');
}

// ******************************
// Function - ajax to WP / CPT
function sendAjaxRequestPost( action, data ) {
	const currentPostId = getPostId();
	const stepNumber = data.last_step;

	// Ajax - Prepare data
	const formData = new FormData();
	formData.append( 'action', action );
	formData.append( 'post_id', currentPostId );
	for(key in data) {
		formData.append( key, data[key] );
	}

	// Ajax - send request
	fetch(customScriptData.ajaxurl, {
		method: 'POST',
		body: formData,
	})
	.then(response => {
		if (response.ok) {
			return response.json();
		} else {
			throw new Error('Step '+ stepNumber +' failure: Invalid response (' + response.status, ')');
		}
	})
	.then(responseData => {
		const {data} = responseData;
		const statusCode = data.status;
		const postId = data.post_id;
		const message = data.message;

		if(statusCode === 200) { // CPT - create new
			localStorage.setItem('assessmentId', postId);
			console.log('Step '+ stepNumber +' success: Created new post (ID: ', postId, ')');
		}
		else if(statusCode === 201) { // CPT - modify existing
			console.log('Step '+ stepNumber +' success: Modified existing post (ID: ', postId, ')');
		}
		else { // CPT - Error
			console.log('Step '+ stepNumber +' failure '+ statusCode +': Error creating/modifying post (', message, ')');
		}
	})
	.catch(error => {
		console.log('Step '+ stepNumber +' catch error: ', error, '');
	});
}

// ******************************
// Function - Set Form fields on refresh or init
function setupFormFields() {
	const assessmentInfo = getAssessmentInfo();

	if( assessmentInfo ) {
		// Step 1 - re-populate
		const formStep1 = document.getElementById('form-step-1');
		formStep1.elements.field_first_name.value = assessmentInfo.first_name ?? '';
		formStep1.elements.field_last_name.value = assessmentInfo.last_name ?? '';
		formStep1.elements.field_email.value = assessmentInfo.email ?? '';

		// Step 3 - re-populate
		const formStep3 = document.getElementById('form-step-3');
		const propertyType = assessmentInfo.property_type ?? '';
		const propertyTypeRadio = formStep3.querySelector('input[name="field_property_type"][value="'+ propertyType +'"]');
		if(propertyTypeRadio) {
			propertyTypeRadio.checked = true;
			propertyTypeRadio.parentNode.classList.add('selected');
		}

		// ... property details substeps (residential and commercial)
	}
}

// ******************************
// Function - update local assessmentInfo data
function updateLocalAssessmentInfo( newData ) {
	let assessmentInfo = getAssessmentInfo();
	Object.assign( assessmentInfo, newData );
	localStorage.setItem('assessmentInfo', JSON.stringify(assessmentInfo));
}

// ******************************
// Function - validate fields for Main Assessment Form
function validateFields( fieldData, property = '' ) {
	let isFullyValid = true;
	let fieldErrors;

	const componentAssessmentForm = document.querySelector('.component-assessment-form');
	const isCommercial = fieldData['property_type'] == 'commercial' ? true : false;
	const curYear = new Date().getFullYear();

	const requiredFields = [
		'first_name',
		'last_name',
		'email',
		'property_address',
		'address',
		'property_type',
		'square_feet',
		'assessment_value',
		'sale_date',
		'sale_price',
		'year_built',
		'location_type',
		'land_value',
		'structure_type',
		'subdivision',
	]

	for(let key in fieldData) {
		if( !requiredFields.includes(key) ) {
			continue;
		}

		const fieldValue = fieldData[key];

		if( property == 'comp' ) {
			fieldErrors = componentAssessmentForm.querySelector('.form-group-comp_' + key + ' .errors');
		}
		else {
			fieldErrors = componentAssessmentForm.querySelector('.form-group-' + key + ' .errors');
		}

		// Reset
		fieldErrors.innerHTML = '';

		// Residential - some fields can be empty
		if( !isCommercial ) {
			if( key == 'land_value' ) {
				continue;
			}
		}

		if( fieldValue == '' ) {
			isFullyValid = false;
			fieldErrors.innerHTML += '<div class="error">- This field is required</div>';
		}

		switch(key) {
			// Step 1 fields
			case 'first_name':
				break;
			case 'last_name':
				break;
			case 'email':
				break;
			// Step 3 fields
			// Step 4 add comp fields
			case 'property_address':
			case 'address':
			case 'subdivision':
				break;
			case 'sale_date':
				const dateParts = fieldValue.split('/');
				const month = parseInt(dateParts[0], 10);
				const day = parseInt(dateParts[1], 10);
				const year = parseInt(dateParts[2], 10);

				if( month < 1 || month > 12 || day < 1 || day > 31 || year < 1800 || year > curYear ) {
					isFullyValid = false;
					fieldErrors.innerHTML += '<div class="error">- Please enter a valid date between mm/dd/1800 - mm/dd/'+ curYear +'</div>';
				}

				break;
			case 'year_built':
				const yearBuilt = parseInt(fieldValue);

				if( yearBuilt < 1850 || yearBuilt > curYear ) {
					isFullyValid = false;
					fieldErrors.innerHTML += '<div class="error">- Must be between 1850 - '+ curYear +'</div>';
				}

				break;
			default:
				break;
		}

		// Show errors
		fieldErrors.classList.add('active');
	}

	return isFullyValid;
}

function getAssessmentInfo() {
	return JSON.parse(localStorage.getItem('assessmentInfo')) ?? {};
}

function getPostId() {
	return localStorage.getItem('assessmentId') ?? null;
}

function getAssessmentStep() {
	return localStorage.getItem('assessmentStep') ?? 1;
}

function getAssessmentSubstep() {
	return localStorage.getItem('assessmentSubstep') ?? 1;

}

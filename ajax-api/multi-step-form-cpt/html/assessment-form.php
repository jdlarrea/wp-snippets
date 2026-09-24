<div class="component component-assessment-form">
	<div class="assessment-progress-bar status">
		<div class="progress-step progress-step-1 active">
			<div class="bar"></div>
			<div class="info">
				<div class="number">1</div>
				<div class="text">Get Started</div>
			</div>
		</div>
		<div class="progress-step progress-step-2">
			<div class="bar"></div>
			<div class="info">
				<div class="number">2</div>
				<div class="text">Preparation</div>
			</div>
		</div>
		<div class="progress-step progress-step-3">
			<div class="bar"></div>
			<div class="info">
				<div class="number">3</div>
				<div class="text">Home Details</div>
			</div>
		</div>
		<div class="progress-step progress-step-4">
			<div class="bar"></div>
			<div class="info">
				<div class="number">4</div>
				<div class="text">Add Comps</div>
			</div>
		</div>
		<div class="progress-step progress-step-5">
			<div class="bar"></div>
			<div class="info">
				<div class="number">5</div>
				<div class="text">Results</div>
			</div>
		</div>
		<div class="progress-step progress-step-6">
			<div class="bar"></div>
		</div>
	</div>

	<div class="reset-popup">
		<div class="content-top">
			<div class="text">Are you sure you want to restart the assessment?</div>
			<div class="button-group">
				<div class="btn btn-reset-all">Yes</div>
				<div class="btn reset-cancel secondary">No</div>
			</div>
		</div>
	</div>

	<div class="component-assessment-form-wrapper">
		<div class="page page-1">
			<div class="content-top">
				<img class="header-image" src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/step-1-logo.png" alt="Acme" />
				<h2 class="header">Assessment Tool</h2>
				<div class="text">Your customized assessment report will be emailed to the email address below.</div>
			</div>

			<form id="form-step-1" class="custom-form" action="#" method="post">
				<div class="form-group form-half form-group-first_name">
					<div class="errors"></div>
					<label class="visually-hidden" for="field_first_name">First Name</label>
					<input class="form-control" name="field_first_name" type="text" placeholder="First Name*" />
				</div>
				<div class="form-group form-half form-group-last_name">
					<div class="errors"></div>
					<label class="visually-hidden" for="field_last_name">Last Name</label>
					<input class="form-control" name="field_last_name" type="text" placeholder="Last Name" />
				</div>
				<div class="form-group form-group-email">
					<div class="errors"></div>
					<label class="visually-hidden" for="field_email">Email</label>
					<input class="form-control" name="field_email" type="text" placeholder="Email" />
				</div>

				<div class="button-group">
					<div class="btn form-submit form-submit-1">Get Started</div>
				</div>
			</form>
		</div>

		<div class="page page-2">
			<div class="content-top">
				<h2 class="header">Preparation</h2>
			</div>

			<div class="content-middle">
				<div class="content-body">
					<strong>What is needed to check my assessment?</strong>
					<ul>
						<li>Annual Assessment Notice (County Staff Contact information in notice)</li>
						<li>Neighborhood Sales</li>
					</ul>

					<strong>How to check my annual assessment?</strong>
					<ol>
						<li>Once you receive your assessment call your county staff contact, this information should be in the annual notice of assessment.</li>
						<li>Request the sales information used to determine your assessed value from the county staff contact.</li>
						<li>Input all sales information into our system</li>
					</ol>
				</div>

				<div class="slider-wrapper">
					<div class="slider-header">Annual Notice of Assessment Sample</div>
					<div class="swiper swiper-step-2">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/report-sample-residential.jpg" alt="Report Sample">
								<a href="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/report-sample-residential.jpg" class="slide-zoom" data-fancybox><img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/icon-expand.png" alt="expand image"></a>
							</div>
							<div class="swiper-slide">
								<img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/report-sample-commercial.jpg" alt="Report Sample">
								<a href="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/report-sample-commercial.jpg" class="slide-zoom" data-fancybox="swiperImages"><img src="<?php echo get_bloginfo( 'stylesheet_directory' ); ?>/assets/img/icon-expand.png" alt="expand image"></a>
							</div>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</div>

			<div class="content-bottom">
				<div id="form-step-2">
					<div class="button-group">
						<div class="btn form-back">Back</div>
						<div class="btn form-submit form-submit-2">Continue</div>
					</div>
				</div>

				<p class="reset-blurb">Want to restart the assessment? <span class="dark-link trigger-popup">Click here.</span></p>
			</div>
		</div>

        <div class="page page-3">
            <div class="subpage subpage-1 active">
                <div class="content-top">
                    <h2 class="header">WHAT TYPE OF PROPERTY?</h2>
                </div>

                <form id="form-step-3" class="custom-form" action="#" method="post">
                    <input type="hidden" name="substep" value="1">
                    <div class="form-group form-half form-group-property_type">
                        <div class="errors"></div>
                        <div class="button-container text-right">
                            <label class="square-choice">
                                <input type="radio" name="field_property_type" value="residential">
                                <span>Residential</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group form-half form-group-property_type">
                        <div class="errors"></div>
                        <div class="button-container text-left">
                            <label class="square-choice">
                                <input type="radio" name="field_property_type" value="commercial">
                                <span>Commercial</span>
                            </label>
                        </div>
                    </div>
                    <div class="button-group">
                        <div class="btn form-back">Back</div>
                        <div class="btn form-submit form-submit-3">Continue</div>
                    </div>
                </form>

                <div class="content-bottom">
                    <p class="reset-blurb">Want to restart the assessment? <span class="dark-link trigger-popup">Click here.</span></p>
                </div>
            </div>

            <!-- ... residential and commercial property substeps -->
        </div>

		<!-- ... pages 4-6: comps, results, payment -->
	</div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

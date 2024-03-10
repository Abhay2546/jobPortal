<script>
	document.title = 'Post New Job';
	$('body').removeClass('body-bg');
	$('body').addClass('body-bc');
	$('header').removeClass('shadow');


	$(document).ready(function() {
		$("#expires").datepicker({
			dateFormat: 'yy-mm-dd',
			minDate: 0
		});
		$('#post_job').submit(function() {
			$('#responsibilities').val("<ul class='bullets'><li>" + $.trim($('#responsibilities').val()).split('\n').join('</li><li>') + "</li></ul>");
			$('#skills').val("<ul class='bullets'><li>" + $.trim($('#skills').val()).split('\n').join('</li><li>') + "</li></ul>");
			$('#perks').val("<ul class='bullets'><li>" + $.trim($('#perks').val()).split('\n').join('</li><li>') + "</li></ul>");
		});

		$('#post_job').validate({
			rules: {
				title: {
					required: true,
					minlength: 4,
					maxlength: 80,
				},
				company: {
					required: true,
					minlength: 4,
					maxlength: 80,
				},
				location: {
					required: true,
				},
				description: {
					required: true,
				},
				responsibilities: {
					required: true,
				},
				skills: {
					required: true,
				},
				perks: {
					required: true,
				},
				salary_min: {
					required: true,
					lessThanEqual: '#salary_max',
				},
				salary_max: {
					required: true,
				},
				duration: {
					required: true,
				},
				contact_email: {
					required: true,
				},
				expires: {
					required: true,
				},
			},
			messages: {
				title: {
					required: "Enter job title.",
					minlength: "Title is too short.",
					maxlength: "Title is too long.",
				},
				company: {
					required: "Enter company name.",
					minlength: "Company name is too short.",
					maxlength: "Company name is too long.",
				},
				location: {
					required: "Select job location.",
				},
				description: {
					required: "Enter job description.",
				},
				responsibilities: {
					required: "Enter job responsibilities.",
				},
				skills: {
					required: "Enter skills required.",
				},
				perks: {
					required: "Enter benefits.",
				},
				salary_min: {
					required: "Enter salary.",
					lessThanEqual: "Validate min-max range.",
				},
				salary_max: {
					required: "Enter salary.",
				},
				duration: {
					required: "Select job duration type.",
				},
				contact_email: {
					required: "Please enter your company's email"
				},
				expires: {
					required: "Select job expiry date.",
				},
			},
		});

		$('#post_job').submit(function() {
			if (!$('#post_job').valid()) return false;
		});
		$('#submit_job').click(function() {
			if (!$('#post_job').valid()) return false;
		});
		$('#salary_min,#salary_max').keyup(function() {
			$('#salary_min').valid();
		});
	});
</script>
<style>
	.error {
		color: red;
	}
</style>
<section class="login-page">
	<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
		<div class="row" style='display:flex;justify-content:center'>
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
				<div class="panel rounded-0">
					<div class="panel-body rounded-0">
						<div class="form">
							<h2 class="text-center"><b><?php if ($this->uri->segment(2) == 'edit') {
															echo "Edit Job";
														} else {
															echo "Post New Job";
														} ?></b></h2>
							<hr>
							<form class="post_job" name="post_job" id="post_job" method='post' action='<?php echo base_url(); ?>post_job/submit'>
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											<div class="control-label font-weight-bold">Job Title:</div>
											<input type="text" name='title' id='title' class='form-control rounded-0' placeholder="Job Title" value="<?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>"), array("", "", "", ""), $edit->title)); ?><?php } ?>" />
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Company Name:</div>
											<input type="text" name='company' id='company' class='form-control rounded-0' placeholder="Company Name" value="<?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>"), array("", "", "", ""), $edit->company)); ?><?php } ?>" />
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Location:</div>
											<select name='location' id='location' class='form-control rounded-0'>
												<option value=''>Select Location</option>
												<?php foreach ($location as $key => $val) { ?>
													<option value='<?= $val ?>' <?php if ($this->uri->segment(2) == 'edit' && $edit->location == $val) { ?> selected<?php } ?>><?= $val ?></option>
												<?php } ?>
											</select>
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Job Description:</div>
											<textarea rows='6' name='description' id='description' class='form-control rounded-0' placeholder="Enter job's description"><?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>", "\n"), array("", "", "", "", "\n"), $edit->description)); ?><?php } ?></textarea>
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Responsibilities:</div>
											<textarea rows='6' name='responsibilities' id='responsibilities' class='form-control rounded-0' placeholder="Enter all the responsibilities for the job"><?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>", "\n"), array("", "", "", "", "\n"), $edit->responsibilities)); ?><?php } ?></textarea>
										</div>

									</div>
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
										<div class="form-group">
											<div class="control-label font-weight-bold">Skills Required:</div>
											<textarea rows='4' name='skills' id='skills' class='form-control rounded-0' placeholder="List out requirements for the job"><?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>", "\n"), array("", "", "", "", "\n"), $edit->skills)); ?><?php } ?></textarea>
										</div>
										<div class="form-group">
											<div class="control-label font-weight-bold">Benefits:</div>
											<textarea rows='4' name='perks' id='perks' class='form-control rounded-0' placeholder="Add benefits of working with the company/job"><?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>", "\n"), array("", "", "", "", "\n"), $edit->perks)); ?><?php } ?></textarea>
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Salary (per annum):</div>
											<div class='col-sm-6' style='padding: 0;padding-right: 10px'><input type="number" name='salary_min' id='salary_min' class='form-control rounded-0' placeholder="Minimum" value="<?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>"), array("", "", "", ""), $edit->salary_min)); ?><?php } ?>" /></div>
											<div class='col-sm-6' style='padding: 0;padding-left: 10px'><input type="number" name='salary_max' id='salary_max' class='form-control rounded-0' placeholder="Max" value="<?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>"), array("", "", "", ""), $edit->salary_max)); ?><?php } ?>" /></div>
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Job Duration:</div>
											<select name='duration' id='duration' class='form-control rounded-0'>
												<option value='Full time' <?php if ($this->uri->segment(2) == 'edit' && $edit->duration == 'Full time') { ?> selected<?php } ?>>Full time</option>
												<option value='Part time' <?php if ($this->uri->segment(2) == 'edit' && $edit->duration == 'Part time') { ?> selected<?php } ?>>Part time</option>
											</select>
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Contact Email:</div>
											<input type="email" name='contact_email' id='contact_email' class='form-control rounded-0' placeholder="Enter company's email" value="<?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>"), array("", "", "", ""), $edit->contact_email)); ?><?php } ?>" />
										</div>

										<div class="form-group">
											<div class="control-label font-weight-bold">Expiry Date</div>
											<input type="text" name='expires' id='expires' class='datepicker form-control rounded-0' placeholder="Expiry Date for Vacancy" value="<?php if ($this->uri->segment(2) == 'edit') { ?><?php echo strip_tags(str_replace(array("<ul class='bullets'>", "</ul>", "<li>", "</li>"), array("", "", "", ""), $edit->expires)); ?><?php } ?>" />
										</div>
									</div>
								</div>



								<div class="text-center">
									<?php if ($this->uri->segment(2) == 'edit') { ?>
										<input type='hidden' name='form_type' value='edit'>
										<input type="hidden" name="job_id" value="<?= $this->uri->segment(3) ?>">
										<button id='register' class="btn btn-lg btn-block btn-primary rounded-0">SAVE CHANGES</button>
									<?php } else { ?>
										<input type='hidden' name='form_type' value='submit'>
										<button type='submit' id='submit_job' class="btn btn-lg btn-block btn-primary rounded-0">POST JOB VACANCY</button>
									<?php } ?>
									<input type='hidden' name='form' value='1'>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
		<div class="col-xs-0 col-sm-2 col-md-3 col-lg-3"></div>
	</div>


</section>
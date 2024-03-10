<?php
class Post_job extends CI_Controller 
{
	function __Construct()
	{
		parent:: __construct();
		$this->load->model('job_model');
	}
	
	function index()
	{
		if(!$this->session->userdata('user'))
		{
			$this->session->set_userdata('login_status','login_needed');
			$this->session->set_userdata('redirectTo','post_job');
			redirect('login');
		}
		else
		{
			$data['tab'] = 'POST JOB';
			$data['location'] = array('Ahmedabad', 'Bengaluru', 'Baroda', 'Bhubaneswar', 'Chennai', 'Coimbatore', 'DeVaranasilhi', 'Gandhinagar', 'Goa', 'Gurugram', 'Guwahati', 'Hyderabad', 'Bhopal', 'Indore', 'Jamshedpur', 'Kalyan', 'Thane', 'Kochi', 'Kolkata', 'Lucknow', 'New Delhi', 'Mumbai', 'Nagpur', 'Noida', 'Nashik', 'Patna', 'Pune', 'Thiruvananthapuram', 'Varanasi');
			sort($data['location']);
			
			$this->load->view('header',$data);
			$this->load->view('post_job',$data);
		}	
	}
	
	/*Post new job & edit existing job*/
	function submit()
	{
		date_default_timezone_set("Asia/Kolkata"); 
		if(isset($_POST['form']))
		{	
			$data = array(
			'title' => $this->security->xss_clean($_POST['title']),
			'company' => $this->security->xss_clean($_POST['company']),
			'location' => $this->security->xss_clean($_POST['location']),
			'description' => $this->security->xss_clean($_POST['description']),
			'responsibilities' => $this->security->xss_clean($_POST['responsibilities']),
			'skills' => $this->security->xss_clean($_POST['skills']),
			'perks' => $this->security->xss_clean($_POST['perks']),
			'salary_min' => $this->security->xss_clean($_POST['salary_min']),
			'salary_max' => $this->security->xss_clean($_POST['salary_max']),
			'duration' => $this->security->xss_clean($_POST['duration']),
			'contact_email' => $this->security->xss_clean($_POST['contact_email']),
			'expires' => $this->security->xss_clean($_POST['expires']),
			'created_by' => $this->session->userdata('user')->user_id,
			'deleted' => 'no',
			'date_created' => date('Y-m-d H:i:s')
			);
			
			if($_POST['form_type']=='submit')
			{
				$id = $this->job_model->post_job($data);
				if(!$id){
					$this->session->set_flashdata('success','Posting Job failed.');
					redirect(base_url());
				}else{
					$this->session->set_flashdata('success','Job has been added successfully.');
					redirect('jobs/view/'.$id);
				}
			}			
			else if($_POST['form_type']=='edit')
			{
				unset($data['date_created']);
				$data['date_modified'] = date('Y-m-d H:i:s');
				$job_id = $_POST['job_id'];
				$id = $this->job_model->update_job($data,$job_id);
				if(!$id){
					$this->session->set_flashdata('success','Updating Job Post failed.');
					redirect(base_url());
				}else{
					$this->session->set_flashdata('success','Job has been updated successfully.');
					redirect('jobs/view/'.$job_id);
				}
			}
			
		}
		else
			redirect(base_url());
		}
}
?>
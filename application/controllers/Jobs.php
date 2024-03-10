<?php
class Jobs extends CI_Controller
{
	function __Construct()
	{
		parent::__construct();
		$this->load->model('job_model');
	}

	function index()
	{
		$data = $this->job_model->get_salary_range();
		$data['location'] = array('Ahmedabad', 'Bengaluru', 'Baroda', 'Bhubaneswar', 'Chennai', 'Coimbatore', 'DeVaranasilhi', 'Gandhinagar', 'Goa', 'Gurugram', 'Guwahati', 'Hyderabad', 'Bhopal', 'Indore', 'Jamshedpur', 'Kalyan', 'Thane', 'Kochi', 'Kolkata', 'Lucknow', 'New Delhi', 'Mumbai', 'Nagpur', 'Noida', 'Nashik', 'Patna', 'Pune', 'Thiruvananthapuram', 'Varanasi');
		sort($data['location']);
		$data['tab'] = 'FIND JOBS';
		$data['search'] = isset($_GET['search']) ? $_GET['search'] : '';
		$this->load->view('header', $data);
		$this->load->view('jobs', $data);
	}

	/*Search & filter*/
	function filter_result()
	{
		if (isset($_POST['ajax'])) {
			parse_str($_POST['str'], $str);
			if (isset($str['city']))	$data['city'] = $str['city'];
			$data['salary_min'] = $str['salary_min'];
			$data['salary_max'] = $str['salary_max'];
			$data['search'] = $_POST['search'];
			$res = $this->job_model->filter_result($data);
			// $res['last_qry'] = $this->db->last_query();
			echo json_encode($res);
		} else
			redirect(base_url());
	}

	/*View single job- full screen*/
	function view()
	{
		if ($this->uri->segment(3)) {
			$job_id = $this->uri->segment(3);
			$data = $this->job_model->get_job($job_id);
			$data = (array) $data;
			$data['tab'] = 'SINGLE JOB';
			$this->load->view('header', $data);
			$this->load->view('single_job', $data);
		} else
			redirect('jobs');
	}

	/*Open job form in edit mode*/
	function edit()
	{
		$data['tab'] = 'EDIT';
		if ($this->session->userdata('user') && $this->uri->segment(3) && $this->job_model->validate_author($this->uri->segment(3))) {
			$data['edit'] = $this->job_model->get_job($this->uri->segment(3));
			$data['location'] = array('Ahmedabad', 'Bengaluru', 'Baroda', 'Bhubaneswar', 'Chennai', 'Coimbatore', 'DeVaranasilhi', 'Gandhinagar', 'Goa', 'Gurugram', 'Guwahati', 'Hyderabad', 'Bhopal', 'Indore', 'Jamshedpur', 'Kalyan', 'Thane', 'Kochi', 'Kolkata', 'Lucknow', 'New Delhi', 'Mumbai', 'Nagpur', 'Noida', 'Nashik', 'Patna', 'Pune', 'Thiruvananthapuram', 'Varanasi');
			sort($data['location']);
			$this->load->view('header', $data);
			$this->load->view('post_job', $data);
		} else
			redirect(base_url());
	}

	/*Delete job*/
	function delete()
	{
		$id = $_POST['id'];
		if ($this->job_model->delete($id))
			$r = true;
		else
			$r = false;
		echo json_encode($r);
	}
}

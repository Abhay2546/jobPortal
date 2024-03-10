<?php
class Job_model extends CI_Model
{
    /*soft delete expired jobs*/
    function __construct()
    {
        date_default_timezone_set("Asia/Kolkata");
        $data = $this->db->select('job_id')->from('jobs')->where('deleted', 'no')->where('expires <=', date('Y-m-d'))->get()->result();
        if ($data) {
            $expired = array();
            foreach ($data as $d) array_push($expired, array('job_id' => $d->job_id, 'deleted' => 'yes'));
            $this->db->update_batch('jobs', $expired, 'job_id');
        }
    }

    function post_job($data)
    {
        $this->db->insert('jobs', $data);
        return $this->db->insert_id();
    }

    function update_job($data, $job_id)
    {
        $this->db->where('job_id', $job_id);
        return $this->db->update('jobs', $data);
    }

    function get_job($job_id)
    {
        return $this->db->select('jobs.*,users.name')->from('jobs')->join('users', 'users.user_id=jobs.created_by')->where('jobs.job_id', $job_id)->where('jobs.deleted', 'no')->get()->row();
    }

    function delete($id)
    {
        $data['deleted'] = 'yes';
        $where['job_id'] = $id;
        $this->db->where($where);
        return $this->db->update('jobs', $data);
    }

    function validate_author($id)
    {
        $where = array('deleted' => 'no', 'job_id' => $id, 'created_by' => $this->session->userdata('user')->user_id);
        return $this->db->from('jobs')->where('deleted', 'no')->where($where)->get()->num_rows();
    }

    function get_salary_range()
    {
        $data['salary_min'] = 0;
        $data['salary_max'] = 0;
        
        $salary_min_query = $this->db->select_min('salary_min')->from('jobs')->where('deleted', 'no')->get()->row();
        $salary_max_query = $this->db->select_max('salary_max')->from('jobs')->where('deleted', 'no')->get()->row();

        if ($salary_min_query) {
            $data['salary_min'] = $salary_min_query->salary_min;
        }

        if ($salary_max_query) {
            $data['salary_max'] = $salary_max_query->salary_max;
        }

        return $data;
    }

    function filter_result($data)
    {
        $this->db->select('*');
        $this->db->from('jobs');
        $this->db->where('deleted', 'no');
        $this->db->where("((`salary_min` BETWEEN {$data['salary_min']} and {$data['salary_max']}) or (`salary_max` BETWEEN {$data['salary_min']} and {$data['salary_max']}))");

        if (!empty($data['search'])) {
            $this->db->like('title', $data['search']);
            $this->db->or_like('company', $data['search']);
            $this->db->or_like('description', $data['search']);
            $this->db->or_like('responsibilities', $data['search']);
            $this->db->or_like('skills', $data['search']);
            $this->db->or_like('duration', $data['search']);
        }

        if (isset($data['city'])) {
            $this->db->where_in('location', $data["city"]);
        }

        $this->db->order_by('date_created', 'desc');
        return $this->db->get()->result();
    }
}

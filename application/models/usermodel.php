<?php

Class Usermodel extends CI_Model {
    #Authenticates the administrator account

    public function Login($username, $password) {
        $result = $this->db->query("SELECT * FROM personal_details WHERE pd_username='" . $username . "' AND pd_password='" . $password . "'");
        return $result->num_rows() == 1;
    }

    public function GetId($username) {
        $query = $this->db->query("SELECT personal_details_id FROM personal_details WHERE pd_username='" . $username . "'");
        return $query->row()->uid;
    }

}

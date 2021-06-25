<?php
    class Agent_model extends CI_model {
        public function verifyContactAccount($username) {
            $this->db->set('is_active', 1);
            $this->db->where('username', $username);
            $this->db->update('contacts');
            $this->db->delete('user_token', ['username' => $username]);
        }
        
        public function getAllSubjects() {
            $this->db->order_by('subject', 'ASC');
            return $this->db->get('subjects')->result_array();  
        }

        public function addSubject() {
            $subject = $this->input->post('subject');
            $this->db->where('subject', $subject);
            $similar = $this->db->get('subjects')->row_array();
            if ($similar == 0) {   
                $data = ['subject' => $this->input->post('subject')];
                $this->db->insert('subjects', $data);
            }
        }
        
        public function getAllTickets() {
            $this->db->where('status', 'Open');
            return $this->db->get('tickets')->result_array();
        }

        public function getAllTicketsStaff() {
            $this->db->where('agent_name', $this->session->userdata('name'));
            $this->db->where('status', 'Open');
            return $this->db->get('tickets')->result_array();
        }

        public function getAllTicketsForClient() {
            $this->db->where('contact_name', $this->session->userdata('name'));
            $this->db->where('company_brand', $this->session->userdata('company_brand'));
            $this->db->where('status', 'Open');
            return $this->db->get('tickets')->result_array();
        }

        public function getTicketById($id) {
            return $this->db->get_where('tickets', ['id' => $id])->row_array();
        }

        public function searchTickets() {
            $searchticket = $this->input->post('searchticket');
            $this->db->like('contact_name', $searchticket);
            $this->db->or_like('company_brand', $searchticket);
            $this->db->or_like('type', $searchticket);
            $this->db->or_like('module', $searchticket);
            $this->db->or_like('subject', $searchticket);
            $this->db->or_like('description', $searchticket);
            $this->db->or_like('priority', $searchticket);
            $this->db->or_like('agent_name', $searchticket);
            $this->db->or_like('status', $searchticket);
            $this->db->or_like('note', $searchticket);
            return $this->db->get('tickets')->result_array();
        }

        public function searchTicketsStaff() {
            $searchticket = $this->input->post('searchticket');
            $this->db->like('contact_name', $searchticket);
            $this->db->or_like('company_brand', $searchticket);
            $this->db->or_like('type', $searchticket);
            $this->db->or_like('module', $searchticket);
            $this->db->or_like('subject', $searchticket);
            $this->db->or_like('description', $searchticket);
            $this->db->or_like('priority', $searchticket);
            $this->db->or_like('status', $searchticket);
            $this->db->or_like('note', $searchticket);
            $this->db->where('agent_name', $this->session->userdata('name'));
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByPeriod() {
            $from = $this->input->post('from');
            $until = $this->input->post('until');
            $this->db->where('date(date_created) >=', $from);
            $this->db->where('date(date_created) <=', $until);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByPeriodStaff() {
            $from = $this->input->post('from');
            $until = $this->input->post('until');
            $this->db->where('agent_name', $this->session->userdata('name'));
            $this->db->where('date(date_created) >=', $from);
            $this->db->where('date(date_created) <=', $until);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByPeriodClient() {
            $from = $this->input->post('from');
            $until = $this->input->post('until');
            $this->db->where('contact_name', $this->session->userdata('name'));
            $this->db->where('company_brand', $this->session->userdata('company_brand'));
            $this->db->where('date(date_created) >=', $from);
            $this->db->where('date(date_created) <=', $until);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByCompany() {
            $companybrand = $this->input->post('company_brand');
            $this->db->where('company_brand', $companybrand);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByCompanyStaff() {
            $companybrand = $this->input->post('company_brand');
            $this->db->where('company_brand', $companybrand);
            $this->db->where('agent_name', $this->session->userdata('name'));
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByType() {
            $type = $this->input->post('type');
            $this->db->where('type', $type);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByTypeStaff() {
            $type = $this->input->post('type');
            $this->db->where('type', $type);
            $this->db->where('agent_name', $this->session->userdata('name'));
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByTypeClient() {
            $type = $this->input->post('type');
            $this->db->where('contact_name', $this->session->userdata('name'));
            $this->db->where('company_brand', $this->session->userdata('company_brand'));
            $this->db->where('type', $type);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByAssignee() {
            $agentname = $this->input->post('agent_name');
            $this->db->where('agent_name', $agentname);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByAssigneeClient() {
            $agentname = $this->input->post('agent_name');
            $this->db->where('contact_name', $this->session->userdata('name'));
            $this->db->where('company_brand', $this->session->userdata('company_brand'));
            $this->db->where('agent_name', $agentname);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByStatus() {
            $status = $this->input->post('status');
            $this->db->where('status', $status);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByStatusStaff() {
            $status = $this->input->post('status');
            $this->db->where('agent_name', $this->session->userdata('name'));
            $this->db->where('status', $status);
            return $this->db->get('tickets')->result_array();
        }

        public function ticketsByStatusClient() {
            $status = $this->input->post('status');
            $this->db->where('contact_name', $this->session->userdata('name'));
            $this->db->where('company_brand', $this->session->userdata('company_brand'));
            $this->db->where('status', $status);
            return $this->db->get('tickets')->result_array();
        }

        public function createNewTicketAgent() {
            date_default_timezone_set('Asia/Jakarta');
            if ($this->input->post('status') == 'In Progress') {
                $start_time = date('Y-m-d H:i:s');
            }
            if ($this->input->post('status') == 'Resolved') {
                $finish_time = date('Y-m-d H:i:s');
            }
            $data = [
                'date_created' => date('Y-m-d H:i:s'),
                'created_by' => $this->input->post('created_by'),
                'contact_name' => $this->input->post('contact_name'),
                'company_brand' => $this->input->post('company_brand'),
                'contact_email' => $this->input->post('contact_email'),
                'contact_image' => $this->input->post('contact_image'),
                'type' => $this->input->post('type'),
                'module' => $this->input->post('module'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'priority' => $this->input->post('priority'),
                'agent_name' => $this->input->post('agent_name'),
                'start_time' => $start_time,
                'finish_time' => $finish_time,
                'status' => $this->input->post('status'),
                'note' => $this->input->post('note')
            ];
            $this->db->insert('tickets', $data);
            if ($this->input->post('agent_name') == 'Edu Ramdhana Putra') {
                $this->sendEmailNotificationAgent1();
            } elseif ($this->input->post('agent_name') == 'Tri Untung Sutriyanto') {
                $this->sendEmailNotificationAgent2();
            }
            if ($this->input->post('status') == 'Resolved') {
                $this->sendEmailNotificationClient();
            }
        }

        public function createNewTicketStaff() {
            date_default_timezone_set('Asia/Jakarta');
            if ($this->input->post('status') == 'In Progress') {
                $start_time = date('Y-m-d H:i:s');
            }
            if ($this->input->post('status') == 'Resolved') {
                $finish_time = date('Y-m-d H:i:s');
            }
            $data = [
                'date_created' => date('Y-m-d H:i:s'),
                'created_by' => $this->input->post('created_by'),
                'contact_name' => $this->input->post('contact_name'),
                'company_brand' => $this->input->post('company_brand'),
                'contact_email' => $this->input->post('contact_email'),
                'contact_image' => $this->input->post('contact_image'),
                'type' => $this->input->post('type'),
                'module' => $this->input->post('module'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'priority' => $this->input->post('priority'),
                'agent_name' => $this->input->post('agent_name'),
                'start_time' => $start_time,
                'finish_time' => $finish_time,
                'status' => $this->input->post('status'),
                'note' => $this->input->post('note')
            ];
            $this->db->insert('tickets', $data);
            if ($this->input->post('status') == 'Resolved') {
                $this->sendEmailNotificationClient();
            }
        }

        public function createNewTicket() {
            date_default_timezone_set('Asia/Jakarta');
            $data = [
                'date_created' => date('Y-m-d H:i:s'),
                'created_by' => $this->input->post('created_by'),
                'contact_name' => $this->input->post('contact_name'),
                'company_brand' => $this->input->post('company_brand'),
                'contact_email' => $this->input->post('contact_email'),
                'contact_image' => $this->input->post('contact_image'),
                'type' => $this->input->post('type'),
                'module' => $this->input->post('module'),
                'subject' => $this->input->post('subject'),
                'description' => $this->input->post('description'),
                'priority' => $this->input->post('priority'),
                'agent_name' => $this->input->post('agent_name'),
                'status' => $this->input->post('status')
            ];
            $this->db->insert('tickets', $data);
            $this->sendEmailNotificationAgent();
        }

        public function updateTicketAgent() {
            date_default_timezone_set('Asia/Jakarta');
            $this->db->set('contact_name', $this->input->post('contact_name', true));
            $this->db->set('company_brand', $this->input->post('company_brand', true));
            $this->db->set('contact_email', $this->input->post('contact_email', true));
            $this->db->set('contact_image', $this->input->post('contact_image', true));
            $this->db->set('type', $this->input->post('type', true));
            $this->db->set('module', $this->input->post('module', true));
            $this->db->set('subject', $this->input->post('subject', true));
            $this->db->set('description', $this->input->post('description', true));
            $this->db->set('priority', $this->input->post('priority', true));
            $this->db->set('agent_name', $this->input->post('agent_name', true));
            if ($this->input->post('status') == 'In Progress') {
                $this->db->set('start_time', date('Y-m-d H:i:s'));
            }
            if ($this->input->post('status') == 'Resolved') {
                $this->db->set('finish_time', date('Y-m-d H:i:s'));
            }
            $this->db->set('status', $this->input->post('status', true));
            $this->db->set('note', $this->input->post('note', true));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tickets');
            if ($this->input->post('agent_name') == 'Edu Ramdhana Putra') {
                $this->sendEmailNotificationAgent1();
            } elseif ($this->input->post('agent_name') == 'Tri Untung Sutriyanto') {
                $this->sendEmailNotificationAgent2();
            }
            if ($this->input->post('status') == 'Resolved') {
                $this->sendEmailNotificationClient();
            }
        }

        public function updateTicketStaff() {
            date_default_timezone_set('Asia/Jakarta');
            $this->db->set('contact_name', $this->input->post('contact_name', true));
            $this->db->set('company_brand', $this->input->post('company_brand', true));
            $this->db->set('contact_email', $this->input->post('contact_email', true));
            $this->db->set('contact_image', $this->input->post('contact_image', true));
            $this->db->set('type', $this->input->post('type', true));
            $this->db->set('module', $this->input->post('module', true));
            $this->db->set('subject', $this->input->post('subject', true));
            $this->db->set('description', $this->input->post('description', true));
            $this->db->set('priority', $this->input->post('priority', true));
            $this->db->set('agent_name', $this->input->post('agent_name', true));
            if ($this->input->post('status') == 'In Progress') {
                $this->db->set('start_time', date('Y-m-d H:i:s'));
            }
            if ($this->input->post('status') == 'Resolved') {
                $this->db->set('finish_time', date('Y-m-d H:i:s'));
            }
            $this->db->set('status', $this->input->post('status', true));
            $this->db->set('note', $this->input->post('note', true));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tickets');
            if ($this->input->post('status') == 'Resolved') {
                $this->sendEmailNotificationClient();
            }
        }

        public function updateTicket() {
            $this->db->set('type', $this->input->post('type', true));
            $this->db->set('module', $this->input->post('module', true));
            $this->db->set('subject', $this->input->post('subject', true));
            $this->db->set('description', $this->input->post('description', true));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('tickets');
        }

        public function deleteTicket($id) {
            $this->db->delete('tickets', ['id' => $id]);
        }

        private function sendEmailNotificationAgent() {
            $config = [
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'd.herdiawan.s@gmail.com',
                'smtp_pass' => 'h3r@w4t!',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            
            $this->email->initialize($config);
            $this->email->from('d.herdiawan.s@gmail.com', 'PT. Ava Revota');
            $this->email->to('herdiawand@yahoo.co.id');
            $this->email->subject('Notifikasi Permintaan Bantuan');
            $this->email->message('
                Ada seorang pelanggan telah membuat permintaan bantuan baru! Ayo dicek!<br>
                <a href="'. base_url() .'">
                Buka portal
                </a>
            ');
            
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }

        private function sendEmailNotificationAgent1() {
            $config = [
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'd.herdiawan.s@gmail.com',
                'smtp_pass' => 'h3r@w4t!',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            
            $this->email->initialize($config);
            $this->email->from('d.herdiawan.s@gmail.com', 'PT. Ava Revota');
            $this->email->to('eduramdhanaputra@yahoo.com');
            $this->email->subject('Notifikasi Permintaan Bantuan');
            $this->email->message('
                Ada seorang pelanggan telah membuat permintaan bantuan baru! Ayo dicek!<br>
                <a href="'. base_url() .'">
                Buka portal
                </a>
            ');
            
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }

        private function sendEmailNotificationAgent2() {
            $config = [
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'd.herdiawan.s@gmail.com',
                'smtp_pass' => 'h3r@w4t!',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            
            $this->email->initialize($config);
            $this->email->from('d.herdiawan.s@gmail.com', 'PT. Ava Revota');
            $this->email->to('triuntungsutriyanto@yahoo.com');
            $this->email->subject('Notifikasi Permintaan Bantuan');
            $this->email->message('
                Ada seorang pelanggan telah membuat permintaan bantuan baru! Ayo dicek!<br>
                <a href="'. base_url() .'">
                Buka portal
                </a>
            ');
            
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }

        private function sendEmailNotificationClient() {
            $config = [
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'd.herdiawan.s@gmail.com',
                'smtp_pass' => 'h3r@w4t!',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            
            $this->email->initialize($config);
            $this->email->from('d.herdiawan.s@gmail.com', 'PT. Ava Revota');
            $this->email->to($this->input->post('contact_email'));
            $this->email->subject('Notifikasi Permintaan Bantuan');
            $this->email->message('
                Permintaan bantuan anda sudah selesai dikerjakan, silakan periksa kembali.<br>
                Terima kasih telah menggunakan Revota.<br>
                <a href="'. base_url() .'">
                Buka portal
                </a>
            ');
            
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
        
        public function searchContact() {
            $searchcontact = $this->input->post('searchcontact');
            $this->db->like('name', $searchcontact);
            $this->db->or_like('company_brand', $searchcontact);
            $this->db->or_like('branch_address', $searchcontact);
            $this->db->or_like('branch_city', $searchcontact);
            $this->db->or_like('phone', $searchcontact);
            $this->db->or_like('email', $searchcontact);
            $this->db->or_like('username', $searchcontact);
            $this->db->or_like('note', $searchcontact);
            return $this->db->get('contacts')->result_array();
        }

        public function searchContactByCompany($company_brand) {
            $searchcompanycontact = $this->input->post('searchcompanycontact');
            $this->db->like('name', $searchcompanycontact);
            $this->db->or_like('branch_address', $searchcompanycontact);
            $this->db->or_like('branch_city', $searchcompanycontact);
            $this->db->or_like('phone', $searchcompanycontact);
            $this->db->or_like('email', $searchcompanycontact);
            $this->db->or_like('username', $searchcompanycontact);
            $this->db->or_like('note', $searchcompanycontact);
            $this->db->where('company_brand', $company_brand);
            return $this->db->get('contacts')->result_array();
        }
        
        public function getAllContacts() {
            $this->db->order_by('name', 'ASC');
            return $this->db->get('contacts')->result_array();
        }

        public function getAllActiveContacts() {
            $this->db->order_by('name', 'ASC');
            $this->db->where('is_active', 1);
            return $this->db->get('contacts')->result_array();
        }

        public function getContactsByCompany($company_brand) {
            $this->db->where('company_brand', str_replace('%20', ' ', $company_brand));
            return $this->db->get('contacts')->result_array();
        }
        
        public function getContactById($id) {
            return $this->db->get_where('contacts', ['id' => $id])->row_array();
        }
        
        public function getContactByEmail($email) {
            return $this->db->get_where('contacts', ['email' => $email])->row_array();
        }

        public function getContactByUsername($username) {
            return $this->db->get_where('contacts', ['username' => $username])->row_array();
        }
        
        public function addNewContact() {
            $email = $this->input->post('email', true);
            $username = $this->input->post('username', true);
            $data = [
                'name' => $this->input->post('name', true),
                'company_id' => $this->input->post('company_id', true),
                'company_brand' => $this->input->post('company_brand', true),
                'branch_address' => $this->input->post('branch_address', true),
                'branch_city' => $this->input->post('branch_city', true),
                'phone' => $this->input->post('phone', true),
                'email' => $email,
                'username' => $username,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'note' => $this->input->post('note', true),
                'image' => $this->input->post('image', true),
                'role_id' => 3,
                'is_active' => 0
            ];

            $token = base64_encode(openssl_random_pseudo_bytes(32));
            $user_token = [
                'email' => $email,
                'username' => $username,
                'token' => $token
            ];  
            
            $this->db->insert('contacts', $data);
            $this->db->insert('user_token', $user_token);
            
            $this->sendEmailVerifyContact($token);
        }
        
        private function sendEmailVerifyContact($token) {
            $config = [
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'd.herdiawan.s@gmail.com',
                'smtp_pass' => 'h3r@w4t!',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            
            $this->email->initialize($config);
            $this->email->from('d.herdiawan.s@gmail.com', 'PT. Ava Revota');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Verifikasi Akun');
            $this->email->message('
                Terima kasih telah menggunakan Revota.<br>
                Silakan klik tautan di bawah ini untuk mengaktifkan akun bantuan pelanggan anda dengan username dan password berikut.<br>
                Username: ' . $this->input->post('username') . '<br>
                Password: ' . $this->input->post('password') . '<br>
                Mohon segera perbarui username dan password anda setelah berhasil melakukan login pertama.<br>
                <a href="'. base_url() . 'auth/verify?username=' . $this->input->post('username') . '&token=' . urlencode($token) .'">
                Aktifkan akun
                </a>
            ');
            
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
        
        public function updateContact() {
            $this->db->set('name', $this->input->post('name', true));
            $this->db->set('branch_address', $this->input->post('branch_address', true));
            $this->db->set('branch_city', $this->input->post('branch_city', true));
            $this->db->set('phone', $this->input->post('phone', true));
            $this->db->set('email', $this->input->post('email', true));
            $this->db->set('username', $this->input->post('username', true));
            $this->db->set('note', $this->input->post('note', true));
            $this->db->set('is_active', $this->input->post('is_active', true));
            if ($_FILES['image']['name']) {
                $config = [
                    'allowed_types' => 'jpg|png',
                    'max_size' => '2048',
                    'upload_path' => './images/'
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $id = $this->input->post('id');
                    $data['contact'] = $this->db->get_where('contacts', ['id' => $id])->row_array();
                    $old_image = $data['contact']['image'];
                    if ($old_image != 'default_user2.png') {
                        unlink(FCPATH . 'images/' . $old_image);
                    }
                    $this->db->set('image', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('flash', $this->upload->display_errors());
                }
            }
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('contacts');
        }
        
        public function updateContactProfile() {
            $this->db->set('name', $this->input->post('name', true));
            $this->db->set('branch_address', $this->input->post('branch_address', true));
            $this->db->set('branch_city', $this->input->post('branch_city', true));
            $this->db->set('phone', $this->input->post('phone', true));
            $this->db->set('email', $this->input->post('email', true));
            $this->db->set('username', $this->input->post('username', true));
            $this->db->set('note', $this->input->post('note', true));
            if ($_FILES['image']['name']) {
                $config = [
                    'allowed_types' => 'jpg|png',
                    'max_size' => '2048',
                    'upload_path' => './images/'
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    if ($this->session->userdata('image') != 'default_user2.png') {
                        unlink(FCPATH . 'images/' . $this->session->userdata('image'));
                    }
                    $this->db->set('image', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('flash', $this->upload->display_errors());
                }
            }
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('contacts');
        }

        public function changeContactPasswordById($password, $id) {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $id = $this->input->post('id');
            $this->db->set('password', $password);
            $this->db->where('id', $id);
            $this->db->update('contacts');
        }
        
        public function changeContactPasswordByEmail($password, $email) {
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('contacts');
            $this->db->delete('user_token', ['email' => $email]);
        }

        public function changeContactProfilePassword() {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $username = $this->input->post('username');
            $this->db->set('password', $password);
            $this->db->where('username', $username);
            $this->db->update('contacts');
        }
        
        public function deleteContact($id) {
            $this->db->delete('contacts', ['id' => $id]);
        }
        
        public function searchCompany() {
            $searchcompany = $this->input->post('searchcompany');
            $this->db->like('brand', $searchcompany);
            $this->db->or_like('headquarter_address', $searchcompany);
            $this->db->or_like('headquarter_city', $searchcompany);
            return $this->db->get('companies')->result_array();
        }
        
        public function getAllCompanies() {
            $this->db->order_by('brand', 'ASC');
            return $this->db->get('companies')->result_array();
        }
        
        public function getCompanyById($id) {
            return $this->db->get_where('companies', ['id' => $id])->row_array();
        }

        public function getCompanyByBrand($company_brand) {
            $this->db->where('brand', str_replace('%20', ' ', $company_brand));
            return $this->db->get('companies')->row_array();
        }
        
        public function addNewCompany() {
            $data = [
                'brand' => $this->input->post('brand', true),
                'headquarter_address' => $this->input->post('headquarter_address', true),
                'headquarter_city' => $this->input->post('headquarter_city', true),
                'logo' => $this->input->post('logo', true)
            ];
            $this->db->insert('companies', $data);
        }
        
        public function updateCompany() {
            $this->db->set('brand', $this->input->post('brand', true));
            $this->db->set('headquarter_address', $this->input->post('headquarter_address', true));
            $this->db->set('headquarter_city', $this->input->post('headquarter_city', true));
            if ($_FILES['logo']['name']) {
                $config = [
                    'allowed_types' => 'jpg|png',
                    'max_size' => '2048',
                    'upload_path' => './images/'
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('logo')) {
                    $id = $this->input->post('id');
                    $data['company'] = $this->db->get_where('companies', ['id' => $id])->row_array();
                    $old_image = $data['company']['logo'];
                    if ($old_image != 'default_building2.jpg') {
                        unlink(FCPATH . 'images/' . $old_image);
                    }
                    $this->db->set('logo', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('flash', $this->upload->display_errors());
                }
            }
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('companies');
            $this->db->set('company_brand', $this->input->post('brand', true));
            $this->db->where('company_id', $this->input->post('id'));
            $this->db->update('contacts');
        }
        
        public function deleteCompany($id) {
            $this->db->delete('companies', ['id' => $id]);
            $this->db->delete('contacts', ['company_id' => $id]);
        }

        public function verifyAgentAccount($username) {
            $this->db->set('is_active', 1);
            $this->db->where('username', $username);
            $this->db->update('agents');
            $this->db->delete('user_token', ['username' => $username]);
        }
        
        public function searchAgent() {
            $searchagent = $this->input->post('searchagent');
            $this->db->like('name', $searchagent);
            $this->db->or_like('address', $searchagent);
            $this->db->or_like('city', $searchagent);
            $this->db->or_like('email', $searchagent);
            $this->db->or_like('username', $searchagent);
            return $this->db->get('agents')->result_array();
        }
        
        public function getAllAgents() {
            $this->db->order_by('role_id', 'ASC');
            return $this->db->get('agents')->result_array();
        }
        
        public function getAgentById($id) {
            return $this->db->get_where('agents', ['id' => $id])->row_array();
        }
        
        public function getAgentByEmail($email) {
            return $this->db->get_where('agents', ['email' => $email])->row_array();
        }

        public function getAgentByUsername($username) {
            return $this->db->get_where('agents', ['username' => $username])->row_array();
        }
        
        public function addNewAgent() {
            $email = $this->input->post('email', true);
            $username = $this->input->post('username', true);
            $data = [
                'name' => $this->input->post('name', true),
                'address' => $this->input->post('address', true),
                'city' => $this->input->post('city', true),
                'phone' => $this->input->post('phone', true),
                'email' => $email,
                'username' => $username,
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'image' => $this->input->post('image', true),
                'role_id' => $this->input->post('role_id', true),
                'is_active' => 0
            ];

            $token = base64_encode(openssl_random_pseudo_bytes(32));
            $user_token = [
                'email' => $email,
                'username' => $username,
                'token' => $token
            ];  
            
            $this->db->insert('agents', $data);
            $this->db->insert('user_token', $user_token);
            
            $this->sendEmailVerifyAgent($token);
        }
        
        private function sendEmailVerifyAgent($token) {
            $config = [
                'protocol' =>'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_user' => 'd.herdiawan.s@gmail.com',
                'smtp_pass' => 'h3r@w4t!',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n"
            ];
            
            $this->email->initialize($config);
            $this->email->from('d.herdiawan.s@gmail.com', 'PT. Ava Revota');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Verifikasi Akun');
            $this->email->message('
                Selamat datang di Revota.<br>
                Silakan klik tautan di bawah ini untuk mengaktifkan akun anda dengan username dan password berikut dan mulai bekerja.<br>
                Username: ' . $this->input->post('username') . '<br>
                Password: ' . $this->input->post('password') . '<br>
                Mohon segera perbarui username dan password anda setelah berhasil melakukan login pertama.<br>
                <a href="'. base_url() . 'auth/verify?username=' . $this->input->post('username') . '&token=' . urlencode($token) .'">
                Aktifkan akun
                </a>
            ');
            
            if ($this->email->send()) {
                return true;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
        
        public function updateAgent() {
            $this->db->set('name', $this->input->post('name', true));
            $this->db->set('address', $this->input->post('address', true));
            $this->db->set('city', $this->input->post('city', true));
            $this->db->set('phone', $this->input->post('phone', true));
            $this->db->set('email', $this->input->post('email', true));
            $this->db->set('username', $this->input->post('username', true));
            if ($_FILES['image']['name']) {
                $config = [
                    'allowed_types' => 'jpg|png',
                    'max_size' => '2048',
                    'upload_path' => './images/'
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $id = $this->input->post('id');
                    $data['agent'] = $this->db->get_where('agents', ['id' => $id])->row_array();
                    $old_image = $data['agent']['image'];
                    if ($old_image != 'default_user2.png') {
                        unlink(FCPATH . 'images/' . $old_image);
                    }
                    $this->db->set('image', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('flash', $this->upload->display_errors());
                }
            }
            $this->db->set('role_id', $this->input->post('role_id', true));
            $this->db->set('is_active', $this->input->post('is_active', true));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('agents');
        }
        
        public function updateAgentProfile() {
            $this->db->set('name', $this->input->post('name', true));
            $this->db->set('address', $this->input->post('address', true));
            $this->db->set('city', $this->input->post('city', true));
            $this->db->set('phone', $this->input->post('phone', true));
            $this->db->set('email', $this->input->post('email', true));
            $this->db->set('username', $this->input->post('username', true));
            if ($_FILES['image']['name']) {
                $config = [
                    'allowed_types' => 'jpg|png',
                    'max_size' => '2048',
                    'upload_path' => './images/'
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    if ($this->session->userdata('image') != 'default_user2.png') {
                        unlink(FCPATH . 'images/' . $this->session->userdata('image'));
                    }
                    $this->db->set('image', $this->upload->data('file_name'));
                } else {
                    $this->session->set_flashdata('flash', $this->upload->display_errors());
                }
            }
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('agents');
        }

        public function changeAgentPasswordById() {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $id = $this->input->post('id');
            $this->db->set('password', $password);
            $this->db->where('id', $id);
            $this->db->update('agents');
        }
        
        public function changeAgentPasswordByEmail($password, $email) {
            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('agents');
            $this->db->delete('user_token', ['email' => $email]);
        }
        
        public function changeAgentProfilePassword() {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $username = $this->input->post('username');
            $this->db->set('password', $password);
            $this->db->where('username', $username);
            $this->db->update('agents');
        }

        public function deleteAgent($id) {
            $this->db->delete('agents', ['id' => $id]);
        }

        public function reportMostCases() {
            $querySubject = "SELECT b.subject AS 'subject', COUNT(b.subject) AS 'amount'
                             FROM `tickets` a INNER JOIN `subjects` b
                             ON a.subject = b.subject GROUP BY b.subject
                             ORDER BY amount DESC";
            return $this->db->query($querySubject)->result_array();
        }

        public function reportMostCasesTable() {
            $querySubject = "SELECT b.subject AS 'subject', COUNT(b.subject) AS 'amount'
                             FROM `tickets` a INNER JOIN `subjects` b
                             ON a.subject = b.subject GROUP BY b.subject
                             ORDER BY amount DESC";
            return $this->db->query($querySubject)->result_array();
        }
        
        public function mostCasesByPeriod() {
            $from = $this->input->post('from');
            $until = $this->input->post('until');
            $querySubject = "SELECT b.subject AS 'subject', COUNT(b.subject) AS 'amount'
                             FROM `tickets` a INNER JOIN `subjects` b
                             ON a.subject = b.subject
                             WHERE DATE(date_created) BETWEEN '$from' AND '$until'
                             GROUP BY b.subject ORDER BY amount DESC";
            return $this->db->query($querySubject)->result_array();
        }

        public function mostCasesByPeriodTable() {
            $from = $this->input->post('from');
            $until = $this->input->post('until');
            $querySubject = "SELECT b.subject AS 'subject', COUNT(b.subject) AS 'amount'
                             FROM `tickets` a INNER JOIN `subjects` b
                             ON a.subject = b.subject
                             WHERE DATE(date_created) BETWEEN '$from' AND '$until'
                             GROUP BY b.subject ORDER BY amount DESC";
            return $this->db->query($querySubject)->result_array();
        }

        public function printReport1Period() {
            $from = $this->input->get('from');
            $until = $this->input->get('until');
            $querySubject = "SELECT b.subject AS 'subject', COUNT(b.subject) AS 'amount'
                             FROM `tickets` a INNER JOIN `subjects` b
                             ON a.subject = b.subject
                             WHERE DATE(date_created) BETWEEN '$from' AND '$until'
                             GROUP BY b.subject ORDER BY amount DESC";
            return $this->db->query($querySubject)->result_array();
        }

        public function printReport1PeriodTable() {
            $from = $this->input->get('from');
            $until = $this->input->get('until');
            $querySubject = "SELECT b.subject AS 'subject', COUNT(b.subject) AS 'amount'
                             FROM `tickets` a INNER JOIN `subjects` b
                             ON a.subject = b.subject
                             WHERE DATE(date_created) BETWEEN '$from' AND '$until'
                             GROUP BY b.subject ORDER BY amount DESC";
            return $this->db->query($querySubject)->result_array();
        }

        public function reportAPBA() {
            $queryAgent = "SELECT a.name AS 'agent',
                            SUM(CASE WHEN DATEDIFF(CURDATE(), b.date_created) 
                                BETWEEN  0 AND 7 THEN 1 ELSE 0 END) AS 'w1',
                            SUM(CASE WHEN DATEDIFF(CURDATE(), b.date_created) 
                                BETWEEN 8 AND 14 THEN 1 ELSE 0 END) AS 'w2',
                            SUM(CASE WHEN DATEDIFF(CURDATE(), b.date_created) 
                                BETWEEN 15 AND 21 THEN 1 ELSE 0 END) AS 'w3'
                           FROM agents a INNER JOIN tickets b ON a.name = b.agent_name
                           WHERE b.status = 'Resolved' GROUP BY b.agent_name;";
            return $this->db->query($queryAgent)->result_array();
        }

        public function reportAPBATable() {
            $queryAgent = "SELECT a.name AS 'agent',
                            SUM(CASE WHEN DATEDIFF(CURDATE(), b.date_created) 
                                BETWEEN  0 AND 7 THEN 1 ELSE 0 END) AS 'w1',
                            SUM(CASE WHEN DATEDIFF(CURDATE(), b.date_created) 
                                BETWEEN 8 AND 14 THEN 1 ELSE 0 END) AS 'w2',
                            SUM(CASE WHEN DATEDIFF(CURDATE(), b.date_created) 
                                BETWEEN 15 AND 21 THEN 1 ELSE 0 END) AS 'w3'
                           FROM agents a INNER JOIN tickets b ON a.name = b.agent_name
                           WHERE b.status = 'Resolved' GROUP BY b.agent_name;";
            return $this->db->query($queryAgent)->result_array();
        }
    }
    ?>
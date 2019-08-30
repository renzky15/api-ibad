<?php

    class Profile {
        private $conn;
        private $table = 'org_chart';

        // Profile Properties
        public $org_id;
        public $date;
        public $emp_firstName;
        public $emp_lastName;
        public $emp_position;
        public $dept_name;
        public $dept_in_charge;

        // public $author;
        // public $date_created;
        
        // Constructor with DB

        public function __construct($db){
            $this->conn = $db;

        }
            // GET
        public function read() {
            $query = 'SELECT
                    oc.org_id,
                    oc.date,
                    e.firstName,
                    e.lastName,
                    e.position,
                    d.dept_name,
                    d.dept_in_charge

                    
                    FROM '.$this->table.' oc
                    INNER JOIN
                        employee e ON oc.org_id = e.org_id
                    INNER JOIN
                        department d ON oc.org_id = d.org_id
                    ';
                   

            // Prepare statement

            $stmt =$this->conn->prepare($query);

            // Execute

            $stmt->execute();

            return $stmt;
        }
        public function read_single() {
            $query = 'SELECT
                    job_id,
                    job_desc,
                    job_title,
                    job_role,
                    a.applicant_id,
                    a.first_name,
                    a.last_name,
                    a.email,
                    j.date
                    
                    FROM '.$this->table.' j
                    INNER JOIN
                        applicant a ON j.applicant_id = a.applicant_id
                    WHERE j.job_id = ?
                    LIMIT 0,1
                        ';
                   

            // Prepare statement

            $stmt =$this->conn->prepare($query);

            // Bind the ID
            $stmt->bindParam(1, $this->job_id);


            // Execute

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties

            $this->job_title = $row['job_title'];
            $this->job_desc = $row['job_desc'];
            $this->job_role = $row['job_role'];
            $this->email = $row['email'];
            $this->date_created = $row['date'];


        }


        public function insert() {
            $query = 
            'INSERT INTO '.$this->table.'
            SET
            job_title = :job_title,
            job_desc = :job_desc,
            job_role = :job_role,
            company = :company';

            $stmt =$this->conn->prepare($query);

            // sanitize data
            $this->job_title = htmlspecialchars(strip_tags($this->job_title));
            $this->job_desc = htmlspecialchars(strip_tags($this->job_desc));
            $this->job_role = htmlspecialchars(strip_tags($this->job_role));
            $this->company = htmlspecialchars(strip_tags($this->company));

            // bind data
            $stmt->bindParam(':job_title', $this->job_title);
            $stmt->bindParam(':job_desc', $this->job_desc);
            $stmt->bindParam(':job_role', $this->job_role);
            $stmt->bindParam(':company', $this->company);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function update() {
            $query = 'UPDATE '.$this->table.'
            SET
            job_role = :job_role
            WHERE job_id = :job_id';

            $stmt =$this->conn->prepare($query);

            // sanitize data
            // $this->job_title = htmlspecialchars(strip_tags($this->job_title));
            // $this->job_desc = htmlspecialchars(strip_tags($this->job_desc));
            $this->job_id = htmlspecialchars(strip_tags($this->job_id));
            $this->job_role = htmlspecialchars(strip_tags($this->job_role));
            // $this->company = htmlspecialchars(strip_tags($this->company));
           

            // bind data
            // $stmt->bindParam(':job_title', $this->job_title);
            // $stmt->bindParam(':job_desc', $this->job_desc);
            $stmt->bindParam(':job_id', $this->job_id);
            $stmt->bindParam(':job_role', $this->job_role);
            // $stmt->bindParam(':company', $this->company);
         

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function delete() {

            $query = 'DELETE FROM '.$this->table.' WHERE job_id = :job_id';

            // Prepare stmt
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->job_id = htmlspecialchars(strip_tags($this->job_id));

            // Bind data
            $stmt->bindParam(':job_id', $this->job_id);

            // Execute query

            if ($stmt->execute()) {
                return true;
            }
            
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

    }
?>
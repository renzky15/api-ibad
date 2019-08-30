<?php

    class Job {
        private $conn;
        private $table = 'job';

        // Post Properties
        public $job_id;
        public $job_code;
        public $applicant_id;
        public $job_desc;
        public $job_title;
        public $job_role;
        public $company;
        public $email;

        // public $author;
        public $date_created;
        
        // Constructor with DB

        public function __construct($db){
            $this->conn = $db;

        }
            // GET
        public function read() {
            $query = 'SELECT
                    job_code,
                    job_desc,
                    job_title,
                    a.applicant_id,
                    a.firstName,
                    a.lastName,
                    a.email,
                    j.date_created
                    
                    FROM '.$this->table.' j
                    INNER JOIN
                        job_applicant ja ON j.job_id = ja.job_id
                    INNER JOIN
                        applicant a ON ja.applicant_id = a.applicant_id';
                   

            // Prepare statement

            $stmt =$this->conn->prepare($query);

            // Execute

            $stmt->execute();

            return $stmt;
        }
        public function read_single() {
            $query = 'SELECT
                    job_code,
                    job_desc,
                    job_title,
                    job_role,
                    a.applicant_id,
                    a.firstName,
                    a.lastName,
                    a.email,
                    j.date_created
                    
                    FROM '.$this->table.' j
                    INNER JOIN
                        job_applicant ja ON j.job_id = ja.job_id
                    INNER JOIN
                        applicant a ON ja.applicant_id = a.applicant_id
                    WHERE ja.job_code = ?
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
            $this->date_created = $row['date_created'];


        }


        public function insert() {
            $query = 
            'INSERT INTO '.$this->table.'
            SET
            job_title = :job_title,
            job_desc = :job_desc,
            job_role = :job_role
            
            
            ';

            $stmt =$this->conn->prepare($query);

            // sanitize data
            $this->job_title = htmlspecialchars(strip_tags($this->job_title));
            $this->job_desc = htmlspecialchars(strip_tags($this->job_desc));
            $this->job_role = htmlspecialchars(strip_tags($this->job_role));
            // $this->company = htmlspecialchars(strip_tags($this->company));

            // bind data
            $stmt->bindParam(':job_title', $this->job_title);
            $stmt->bindParam(':job_desc', $this->job_desc);
            $stmt->bindParam(':job_role', $this->job_role);
            // $stmt->bindParam(':company', $this->company);

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

            $query = "DELETE FROM `job`
            INNER JOIN job_applicant ja ON job_id = ja.job_id INNER JOIN applicant a ON ja.applicant_id = a.applicant_id WHERE ja.job_code = :job_code";

            // Prepare stmt
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->job_code = htmlspecialchars(strip_tags($this->job_code));

            // Bind data
            $stmt->bindParam(':job_code', $this->job_code);

            // Execute query

            if ($stmt->execute()) {
                return true;
            }
            
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

    }
?>
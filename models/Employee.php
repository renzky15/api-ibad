<?php

    class Employee{
        private $conn;
        private $table = 'employee';

        // Profile Properties
        public $e_id;
        public $firstName;
        public $lastName;
        public $position;
        public $address;
        public $email;

        // public $author;
        // public $date_created;
        
        // Constructor with DB

        public function __construct($db){
            $this->conn = $db;

        }
            // GET
        public function read() {
            $query = 'SELECT
                    e_id,
                    
                    e.firstName,
                    e.lastName,
                    e.position,
                    e.address,
                    email
                    
                    FROM '.$this->table.' e
                ';
                   

            // Prepare statement

            $stmt =$this->conn->prepare($query);

            // Execute

            $stmt->execute();

            return $stmt;
        }
        public function read_single() {
            $query = 'SELECT
                    e.e_id,
                    e.firstName,
                    e.lastName,
                    e.position,
                    e.address,
                    e.email
                    
                    FROM '.$this->table.' e
                    
                    WHERE e.e_id = ?
                    LIMIT 0,1
                        ';
                   

            // Prepare statement

            $stmt =$this->conn->prepare($query);

            // Bind the ID
            $stmt->bindParam(1, $this->e_id);


            // Execute

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties

            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            $this->position= $row['position'];
            $this->email = $row['email'];
            $this->address = $row['address'];


        }


        public function insert() {
            $query = 
            'INSERT INTO '.$this->table.'
            SET
            firstName = :firstName,
            lastName = :lastName,
            position = :position,
            address = :address,
            email = :email';

            $stmt =$this->conn->prepare($query);

            // sanitize data
            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->lastName = htmlspecialchars(strip_tags($this->lastName));
            $this->position = htmlspecialchars(strip_tags($this->position));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->email = htmlspecialchars(strip_tags($this->email));

            // bind data
            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':position', $this->position);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':email', $this->email);

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function update() {
            $query = 'UPDATE '.$this->table.'
            SET
            firstName = :firstName,
            lastName = :lastName,
            position = :position,
            address = :address,
            email = :email,

            WHERE e_id = :e_id';

            $stmt =$this->conn->prepare($query);

            // sanitize data
            // $this->job_title = htmlspecialchars(strip_tags($this->job_title));
            // $this->job_desc = htmlspecialchars(strip_tags($this->job_desc));
            $this->e_id = htmlspecialchars(strip_tags($this->e_id));
            $this->firstName = htmlspecialchars(strip_tags($this->firstName));
            $this->lastName = htmlspecialchars(strip_tags($this->lastName));
            $this->position = htmlspecialchars(strip_tags($this->position));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->email = htmlspecialchars(strip_tags($this->email));
           

            // bind data
            // $stmt->bindParam(':job_title', $this->job_title);
            // $stmt->bindParam(':job_desc', $this->job_desc);
            $stmt->bindParam(':e_id', $this->e_id);
            $stmt->bindParam(':firstName', $this->firstName);
            $stmt->bindParam(':lastName', $this->lastName);
            $stmt->bindParam(':position', $this->position);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':email', $this->email);
         

            if($stmt->execute()) {
                return true;
            }

            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function delete() {

            $query = 'DELETE FROM '.$this->table.' WHERE e_id = :e_id';

            // Prepare stmt
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->e_id = htmlspecialchars(strip_tags($this->e_id));

            // Bind data
            $stmt->bindParam(':e_id', $this->e_id);

            // Execute query

            if ($stmt->execute()) {
                return true;
            }
            
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

    }
?>
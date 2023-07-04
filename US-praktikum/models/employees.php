<?php
    class Dtdosen{
        // Connection
        private $conn;
        // Table
        private $db_table = "Dtdosen";
        // Columns
        public $id;
        public $nama;
        public $Ttl;
        public $alamat;
        public $nohp;
        public $email;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, nama, Ttl, alamat, nohp, email   FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createDtdosen(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nama = :nama,
                        Ttl = :Ttl,
                        alamat = :alamat, 
                        nohp = :nohp,
                        email = :email";
                        
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->Ttl=htmlspecialchars(strip_tags($this->Ttl));
            $this->alamat=htmlspecialchars(strip_tags($this->alamat));
            $this->nohp=htmlspecialchars(strip_tags($this->nohp));
            $this->email=htmlspecialchars(strip_tags($this->email));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":Ttl", $this->Ttl);
            $stmt->bindParam(":alamat", $this->alamat);
            $stmt->bindParam(":nohp", $this->nohp);
            $stmt->bindParam(":email", $this->email);
                   
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleDtdosen(){
            $sqlQuery = "SELECT
                        id, 
                        nama, 
                        Ttl, 
                        alamat, 
                        nohp, 
                        email,
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nama= $dataRow['nama'];
            $this->Ttl = $dataRow['Ttl'];
            $this->alamat = $dataRow['alamat'];
            $this->nohp = $dataRow['nohp'];
            $this->email = $dataRow['email'];
        }        
        // UPDATE
        public function updateDtdosen(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        Ttl = :Ttl, 
                        alamat = :alamat, 
                        nohp = :nohp, 
                        email = :email
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->Ttl=htmlspecialchars(strip_tags($this->Ttl));
            $this->alamat=htmlspecialchars(strip_tags($this->alamat));
            $this->nohp=htmlspecialchars(strip_tags($this->nohp));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":Ttl", $this->Ttl);
            $stmt->bindParam(":alamat", $this->alamat);
            $stmt->bindParam(":nohp", $this->nohp);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteDtdosen(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>

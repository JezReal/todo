<?php
    class Get{
        protected $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }

        public function getAllTodos($d){

            #declare an empty array, 
            #so that we can insert all the records found on this array
            $data = [];

            #Get all records where account_id is equal to given account_id
            $sql = "SELECT * FROM todo_table WHERE account_id='$d->account_id'";

            #Check if whenever we execute the query, it returns atleast a record.
            #if not, then we return message saying that we have detected nothing
            if($res = $this->pdo->query($sql)->fetchAll()) {
                
                #use a loop to insert each record in the array $data
                foreach ($res as $record) {
					array_push($data, $record);
				}

                #return the array containing the data we collected
				return array("data"=>$data);
            }
            
            else {
                #return message saying no data detected
                return array("error"=>"No data detected");
            } 
        }
    }
?>
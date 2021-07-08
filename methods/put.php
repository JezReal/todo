<?php
    class Put {
        protected $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }

        public function updateTodo($d){
            $sql = "UPDATE todo_table SET date = '$d->date', todo = '$d->todo' WHERE todo_id = '$d->todo_id'";

            
            $sql = $this->pdo->prepare($sql);

            #execute the query
			$sql->execute([]);

            #count affected rows
            $count = $sql->rowCount();

            if($count){
                return array("data"=>"Successfully updated $count todo(s)");
            }
            else{
                return array("error"=>"Failed to update todo");
            }
        }
    }
?>
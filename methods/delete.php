<?php
    class Delete{
        protected $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }
            
        public function deleteTodo($d){
            $sql = "DELETE FROM todo_table WHERE todo_id = '$d->todo_id'";

            
            $sql = $this->pdo->prepare($sql);

            #execute the query
            $sql->execute();

            #count affected rows
            $count = $sql->rowCount();

            if($count){
                return array("data"=>"Successfully deleted $count todo(s)");
            }
            else{
                return array("error"=>"Failed to delete todo)");
            }
        }
    }
?>
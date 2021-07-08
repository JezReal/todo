<?php
    class Post{
        protected $pdo;

        public function __construct(\PDO $pdo){
            $this->pdo = $pdo;
        }

        #Create Query
        public function insertTodo($d){

            $sql = "INSERT INTO todo_table (account_id, date, todo) VALUES (?, ?, ?)";
            $sql = $this->pdo->prepare($sql);

            $sql->execute([
                $d->account_id,
                $d->date,
                $d->todo
            ]);
            #count affected rows
            $count = $sql->rowCount();

            if($count){
                return array("data"=>"Successfully inserted $count todo(s)");
            }
            else{
                return array("error"=>"Failed to insert todo");
            }
        }
        
        public function login($d){
            $em = $d->email;
            $pw = $d->password;

            $sql = "SELECT * FROM accounts_table WHERE email='$em' AND password ='$pw' LIMIT 1";

            if($res = $this->pdo->query($sql)->fetchAll()) {
    
                return array("data"=>array("account_id"=>$res[0]['account_id'], "email"=>$res[0]['email']));
                  
                } else {

                return array("error"=>"Incorrect username or password");
            } 
        }

        public function register($d){
            $sql = "SELECT * FROM accounts_table WHERE email='$d->email' LIMIT 1";

            if ($result = $this->pdo->query($sql)->fetchall()){
                return array("error"=>"Account already exists");

            }else {

                $sql = "INSERT INTO accounts_table (email, password) VALUES (?, ?)";
                $sql = $this->pdo->prepare($sql);

                $sql->execute([
                    $d->email,
                    $d->password
                ]);
                return array("data"=>"Successfully Registered");
            }
        }
    }

?>
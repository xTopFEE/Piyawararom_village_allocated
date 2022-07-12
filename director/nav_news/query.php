<?php
   require_once "db.php";

    class query{

        public function del($id)
        {
            $sql = "DELETE FROM uploadfile WHERE id = '$id'";
            $result = mysqli_query($this->con , $sql);
            return $result;
        }
        
        


    }

?>
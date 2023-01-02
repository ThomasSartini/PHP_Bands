
<?php 

class data{

    public static function cleanSingleData($result, $field){
        $return = ""; 
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $return = $row[$field];     
            }
        return $return;
    }

    public static function cleanAllData($result){
        $return = []; 
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $return[] = $row;
            }
        }
        return $return;
    }

    public static function getSelect($list){
        $str = "";
        foreach($list as $l){
            $str .= "<option value='".$l."'>".$l."</option>";
        }
        return $str;
    }

    public static function cleanData($result, $field){
        $return = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $return[] = $row[$field];
                }
            }
        return $return;
    }

    public static function printCheckBox($list, $type){
        foreach($list as $l){
            $name = $type."[]";
            echo "<input type='checkbox' name='$name' value='$l'>";
            echo "<label style='margin-left:5px'>$l</label>";
            echo "<br>";
        }
    }

    public static function printCompleteCheckBox($list, $type, $field) {
        foreach($list as $l){
            $name = $type."[]";
            echo "<input type='checkbox' name='$name' value='".$l['id']."'>";
            echo "<label style='margin-left:5px'>".$l[$field]."</label>";
            echo "<br>";
        }
    }




}
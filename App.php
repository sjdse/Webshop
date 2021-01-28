<?php

class App{


    public static function main(){
        try {
        $array = self::getData();
       // print_r($array);
        self::viewData($array);
        } catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public static function getData(){

        //variables for randomized stock value
        $min = 0;
        $max = 50;

        $json = @file_get_contents('api.json');
        if (!$json){
            throw new Exception("Can't access api");
        }
        $data = json_decode($json, true);
        foreach ($data as $key => &$value){
                $data[$key]['stock'] = rand($min, $max);
        }
        return $data;
    }

    public static function viewData($array){
        //print_r to check for [stock] in api - testing only
        //print_r($array);
        $result = "";
        foreach ($array as $key => $value) {
            $image = $value['image'];
            $item = $value['item'];
            $price = $value['price'];
            $description = $value['description'];
            $stock = $value['stock'];

            $result .= "
            <div class='col-4'>
                <img src='$image'>
            </div>
                <div class='col-6'>
                <h2>$item</h2>
                <p>$description</p>
                <h5>$$price</h5>
                <h5>$stock items in stock</h5>
            </div>
            ";
            }
            print_r($result);
    }
}

?>
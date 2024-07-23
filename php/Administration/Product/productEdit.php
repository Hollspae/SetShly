<?php session_start();
require_once '../../config/connect.php';
require_once 'productForm.php';

$url = urldecode(((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
$cut_search = substr($url, 63);
$product_ID = $cut_search ;
echo $product_ID;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="libs/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/png">
    <script src="https://unpkg.com/popper.js@1" defer></script>
    <script src="https://unpkg.com/tippy.js@5" defer></script>
    <script src="js/app.js" defer></script>
    <title>SetShly - Заказывай на свой вкус!</title>
</head>

<body>
    <main>

   
        <?php 

for ($i = 0; $i <= count($product_list); $i++) {
    if($product_ID == $product_list[$i][0]){
        $product_name = $product_list[$i][2];
    

    for ($j = 0; $j <= count($product_price_list); $j++) {
        if ($product_ID == $product_price_list[$j][1]) {
            $product_price = $product_price_list[$j][2];

            for ($a = 0; $a <= count($production_list); $a++) {
                if ($product_ID == $production_list[$a][2]) {
                        $arr_materialList[] = $production_list[$a][1];
                        sort($arr_materialList);
               
                        
                        for ($s = 0; $s <= count($material_list); $s++) {
                            foreach($arr_materialList as $value){
                                if($value == $material_list[$s][0]){
                                    $arrColor[] = $material_list[$s][2];
                                    $arrColor = array_unique($arrColor);

                                    for ($p=0; $p <=count($color_list) ; $p++) { 
                                    
                                            foreach($arrColor as $values){
                                            if($values == $color_list[$p][0]){
                                                $arrColorName[] = $color_list[$p][1];
                                                $arrColorName = array_unique($arrColorName);
                                        }
                                    }
                                }
                            }
                
                        }
                    }        

                }
            }
                           
        }

    }
}
}

                            
                print_r ($arr_materialList);


            //                     foreach ($arrColorUnique as $value){
            //                         for ($i=0; $i <=count($color_list) ; $i++) { 
            //                         if($value = $color_list[$i][0]){
            //                             $value = $color_list[$i][1];
                                        
            //                             echo '
            
            //                                 <section class="section-product">
            //                                     <div class="section-block">
            //                                         <img src="product-images/1/1.png" alt="">
            //                                             <div class="section_block__information">
            //                                                 <div class="section-product_info">
            //                                                     <h3>' . $product_name . '</h3>
            //                                                     <h3>' . $product_price . ' р</h3>
            //                                                 </div>
            //                                                 <div class="section-product_info">
            //                                                     <h3>Цвета: ' . $value . '</h3>
            //                                                 </div>
            //                                             </div>
            //                                     </div>
            //                                     <div class="section_block__edit">
            //                                         <a href="productEdit.php"> Изменить </a>
            //                                     </div>
            //                                  </section>
            // ';
            //                         }
            //                     }
                                
                            
     
        

// }
            // if (!empty($arrColorUnique)) {
            //     foreach ($arrColorUnique as $value) {
            //         for ($t = 0; $t <= count($color_list); $t++) {
            //             if ($value == $color_list[$t][0]) {
            //                 $arrColors[] = $color_list[$t][1]; //Название цвета
                            
            //             }
                
            //         }
            //         for ($y = 0; $y <= count($material_list); $y++) {
            //             if ($value == $material_list[$y][2]) {
            //                 $arrSize[] = $material_list[$y][3];
            //                 $arrSizeunique = array_unique($arrSize);
            //                 sort($arrSizeunique);
                
                            
            //             }
            //         }
                
            //     }
            // }

?>




    </main>
</body>

</html>
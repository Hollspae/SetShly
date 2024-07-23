<?php
$Arr_production = [];
$arrColor = [];
$arrSize = [];


function EnterProductAll($product_list, $category_list, $product_price_list, $production_list, $embroidery)
{

  
    for ($i = 0; $i <=count($product_list) - 1; $i++) {
        $product_id = $product_list[$i][0];
        $IDcategory = $product_list[$i][1];
        $product_name = $product_list[$i][2];
   
       
        for ($a = 0; $a <=count($category_list); $a++) {
            if ($IDcategory == $category_list[$a][0]) {
                $product_category = $category_list[$a][1]; //Название категории
       
            }
           
        }

        for ($j = 0; $j <= count($product_price_list); $j++) {
            if ($product_id == $product_price_list[$j][1]) {
                $product_price = $product_price_list[$j][2]; //Цена
                
            }

        }
        for ($s = 0; $s <= count($production_list); $s++) {
            if ($product_id == $production_list[$s][2]) {
                $IDembroidery = $production_list[$s][3];
        
       
                for ($a = 0; $a <= count($embroidery); $a++) {
                    if ($IDembroidery  == $embroidery[$a][0]) {
                        $product_embroidery = $embroidery[$a][1]; //Вышивка товара
       
                      
                    }
                }
            }
        }


          
        $dir = "../../ProductImg/$product_category/$product_embroidery/";
        $fileIMG = scandir($dir, 1);
        $IMGName = array_shift($fileIMG);


 

        echo '
                <div class="card-product" id="">
                <img class="card-product__img" src="../../ProductImg/' . $product_category . '/' . $product_embroidery . '/' . $IMGName . '" alt="Изображение товара" draggable="false">

                    <div class="card-product__span">
                        <h2 class="product-name">' . $product_name . '</h2>
                        <h3 class="product-price">' . $product_price . 'р.</h3>
                    </div>

                    <form method="post" action="../card/card.php?card=' . $product_id . '&color=' . $valuesColor . '&size=' . $valuesSize . ' ">
                        <button>Посмотреть</button>
                    </form>

                </div>';


    }


}
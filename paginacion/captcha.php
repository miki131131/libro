<?php

    //creating security images (captcha) on the fly
    //Send a generated image to the browser 
    

    function create_image($SaveToFile, $NameFile, $TextoImagen) { 
       

        //Set the image width and height 
        $width = 140; 
        $height = 30;  

        //Create the image resource 
        $image = ImageCreate($width, $height);  

        //We are making three colors, white, black and gray 
        $white = ImageColorAllocate($image, 255, 255, 255); 
        $black = ImageColorAllocate($image, 0, 0, 0); 
        $grey = ImageColorAllocate($image, 204, 204, 204);

        //Make the background black 
        ImageFill($image, 0, 0, $black); 

        //Add randomly generated string in white to the image
        ImageString($image, 10, 15, 7, $TextoImagen, $white); 

        //Throw in some lines to make it a little bit harder for any bots to break 
        ImageRectangle($image,0,0,$width-1,$height-1,$grey); 
       
        //Tell the browser what kind of file is come in 
        //	header("Content-Type: image/jpeg"); 

        //Output the newly created image in jpeg format 
        //ImageJpeg($image);

        if ($SaveToFile==true){
            $NameFile=($NameFile!="") ? $NameFile : "validacion";
            $save = strtolower($NameFile) . ".jpg";
            ImageJpeg($image, $save);
        }      
    
        //Free up resources
        ImageDestroy($image); 
    } 
?>
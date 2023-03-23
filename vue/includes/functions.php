<?php

/**
 * send image $file to $path and return its $name concatenated with its extension
 * @param array $image_file image from $_FILES
 * @param string $name to rename the file
 * @param string $destination_path to define
 * @return string $image_name $name + image extension
 */
function get_image_file(array $image_file, string $name, string $destination_path):string {
    // test if file exists and has no error
    if (isset($image_file) && $image_file['error'] === 0) {

        // limit image size
        if ($image_file['size'] > 2000000) {
            throw new Exception('Taille de l\'image maximum : 2mo');
        } else {
            // get image infos
            $image_infos = pathinfo($image_file['name']);

            // get image extensions
            $image_extension = $image_infos['extension'];

            // accepted extensions array
            $extensions_array = ['png', 'gif', 'jpg', 'jpeg', 'webp'];

            if (in_array($image_extension, $extensions_array)) {
                // name image using $name parameter with image extension
                $image_name = $name . '.' . $image_infos['extension'];

                // set path to using $destination_path parameter with image name
                $image_path = $destination_path . $image_name;

                // attempt to move image file to image folder
                if(move_uploaded_file($image_file['tmp_name'], $image_path)) {
                    // if successful, return image name to be stored in instance and/or database
                    return $image_name;
                }
            } else {
                // if the format is not accepted
                $extensions_string = '';

                foreach ($extensions_array as $key => $extension) {
                    if ($key === array_key_last($extensions_array)) {
                        $extensions_string .= $extension;
                    } else {
                        $extensions_string .= $extension . ', ';
                    }
                }
                throw new Exception('Format du fichier non accepté. Formats acceptés : ' . $extensions_string);
            }
        }
    }
}
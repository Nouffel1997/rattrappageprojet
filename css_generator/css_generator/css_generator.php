<?php

function entry_fun($argc, $argv)
{
    if ($argc == 1) {
        echo "Type \"--help\" if you need more info !" . "\n";
    } elseif ($argc >= 2) {
        unset($argv[0]);
        if (is_dir($argv[1])) {
            find_pic($argv);
            sprite_gen($sprite_global = output_img_option($argv, $argc), $find_global = find_pic($argv), $recursive_global = find_pic_recursive($dir = null), $padding_global = padding_option($argv, $argc));
            css_gen($css_global = output_style_option($argv, $argc), $sprite_global, $find_global, $recursive_global, $padding_global);
        } elseif ($argv[1] == "--help") {
            man_css_generator();
        } else {
            echo "Give me a valid directory first !" . "\n";
        }
    }
}
echo entry_fun($argc, $argv);

function output_img_option($argv, $argc)
{
    for ($i = 1; $i < $argc; $i++) {
        if ($argv[$i] == "-i") {
            $image_key1 = array_search("-i", $argv);
            $image_arg1 = array_slice($argv, $image_key1, 1);
            if (array_key_exists(0, $image_arg1) && strpos($image_arg1[0], "-") !== 0) {
                $sprite = $image_arg1[0] . ".png";
                return $sprite;
            } else {
                $sprite = "sprite.png";
                echo "the sprite name by default is \"sprite.png\"\n";
                return $sprite;
            }
        } elseif (substr($argv[$i], 0, 15) == "--output-image=") {
            $argv = implode(" ", $argv);
            $argv = explode("--output-image=", $argv);
            if (strpos($argv[1], " ") === 0) {
                $sprite = "sprite.png";
                echo "the sprite name by default is \"sprite.png\"\n";
                return $sprite;
            } else {
                if (strstr($argv[1], " ")) {
                    $pos = strpos($argv[1], " ");
                    $sprite = substr($argv[1], 0, $pos) . ".png";
                    return $sprite;
                } else {
                    $sprite = $argv[1] . ".png";
                    return $sprite;
                }
            }
        }
    }
}

function output_style_option($argv, $argc)
{
    for ($i = 1; $i < $argc; $i++) {
        if ($argv[$i] == "-s") {
            $image_key1 = array_search("-s", $argv);
            $image_arg1 = array_slice($argv, $image_key1, 1);
            if (array_key_exists(0, $image_arg1) && strpos($image_arg1[0], "-") !== 0) {
                $css = $image_arg1[0] . ".css";
                return $css;
            } else {
                $css = "style.css";
                echo "the css file name by default is \"style.css\"\n";
                return $css;
            }
        } elseif (substr($argv[$i], 0, 15) == "--output-style=") {
            $argv = implode(" ", $argv);
            $argv = explode("--output-style=", $argv);
            if (strpos($argv[1], " ") === 0) {
                $css = "style.css";
                echo "the css file name by default is \"style.css\"\n";
                return $css;
            } else {
                if (strstr($argv[1], " ")) {
                    $pos = strpos($argv[1], " ");
                    $css = substr($argv[1], 0, $pos) . ".css";
                    return $css;
                } else {
                    $css = $argv[1] . ".css";
                    return $css;
                }
            }
        }
    }
}

function padding_option($argv, $argc)
{
    for ($i = 1; $i < $argc; $i++) {
        if ($argv[$i] == "-p") {
            $padding_key = array_search("-p", $argv);
            $padding_arg = array_slice($argv, $padding_key, 1);
            if (array_key_exists(0, $padding_arg) && strpos($padding_arg[0], "-") !== 0) {
                if (is_numeric($padding_arg[0])) {
                    $padding_str = $padding_arg[0];
                    $padding = (int) $padding_str;
                    return $padding;
                } else {
                    echo "If you want to use \"-p\" you have to give me a number !\n";
                    break;
                }
            } else {
                echo "If you want to use \"-p\" you have to give me a number !\n";
                break;
            }
        } elseif (substr($argv[$i], 0, 16) == "--padding=") {
            $argv = implode(" ", $argv);
            $argv = explode("--padding=", $argv);
            if (strpos($argv[1], " ") === 0) {
                echo "If you want to use \"--padding=\" you have to give me a number !\n";
                break;
            } else {
                $argv = implode(" ", $argv);
                $argv = explode(" ", $argv);
                $padding_key1 = array_search("--padding=", $argv);
                $padding_arg1 = array_slice($argv, $padding_key1, 2);
                if (array_key_exists(0, $padding_arg1)) {
                    if (is_numeric($padding_arg1[1])) {
                        $padding_str = $padding_arg1[1];
                        $padding = (int) $padding_str;
                        return $padding;
                    } else {
                        echo "If you want to use \"--padding=\" you have to give me a number !\n";
                        break;
                    }
                } else {
                    echo "If you want to use \"--padding=\" you have to give me a number !\n";
                    break;
                }
            }
        }
    }
}


function find_pic($argv)
{
    $recur1 = array_search("-r", $argv);
    $recur2 = array_search("--recursive", $argv);
    if ($recur1 == true || $recur2 == true) {
        $dir = $argv[1];
        find_pic_recursive($dir);
    } else {
        $dir = $argv[1];
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                $file_name = $entry;
                if ($entry != "." && $entry != "..") {

                    $location = $dir . "/" . $entry;
                    if (is_file($location)) {
                        $original_size = getimagesize($location);
                        $width = $original_size[0];
                        $height = $original_size[1];
                        $format = $original_size[2];
                        $file_objects[] = array(
                            "name" => $file_name,
                            "location" => $location,
                            "width" => $width,
                            "height" => $height,
                            "format" => $format
                        );
                    }
                }
            }
            return $file_objects;
        }
    }
}

function find_pic_recursive($dir)
{
    global $file_objects, $file_name;
    if (is_dir($dir)) {
        $handle = opendir($dir);
        while ($entry = readdir($handle)) {
            $file_name = $entry;
            if ($entry != '.' && $entry != '..') {
                $entry = $dir . '/' . $entry;
                find_pic_recursive($entry);
            }
        }
    }
    list($width, $height, $type) = @getimagesize("$dir");
    if (!empty($type)) {

        $filename = substr(strrchr($dir, "/"), 1);
        $file_objects[] = array(
            "name" => $file_name,
            "location" => $dir,
            "width" => $width,
            "height" => $height,
            "format" => $type
        );
    }
    return $file_objects;
}

function man_css_generator()
{
    echo "____________________________________________________________________________\n\n";
    echo "Instructions: Your first argument need to be a valid directory then you have\n";
    echo "              options below at your disposition\n";
    echo "____________________________________________________________________________\n\n";
    echo "Options: [-r], [--recursive]\n";
    echo "          Look for images into the assets_folder passed as arguement and all of\n";
    echo "          its subdirectories.\n\n";
    echo "         [-i], [--output-image=IMAGE]\n";
    echo "          Name of the generated image, the default name is « sprite.png ».\n\n";
    echo "         [-s], [--output-style=STYLE]\n";
    echo "          Name of the generated stylesheet, the default name is « style.css ».\n\n";
    echo "         [-p], [--padding=NUMBER]\n";
    echo "          Add padding between images of NUMBER pixels.\n";
    echo "____________________________________________________________________________\n\n";
}

function css_gen($css_global, $sprite_global, $find_global, $recursive_global, $padding_global)
{
    if (!isset($css_global)) {
        $css_global = "style.css";
        echo "the css file name by default is \"style.css\"\n";
    }
    if (!isset($sprite_global)) {
        $sprite_global = "sprite.png";;
    }
    if (!isset($padding_global)) {
        $padding_global = 0;
    }
    $css_file = fopen($css_global, "w");
    if (isset($recursive_global)) {
        $count_arr = count($recursive_global);
        $slice_lenght = $count_arr / 2;
        $recursive_global = array_slice($recursive_global, 0, $slice_lenght);
        $pos = 0;
        foreach ($recursive_global as $i) {
            $str_pos = strrpos($i["name"], ".");
            $i["name"] = substr($i["name"], 0, $str_pos);
            $file_list = $i["name"] . ", ";
            fwrite($css_file, $file_list);
        }
        $options = "{\n    position: absolute;\n    display: block;\n}\n\n";
        fwrite($css_file, $options);
        foreach ($recursive_global as $i) {
            $str_pos = strrpos($i["name"], ".");
            $i["name"] = substr($i["name"], 0, $str_pos);
            $coord = "#" . $i["name"] . " {\n" . "    background: url(\"$sprite_global\") -0px -$pos" . "px;\n}\n";
            fwrite($css_file, $coord);
            $pos = $pos + $i["height"] + $padding_global;
        }
    } elseif (isset($find_global)) {
        $pos = 0;
        foreach ($find_global as $i) {
            $str_pos = strrpos($i["name"], ".");
            $i["name"] = substr($i["name"], 0, $str_pos);
            $file_list = $i["name"] . ", ";
            fwrite($css_file, $file_list);
        }
        $options = "{\n    position: absolute;\n    display: block;\n}\n\n";
        fwrite($css_file, $options);
        foreach ($find_global as $i) {
            $str_pos = strrpos($i["name"], ".");
            $i["name"] = substr($i["name"], 0, $str_pos);
            $coord = "#" . $i["name"] . " {\n" . "    background: url(\"$sprite_global\") -0px -$pos" . "px;\n}\n";
            fwrite($css_file, $coord);
            $pos = $pos + $i["height"] + $padding_global;
        }
    }
}

function sprite_gen($sprite_global, $find_global, $recursive_global, $padding_global)
{
    if (!isset($sprite_global)) {
        $sprite_global = "sprite.png";
        echo "the sprite name by default is \"sprite.png\"\n";
    }
    if (!isset($padding_global)) {
        $padding_global = 0;
    }
    if (isset($recursive_global)) {
        $count_arr = count($recursive_global);
        $slice_lenght = $count_arr / 2;
        $recursive_global = array_slice($recursive_global, 0, $slice_lenght);
        $pos = 0;
        foreach ($recursive_global as $value) {
            $max1[] = $value['height'];
            $max2[] = $value['width'];
            $max_width = max($max2);
        }
        $max_padding = count($recursive_global) * $padding_global;
        $max_height = array_sum($max1) + $max_padding;
        $background = imagecreatetruecolor($max_width, $max_height);
        $newimg = $sprite_global;
        foreach ($recursive_global as $i) {
            if ($i['format'] == 3) {
                $imagepng = imagecreatefrompng($i["location"]);
                imagecopy($background, $imagepng, 0, $pos, 0, 0, $i["width"], $i["height"]);
                $pos = $pos + $i["height"] + $padding_global;
                imagedestroy($imagepng);
            } elseif ($i['format'] == 2) {
                $imagejpg = imagecreatefromjpeg($i["location"]);
                imagecopy($background, $imagejpg, 0, $pos, 0, 0, $i["width"], $i["height"]);
                $pos = $pos + $i["height"] + $padding_global;
                imagedestroy($imagejpg);
            } elseif ($i['format'] == 1) {
                $imagegif = imagecreatefromgif($i["location"]);
                imagecopy($background, $imagegif, 0, $pos, 0, 0, $i["width"], $i["height"]);
                $pos = $pos + $i["height"] + $padding_global;
                imagedestroy($imagegif);
            }
        }
        imagepng($background, $newimg);
    } elseif (isset($find_global)) {
        foreach ($find_global as $value) {
            $max1[] = $value["height"];
            $max2[] = $value["width"];
            $max_width = max($max2);
        }
        $max_padding = count($find_global) * $padding_global;
        $max_height = array_sum($max1) + $max_padding;
        $background = imagecreatetruecolor($max_width, $max_height);
        $newimg = $sprite_global;
        $pos = 0;
        foreach ($find_global as $i) {
            if ($i['format'] == 3) {
                $imagepng = imagecreatefrompng($i["location"]);
                imagecopy($background, $imagepng, 0, $pos, 0, 0, $i["width"], $i["height"]);
                $pos = $pos + $i["height"] + $padding_global;
                imagedestroy($imagepng);
            } elseif ($i['format'] == 2) {
                $imagejpg = imagecreatefromjpeg($i["location"]);
                imagecopy($background, $imagejpg, 0, $pos, 0, 0, $i["width"], $i["height"]);
                $pos = $pos + $i["height"] + $padding_global;
                imagedestroy($imagejpg);
            } elseif ($i['format'] == 1) {
                $imagegif = imagecreatefromgif($i["location"]);
                imagecopy($background, $imagegif, 0, $pos, 0, 0, $i["width"], $i["height"]);
                $pos = $pos + $i["height"] + $padding_global;
                imagedestroy($imagegif);
            }
        }
        imagepng($background, $newimg);
    }
}

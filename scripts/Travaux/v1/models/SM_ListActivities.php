<?php

namespace app\scripts\Travaux\v1\models;

use Yii;

class SM_ListActivities {

    public static function ListActivities() {
        $array = array();
        $reflector = new \ReflectionClass(static::class);
        $files = glob(dirname($reflector->getFileName()) . '/json/*.json');
        foreach ($files as $file) {
            $string = file_get_contents($file);
            $json_a = json_decode($string, true);


//            print_r($json_a);
//            exit(0);





            $array[] = ['id' => $json_a['act_id'], 'libelle' => $json_a['act_libelle'], 'keywords' => self::removeAccents(html_entity_decode($json_a['act_keyword']))];
        }
        return $array;
    }

    public static function removeAccents($str) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
        return str_replace($a, $b, $str);
    }

    public static function GetActivityPath($act_id) {
        $reflector = new \ReflectionClass(static::class);
        $file = dirname($reflector->getFileName()) . '/json/act_' . $act_id . '.json';
        return $file;
    }

    public static function GetActivityName($act_id) {
        $reflector = new \ReflectionClass(static::class);
        $file = dirname($reflector->getFileName()) . '/json/act_' . $act_id . '.json';
        $string = file_get_contents($file);
        $json_a = json_decode($string, true);
        return $json_a['act_libelle'];
    }

    public static function GetJSONObject($act_id) {
        $reflector = new \ReflectionClass(static::class);
        $file = dirname($reflector->getFileName()) . '/json/act_' . $act_id . '.json';
        $string = file_get_contents($file);
        return json_decode($string, true);
    }

    public static function GetActivityMandatories($act_id) {
        $array = array();
        $reflector = new \ReflectionClass(static::class);
        $file = dirname($reflector->getFileName()) . '/json/act_' . $act_id . '.json';
        $string = file_get_contents($file);
        $activity = GenForm::jsonDecodeFullArray($string);
        if (is_array($activity) and count($activity) > 0) {
            # Check that $ activity ['act_groups'] is an array and is not empty
            if (array_key_exists('act_groups', $activity) and is_array($activity['act_groups'])) {

                foreach ($activity['act_groups'] as $key_act_groups => $act_group) {
                    if ($act_group['grp_criteres'] and is_array($act_group['grp_criteres'])) {
                        foreach ($act_group['grp_criteres'] as $key_grp_critere => $grp_critere) {
                            if (array_key_exists('crt_obligatoire', $grp_critere) and $grp_critere['crt_obligatoire']) {
                                //print_r($grp_critere);
                                $array[] = ['scq_' . $grp_critere['question_key'], $grp_critere['crt_libelle']];
                            }
                        }
                    }
                }
            }
        }
        $array[] = ['cus_title', 'Civilité'];
        $array[] = ['cus_last_name', 'Nom'];
        $array[] = ['cus_first_name', 'Prénom'];
        $array[] = ['cus_srcommons_consumer_type_monovalue', 'Type de personne'];
        $array[] = ['cus_srcommons_occupant_type_monovalue', 'Type d\'occupant'];
        $array[] = ['cus_postcode', 'Code Postal'];
        $array[] = ['cus_town', 'Ville'];
        $array[] = ['cus_email', 'Email'];
        $array[] = ['cus_tel', 'Téléphone'];
        $array[] = ['cus_availibility', 'Horaires'];


        return $array;
    }

    public static function GetFieldName($act_id) {
        
    }

}

<?php

namespace app\scripts\Travaux\v1\models;

/**
 * Json_Decode
 *
 * @internal servicemagic : AFF-1398
 * @internal servicemagic : AFF-1585
 * @internal servicemagic : AFF-1577
 * @redmine #2992 Merge sources on PROD
 *
 * @param string $json
 * @return array $x
 * @author servicemagic.eu
 */
class GenForm {

    public static function jsonDecodeFullArray($json) {
        $comment = false;
        $out = 'return';
        $iJsonLen = strlen($json);
        for ($i = 0; $i < $iJsonLen; $i++) {
            if (($json[$i] == '\\') && (($json[$i + 1] == '/'))) {
                continue;
            }

            if (!$comment) {
                if ($json[$i] == '[') {
                    $out .= ' array(';
                } else if ($json[$i] == '{') {
                    $out .= ' array(';
                } else if ($json[$i] == '}') {
                    $out .= ')';
                } else if ($json[$i] == ']') {
                    $out .= ')';
                } else if ($json[$i] == ':') {
                    $out .= '=>';
                } else {
                    $out .= $json[$i];
                }
            } else {
                $out .= $json[$i];
            }
            if (($json[$i] == '"') && ($json[$i - 1] != '\\') && $i > 0) {
                $comment = !$comment;
            }
        }

        $testOK = 0;
        $out = '$testOK=1;' . $out;
        $x = @eval($out . ';');
        if ($testOK == 0) {
            throw new exception('error json_encode');
        }
        return $x;
    }

    /**
     * Declaring a function to generate the form for an activity from JSON file
     *
     * @internal servicemagic : AFF-1258
     * @internal servicemagic : AFF-1585
     * @internal servicemagic : AFF-1577
     *
     * @param string $filename_json
     * @return string $html
     * @author servicemagic.eu
     */
    public static function getStructureFormActivity($filename_json, $model, $FormData) {
        # retrieve information from the activity content dan sle JSON file
        if ($filename_json != '' and file_exists($filename_json)) {
            $contents = file_get_contents($filename_json);
            $activity = self::jsonDecodeFullArray($contents);
        } else {
            throw new RuntimeException('File json "' . $filename_json . '" is not exist');
        }

        $html = '';

        if (is_array($activity) and count($activity) > 0) {
            # Check that $ activity ['act_groups'] is an array and is not empty
            if (array_key_exists('act_groups', $activity) and is_array($activity['act_groups'])) {




                # Form of customer
                $html_customer = '
		<ul id="customer">
			<li>
				<div class="required">Civilité <span class="required">*</span></div>
				<select name="cus_title" class="form-control">
						<option value="M.">M.</option>
					<option value="Mme">Mme</option>
					<option value="Mlle">Mlle</option>
			</select>
			</li>
			<li>
				<div>Nom <span class="required">*</span></div>
				<input type="text" name="cus_last_name" value="' . $FormData['cus_last_name'] . '" class="form-control" readonly/>
			</li>
			<li>
				<div>Prénom <span class="required">*</span></div>
				<input type="text" name="cus_first_name" value="' . $FormData['cus_first_name'] . '" class="form-control" readonly/>
			</li>
			<li>
				<div>Vous êtes <span class="required">*</span></div>
				<select name="cus_srcommons_consumer_type_monovalue" class="form-control" readonly>
						<option value="srcommons_consumer_type_monovalue__private_individual">Particulier</option>

			</select> et
				<select name="cus_srcommons_occupant_type_monovalue" class="form-control" readonly>
					<option value="srcommons_occupant_type_monovalue__owner_occupier">Propri&eacute;taire occupant</option>

			</select>
			</li>
			<li>
				<div>Code postal <span class="required">*</span></div>
				<input type="text" name="cus_postcode" value="' . $FormData['cus_postcode'] . '" class="form-control" readonly/>
			</li>
			<li>
				<div>Ville <span class="required">*</span></div>
				<input type="text" name="cus_town" value="' . $FormData['cus_town'] . '" class="form-control" readonly/>
			</li>
			<li>
				<div>E-mail <span class="required">*</span></div>
				<input type="text" name="cus_email" value="' . $FormData['cus_email'] . '" class="form-control" readonly/>
			</li>
			<li>
				<div>Téléphone <span class="required">*</span></div>
				<input type="text" name="cus_tel" value="' . $FormData['cus_tel'] . '" class="form-control" readonly/>
			</li>
			<li>
				<div>Téléphone secondaire</div>
				<input type="text" name="cus_cell" value="' . $FormData['cus_cell'] . '" class="form-control" />
			</li>
			<li>
				<div>Horaires pour vous joindre<span class="required">*</span></div>
				<input type="text" name="cus_availibility" value="' . $FormData['cus_availibility'] . '" class="form-control" />
			</li>
		</ul>';

                $html_questions = '';

                # List of questions regarding the activity
                foreach ($activity['act_groups'] as $key_act_groups => $act_group) {
                    if ($act_group['grp_criteres'] and is_array($act_group['grp_criteres'])) {
                        foreach ($act_group['grp_criteres'] as $key_grp_critere => $grp_critere) {

                            # Initialization code to create HTML
                            $html_grp_criteres = '';

                            # Check the mandatory requirement
                            if (array_key_exists('crt_obligatoire', $grp_critere) and $grp_critere['crt_obligatoire']) {
                                $grp_critere['required'] = '<span class="required">*</span>';
                            }
                            try {
                                # If the table is not empty criteria
                                if (is_array($grp_critere['crt_valeurs_by_rang']) and $grp_critere['crt_valeurs_by_rang']) {

                                    foreach ($grp_critere['crt_valeurs_by_rang'] as $key_crt_valeur => $crt_valeur) {
                                        if (is_array($grp_critere['criteria_json'][$key_crt_valeur])) {
                                            $answer = $grp_critere['criteria_json'][$key_crt_valeur]['answer_key'];
                                        }

                                        if (preg_match("#\_other$#", $answer)) {
                                            $grp_critere['other'] = $answer;
                                        }

                                        # If the type is a checkbox or radio button
                                        if (preg_match("#radio|checkbox#", $grp_critere['crt_type'])) {
                                            $name = $grp_critere['question_key'] . ($grp_critere['crt_type'] == 'checkbox' ? '[]' : '');
                                            $html_grp_criteres .= '	<input type="' . $grp_critere['crt_type'] . '" name="scq_' . $name . '" value="' . $answer . '" class="form-control" />
									<label>' . htmlentities(utf8_decode($crt_valeur['libelle'])) . '</label>';

                                            # Otherwise, if the type is a select
                                        } else if ($grp_critere['crt_type'] == 'select') {
                                            $html_grp_criteres .= '		<option value="' . $answer . '">' . htmlentities(($crt_valeur['libelle'])) . '</option>';
                                        }
                                    }
                                }
                            } catch (\Exception $ex) {
                                //die('Erreur dans le fichier JSON ' . $filename_json);
                                return -1;
                            }



                            # If crt_type corresponds to a select
                            if ($grp_critere['crt_type'] == 'select') {
                                $html_grp_criteres = '	<select name="scq_' . $grp_critere['question_key'] . '" class="form-control">
								' . $html_grp_criteres . ' 	</select>';

                                # If crt_type corresponds to a text
                            } else if ($grp_critere['crt_type'] == 'text') {
                                $html_grp_criteres = '	<input type="' . $grp_critere['crt_type'] . '" name="scq_' . $grp_critere['question_key'] . '" value="" class="form-control"/>';

                                # If crt_type corresponds to a textarea
                            } else if ($grp_critere['crt_type'] == 'textarea') {
                                $html_grp_criteres = '	<textarea name="scq_' . $grp_critere['question_key'] . '" class="form-control"></textarea>';
                            }

                            # If the html code group criteria has been successfully generated, it is added to $ html_questions
                            if ($html_grp_criteres != '') {
                                if (!isset($grp_critere['required'])) {
                                    $grp_critere['required'] = '';
                                }
                                try {
                                    //echo $grp_critere['crt_question'];
                                    $html_questions .= '<li>
                                            <div>
                                                    ' . htmlentities(($grp_critere['crt_question'])) . ' ' . $grp_critere['required'] . '
                                            </div>' .
                                            $html_grp_criteres . '
							</li>';
                                } catch (\Exception $ex) {

//                                    print_r($grp_critere);
//                                    echo (!isset($grp_critere['required'])) ? $grp_critere['required'] : '';
//
//
//
//                                    exit(0);
                                }
                            }

                            $activity['act_groups'][$key_act_groups]['grp_criteres'][$key_grp_critere] = $grp_critere;
                        }
                    }
                }
            } else {
                # at_group array is not specified
                throw new RuntimeException('Not found "act_group" array for activity ' . $activity['act_id']);
            }
        } else {
            throw new RuntimeException('Failure json_decode, the $activity is not array ');
        }

        $html = '<input type="hidden" name="aff_login" value="" />
		<input type="hidden" name="aff_password" value="" />
		<input type="hidden" name="aff_sr_id" value="" />
		<input type="hidden" name="sr_cat_id_sm" value="' . $activity['act_id'] . '" />
		' . $html_customer . '
		<ul id="questions">
			' . $html_questions . '
		</ul>';
//		<input type="submit" name="insert_sr" value="Enregistrer" />';
        //$html = ' <form method="" action="' . $_SERVER['SCRIPT_URI'] . '">' . $html . '</form>';

        return $html;
    }

}

//# Using the function
//try {
//    print getStructureFormActivity($filename_json);
//} catch (Exception $e) {
//    print $e->getMessage();
//}
?>
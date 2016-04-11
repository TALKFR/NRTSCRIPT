<div class="row" style="text-align: center;">
    <span style="color: red;"><b><?= ($NixxisParameters->ActivityType == $NixxisParameters::ACT_OUTBOUND) ? 'APPEL SORTANT' : 'APPEL ENTRANT' ?></b> </span>
</div>
<div class="row" style="background-color: #113060; color: #ffffff; font-size: 14px;">
    <span style="text-decoration: underline;"><b>Identifiant :</b> </span>
    <br><?= $model->IDENTIFIANT1 ?>
    <br>
</div>


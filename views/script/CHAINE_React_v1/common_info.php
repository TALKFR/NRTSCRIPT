<div class="row" style="text-align: center;">
    <span style="color: red;"><b><?= ($NixxisParameters->ActivityType == $NixxisParameters::ACT_OUTBOUND) ? 'APPEL SORTANT' : 'APPEL ENTRANT' ?></b> </span>
</div>
<div class="row" style="background-color: #113060; color: #ffffff; font-size: 14px;">
    <span style="text-decoration: underline;"><b>Numéro membre :</b> </span>
    <br><?= $model->IDENTIFIANT1 ?>
    <br>
    <span style="text-decoration: underline;"><b>Code média :</b> </span>
    <br><?= $model->CODE_MEDIA ?>    
    <br>
    <span style="text-decoration: underline;"><b>Montant dernier PA :</b> </span>
    <br><?= $model->A_MONTANT ?>     
    <br>
    <span style="text-decoration: underline;"><b>Cycle actuel :</b> </span>
    <br><?= $model->GetTextCycle($model->A_PERIODICITE) ?>    
    <br>
    <span style="text-decoration: underline;"><b>Date dernier PA :</b> </span>
    <br><?= $model->A_DATEPA ?>                   
</div>


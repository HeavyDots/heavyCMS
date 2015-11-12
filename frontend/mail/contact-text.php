<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>

<?= Yii::t('mail', '{name} ({email} {phone}) has sent the following message using the contact form', compact('name', 'email'))?>:

$body


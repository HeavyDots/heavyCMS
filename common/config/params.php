<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
    'uploadDirectoryForURL' => 'uploads/',
    'frontendUploadDirectory' => Yii::getAlias('@frontend').'/web/uploads/',
    'backendUploadDirectory' => Yii::getAlias('@backend').'/web/uploads/',
    'frontendURL' => 'overwrite on params-local.php. i.e. http://heavycms.com',
    'backendURL' => 'overwrite on params-local.php. i.e. http://backend.heavycms.com',
];

<?php
/* TODO: frontendLanguages is duplication of frontend/config/params.php => supportedLanguages
   It must be deduplicated at some point
*/
return [
    'adminEmail' => 'admin@example.com',
    'supportedLanguages' => ['en-US' => 'English',
                             'es-ES' => 'Español',
                             'fr-FR' => 'Français'],
    'frontendLanguages' => ['en-US' => 'English',
                            'es-ES' => 'Español',
                            'fr-FR' => 'Français'],
    'appMainLanguage' => 'en-US',
    //set only if fallback Language will be different from appMainLanguage
    'fallbackLanguage' => 'es-ES',
];

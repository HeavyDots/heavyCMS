<?php
/*TODO: Change HeavyCMS logo*/
?>
  <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr>
      <td align="center" valign="top" style="background-color:#ffffff" width="100%">

      <center>
        <table cellspacing="0" cellpadding="0" width="600" class="w320">
          <tr>
            <td align="center" valign="top">

              <table class="force-full-width" cellspacing="0" cellpadding="0" bgcolor="#232925">
                <tr>
                  <td style="background-color:#232925" class="logo">
                    <br>
                    <a href="<?= Yii::$app->params['frontendURL'] ?>"><img src="http://heavycms.com/logo-heavycms.png" alt="Logo"></a>
                  </td>
                  <td class="icons">
                    <br>
                    <a href="https://www.facebook.com/heavydotscom"><img src="https://www.filepicker.io/api/file/Rw9fFADxSxK1JyEuQanm" alt="facebook"></a>
                    <a href="https://twitter.com/HeavyDots"><img src="https://www.filepicker.io/api/file/WzHKffHYQKe7xpO35hSw" alt="twitter"></a>
<!--                     <a href="#"><img src="https://www.filepicker.io/api/file/doa3fyePR0Kdnu55nlNo" alt="google+"></a>
                    <a href="#"><img src="https://www.filepicker.io/api/file/dresyXUMRjalUp3zvwXC" alt="instagram"></a> -->
                  </td>
                </tr>
              </table>

              <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#232925">
                <tr>
                  <td class="computer-image">
                    <br>
                    <br class="mobile-hide" />
                    <img style="display:block;" width="224" height="213" src="https://www.filepicker.io/api/file/CoMxXSlVRDuRQWNwnMzV" alt="hello">
                  </td>
                  <td style="color: #ffffff;" class="header-text">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <span style="font-size: 24px;"><?=Yii::t('mail', 'New Message')?></span><br><br>
                    <?= Yii::t('mail', '{name} ({email} {phone}) has sent the following message using the contact form', compact('name', 'email', 'phone'))?>:
                    <br>
                    <br>
                    <br>
                  </td>
                </tr>
              </table>


              <table class="force-full-width" cellspacing="0" cellpadding="30" bgcolor="#ebebeb">
                <tr>
                  <td>
                    <table cellspacing="0" cellpadding="0" class="force-full-width">
                      <tr>
                        <td>
                          <?= $body ?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>


              <table class="force-full-width" cellspacing="0" cellpadding="20" bgcolor="#2b934f">
                <tr>
                  <td style="background-color:#2b934f; color:#ffffff; font-size: 14px; text-align: center;">
                    <?= date('Y') ?> HeavyCMS
                  </td>
                </tr>
              </table>


            </td>
          </tr>
        </table>

      </center>
      </td>
    </tr>
  </table>
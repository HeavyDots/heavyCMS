<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

use common\helpers\Configuration;
/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $body;
    public $body_more; //fake field. Honeypot.
    public $phone;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email subject and body are required
            [['name', 'email', 'body', 'phone'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            //['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('contact', 'name'),
            'email' => Yii::t('contact', 'email'),
            'subject' => Yii::t('contact', 'subject'),
            'body' => Yii::t('contact', 'body'),
            'phone' => Yii::t('contact', 'phone'),
            'verifyCode' => Yii::t('contact', 'verifyCode'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail()
    {
        $emailConfiguration = Configuration::get('email-for-contact-form');
        $email = empty($emailConfiguration) ? Yii::$app->params['adminEmail'] : $emailConfiguration;
        if (!isset($this->body_more)) {
            return Yii::$app->mailer->compose(['html' => 'contact-html', 'text' => 'contact-text'],
                                                                    ['name' => $this->name,
                                                                    'email' => $this->email,
                                                                    'body' => $this->body,
                                                                    'phone' => $this->phone])
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject(Yii::t('mail', 'New message from Contact Form'))
                ->setTextBody($this->body)
                ->send();
        }
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $id
 * @property string $street
 * @property int $apt
 * @property string $city
 * @property int $state
 * @property int $zipcode
 * @property int $contact_id
 *
 * @property Contact $contact
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apt', 'state', 'zipcode', 'contact_id'], 'integer'],
            [['state', 'zipcode', 'contact_id', 'street', 'city'], 'required'],
            [['street'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 100],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::className(), 'targetAttribute' => ['contact_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'street' => 'Street',
            'apt' => 'Apt, Suite Number',
            'city' => 'City',
            'state' => 'State/ Province',
            'zipcode' => 'Zipcode',
            'contact_id' => 'Contact ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::className(), ['id' => 'contact_id']);
    }
}

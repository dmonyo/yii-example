<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $last_name
 * @property int $default_contact
 * @property string $telephone
 *
 * @property Address[] $addresses
 * @property Company $company
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name', 'last_name'], 'required'],
            [['company_id', 'default_contact'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['last_name'], 'string', 'max' => 200],
            [['telephone'], 'string', 'max' => 15],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'last_name' => 'Last Name',
            'default_contact' => 'Default Contact',
            'telephone' => 'Telephone',
            'fulladdress' => 'Address'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['contact_id' => 'id']);
    }

    public function getFullname()
    {
        return $this->name . ' ' . $this->last_name;
    }

    public function getFulladdress(){
        return $this->address->street . ' ' . $this->address->apt . ' ' 
                . $this->address->city . ' ' . $this->address->state 
                . ' ' . $this->address->zipcode;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}

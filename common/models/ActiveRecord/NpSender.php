<?php
namespace common\models\ActiveRecord;
use frontend\models\n;
use Yii;

/**
 * This is the model class for table "np_sender".
 *
 * @property int $id
 * @property string $api_key
 * @property string $name
 * @property string $city
 * @property string $city_ref
 * @property string $warehouses
 * @property string $warehouses_ref
 */
class NpSender extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'np_sender';
    }

    public function rules()
    {
        return [
            [['api_key', 'name', 'city', 'city_ref', 'warehouses_ref'], 'string', 'max'=>60],
            [['warehouses'], 'string', 'max'=>120],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'api_key'=>'Api Key',
            'name'=>'Name',
            'city'=>'City',
            'city_ref'=>'City Ref',
            'warehouses'=>'Warehouses',
            'warehouses_ref'=>'Warehouses Ref',
        ];
    }

    public static function createSender($key, $name)
    {
        $model = new self();
        $model->api_key = $key;
        $model->name = $name;
        $model->city = n::CITY_DEFAULT;
        $model->city_ref = n::CITY_REF_DEFAULT;
        $model->save();
        return $model->id;
    }

    public static function setSenderWarehouse($id, $warehouse_ref, $warehouse_name) {
        $model = self::findOne($id);
        $model->warehouses = $warehouse_name;
        $model->warehouses_ref = $warehouse_ref;
        return $model->save();
    }
}

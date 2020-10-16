<?php
namespace common\models\ActiveRecord;
use frontend\models\a;
use frontend\models\f;
use frontend\models\ico;
use Yii;

/**
 * This is the model class for table "nova_poshta".
 *
 * @property int $id
 * @property int $user_id
 * @property int $moderator_id
 * @property string $cart
 * @property int $price Цена
 * @property int $profit Дроп +
 * @property string $image
 * @property int $is_accept Принято / Нет
 * @property int $is_closed Закрыто / Нет
 * @property int $is_pack Упакован / Нет
 * @property string $PayerType Тип плательщика
 * @property string $PaymentMethod Форма оплаты
 * @property string $Weight Вес фактический
 * @property string $ServiceType Технология доставки
 * @property string $CitySender Идентификатор города отправителя
 * @property string $Sender Идентификатор отправителя
 * @property string $SenderAddress Идентификатор адреса отправителя
 * @property string $ContactSender Идентификатор контактного лица отправителя
 * @property string $ContactRecipient Идентификатор контактного лица получателя
 * @property string $SendersPhone Телефон отправителя
 * @property string $CityRecipient Идентификатор города отправителя
 * @property string $Recipient Идентификатор получателя
 * @property string $RecipientAddress Идентификатор номера отделения 
 * @property string $RecipientsPhone Телефон получателя
 * @property string $DateTime Дата отправки в формате дд.мм.гггг
 * @property string $sender_city_name sender_city_name
 * @property string $sender_warehouses_name sender_warehouses_name
 * @property string $sender_last_name sender_last_name
 * @property string $sender_first_name sender_first_name
 * @property string $sender_middle_name sender_middle_name
 * @property string $recipient_city_name recipient_city_name
 * @property string $recipient_warehouses_name recipient_warehouses_name
 * @property string $recipient_last_name recipient_last_name
 * @property string $recipient_first_name recipient_first_name
 * @property string $recipient_middle_name recipient_middle_name
 * @property string $IntDocNumber Номер ЭН
 * @property string $IntDocRef Идентификатор ЭН
 * @property int $CostOnSite Cтоимость за доставку
 * @property string $Status Статус
 * @property string $StatusCode Идентификатор статуса
 * @property int $date_update Последнее действие
 * @property int $delivery_type 1 - наложеный платеж / 2 - предоплата
 * @property int $retail_price Цена в корзине
 * @property int $drop_price Цена дропа
 * @property int $delivery_name Наложка/Предоплата
 * @property int $np_sender_id Текущий отправитель
 * @property int $is_pay Оплачено/Нет
 */
class NovaPoshtaTable extends \yii\db\ActiveRecord
{
    public static function tableName() { return 'nova_poshta'; }

    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['retail_price', 'drop_price', 'user_id', 'moderator_id', 'price', 'profit', 'is_accept', 'is_closed', 'is_pack', 'CostOnSite', 'delivery_type'], 'integer'],
            [['cart'], 'string'],
            [['image', 'PayerType', 'PaymentMethod', 'Weight', 'ServiceType', 'CitySender', 'Sender', 'SenderAddress', 'ContactSender', 'ContactRecipient', 'SendersPhone', 'CityRecipient', 'Recipient', 'RecipientAddress', 'RecipientsPhone', 'DateTime', 'sender_city_name', 'sender_last_name', 'sender_first_name', 'sender_middle_name', 'recipient_city_name', 'recipient_last_name', 'recipient_first_name', 'recipient_middle_name', 'IntDocNumber', 'IntDocRef', 'StatusCode'], 'string', 'max'=>60],
            [['delivery_name','sender_warehouses_name', 'recipient_warehouses_name', 'Status'], 'string', 'max'=>255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'user_id'=>'User ID',
            'moderator_id'=>'Moderator ID',
            'cart'=>'Cart',
            'price'=>'Цена',
            'profit'=>'Дроп +',
            'image'=>'Image',
            'is_accept'=>'Принято / Нет',
            'is_closed'=>'Закрыто / Нет',
            'is_pack'=>'Упакован / Нет',
            'PayerType'=>'Тип плательщика',
            'PaymentMethod'=>'Форма оплаты',
            'Weight'=>'Вес фактический',
            'ServiceType'=>'Технология доставки',
            'CitySender'=>'Идентификатор города отправителя',
            'Sender'=>'Идентификатор отправителя',
            'SenderAddress'=>'Идентификатор адреса отправителя',
            'ContactSender'=>'Идентификатор контактного лица отправителя',
            'ContactRecipient'=>'Идентификатор контактного лица отправителя',
            'SendersPhone'=>'Телефон отправителя',
            'CityRecipient'=>'Идентификатор города отправителя',
            'Recipient'=>'Идентификатор получателя',
            'RecipientAddress'=>'Идентификатор номера отделения ',
            'RecipientsPhone'=>'Телефон получателя',
            'DateTime'=>'Дата отправки в формате дд.мм.гггг',
            'sender_city_name'=>'sender_city_name',
            'sender_warehouses_name'=>'sender_warehouses_name',
            'sender_last_name'=>'sender_last_name',
            'sender_first_name'=>'sender_first_name',
            'sender_middle_name'=>'sender_middle_name',
            'recipient_city_name'=>'recipient_city_name',
            'recipient_warehouses_name'=>'recipient_warehouses_name',
            'recipient_last_name'=>'recipient_last_name',
            'recipient_first_name'=>'recipient_first_name',
            'recipient_middle_name'=>'recipient_middle_name',
            'IntDocNumber'=>'Номер ЭН',
            'IntDocRef'=>'Идентификатор ЭН',
            'CostOnSite'=>'Cтоимость за доставку',
            'Status'=>'Статус',
            'StatusCode'=>'Идентификатор статуса',
            'date_update'=>'Последнее действие',
            'is_pay'=>'Оплачено/Нет'
        ];
    }

    public function getLastUpdate()
    {
        return f::getFormatDate($this->date_update, true);
    }

    public function getStatusDot()
    {
        if ($this->StatusCode === NULL) return '⚪⚪⚪⚪⚪'; // Новый заказ
        if ($this->StatusCode === '01') return '⚫⚪⚪⚪⚪'; // Заказ принят
        if ($this->StatusCode === '1') return '⚫⚫⚪⚪⚪'; // Упакован. Новая почта ожидает отправление
        if ($this->StatusCode === '2') return ico::html_smb_not; // Заказ удален
        if ($this->StatusCode === '4') return '⚫⚫⚫⚪⚪'; // Відправлення у місті ХХXХ.
        if ($this->StatusCode === '5') return '⚫⚫⚫⚪⚪'; // Відправлення прямує до міста YYYY.
        if ($this->StatusCode === '6') return '⚫⚫⚫⚪⚪'; // 	Відправлення у місті YYYY, орієнтовна доставка до ВІДДІЛЕННЯ-XXX dd-mm.Очікуйте додаткове повідомлення про прибуття.
        if ($this->StatusCode === '7') return '⚫⚫⚫⚫⚪'; // Прибув на відділення
        if ($this->StatusCode === '8') return '⚫⚫⚫⚫⚪'; // Прибув на відділення
        if ($this->StatusCode === '9') return '⚫⚫⚫⚫⚫'; // 	Відправлення отримано
        if ($this->StatusCode === '10') return '⚫⚫⚫⚫⚫'; //	Відправлення отримано %DateReceived%.Протягом доби ви одержите SMS-повідомлення
        if ($this->StatusCode === '11') return '⚫⚫⚫⚫⚫'; //	Відправлення отримано %DateReceived%.Грошовий переказ видано одержувачу.
        //if ($this->StatusCode === '101') return ''; //	На шляху до одержувача
        if (in_array($this->StatusCode, ['102','103','108'])) return '⚫⚫⚫⚫⚫'; // Відмова одержувача
        if ($this->StatusCode === '104') return ''; // Змінено адресу
        if ($this->StatusCode === '105') return ''; // Припинено зберігання
        //if ($this->StatusCode === '106') return ''; // Одержано і створено ЄН зворотньої доставки

    }

    public function getStatusImg()
    {
        if ($this->StatusCode === NULL) return '<amp-img src="/icon/new.svg" height="12" width="12"></amp-img>';
        if ($this->StatusCode === '01') return '<amp-img src="/icon/check.svg" height="12" width="12"></amp-img>';
        if ($this->StatusCode === '1') return '<amp-img src="/icon/commercial-delivery-symbol-of-a-list-on-clipboard-on-a-box-package.svg" height="12" width="12"></amp-img>';
        if ($this->StatusCode === '2') return '<amp-img src="/icon/error.svg" height="12" width="12"></amp-img>';
        if ($this->StatusCode === '4') return '<amp-img src="/icon/cart.svg" height="12" width="12"></amp-img>';
        if ($this->StatusCode === '5') return '<amp-img src="/icon/logistics-delivery-truck-in-movement.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if ($this->StatusCode === '6') return '<amp-img src="/icon/international-delivery.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if ($this->StatusCode === '7') return '<amp-img src="/icon/call-center-worker-with-headset.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if ($this->StatusCode === '8') return '<amp-img src="/icon/woman-with-headset.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if ($this->StatusCode === '9') return '<amp-img src="/icon/package-for-delivery.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if ($this->StatusCode === '10') return '<amp-img src="/icon/talking-by-phone-auricular-symbol-with-speech-bubble.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if ($this->StatusCode === '11') return '<amp-img src="/icon/dollar-bill-and-coins.svg" height="16" width="16" style="vertical-align: middle "></amp-img>';
        if (in_array($this->StatusCode, ['102','103','108'])) return '<amp-img src="/icon/package-cancel.svg" height="12" width="12"></amp-img>';
    }
    public function getStatusIcon()
    {
        if ($this->StatusCode === NULL) return 'new';
        if ($this->StatusCode === '01') return 'check';
        if ($this->StatusCode === '1') return 'commercial-delivery-symbol-of-a-list-on-clipboard-on-a-box-package';
        if ($this->StatusCode === '2') return 'error';
        if ($this->StatusCode === '201') return 'swap';
        if ($this->StatusCode === '202') return 'back';
        if ($this->StatusCode === '4') return 'cart';
        if ($this->StatusCode === '5') return 'logistics-delivery-truck-in-movement';
        if ($this->StatusCode === '6') return 'international-delivery';
        if ($this->StatusCode === '7') return 'call-center-worker-with-headset';
        if ($this->StatusCode === '8') return 'woman-with-headset';
        if ($this->StatusCode === '9') return 'package-for-delivery';
        if ($this->StatusCode === '10') return 'talking-by-phone-auricular-symbol-with-speech-bubble';
        if ($this->StatusCode === '11') return 'dollar-bill-and-coins';
        if (in_array($this->StatusCode, ['102','103','108'])) return 'package-cancel';
    }
    public function getResult()
    {
        if ($this->StatusCode === '2') return ico::html_smb_not; // Заказ удален
        if ($this->is_closed) {
            return (in_array($this->StatusCode, ['9','10','11']))
                ? '+'.$this->drop_price.' грн / +'.$this->profit.' грн'
                : '0 / -'.($this->CostOnSite*2).' грн';
        }
        if ($this->StatusCode === NULL) return 'ожидает подтверждения...'; // Новый заказ
        if ($this->StatusCode === '01') return 'ожидает на упаковку...'; // Заказ принят
        if ($this->StatusCode === '1') return 'готов к отправке'; // Упакован. Новая почта ожидает отправление

        if ($this->StatusCode === '4') return 'заказ в отделении отправителя'; // Відправлення у місті ХХXХ.
        if ($this->StatusCode === '5') return 'заказ в пути..'; // Відправлення прямує до міста YYYY.
        if ($this->StatusCode === '6') return 'заказ в городе отправителя'; // 	Відправлення у місті YYYY, орієнтовна доставка до ВІДДІЛЕННЯ-XXX dd-mm.Очікуйте додаткове повідомлення про прибуття.
        if ($this->StatusCode === '7') return 'ожидает получения...'; // Прибув на відділення
        if ($this->StatusCode === '8') return 'ожидает получения...'; // Прибув на відділення
        if ($this->StatusCode === '9') return '✓ (по предоплате)'; // 	Відправлення отримано
        if ($this->StatusCode === '10') return '✓ ожидается перевод...'; //	Відправлення отримано %DateReceived%.Протягом доби ви одержите SMS-повідомлення
        if ($this->StatusCode === '11') return '✓ перевод получен'; //	Відправлення отримано %DateReceived%.Грошовий переказ видано одержувачу.
        //if ($this->StatusCode === '101') return ''; //	На шляху до одержувача
        if (in_array($this->StatusCode, ['102','103','108'])) return '✗ отказ'; // Відмова одержувача
        if ($this->StatusCode === '104') return ''; // Змінено адресу
        if ($this->StatusCode === '105') return ''; // Припинено зберігання
        //if ($this->StatusCode === '106') return ''; // Одержано і створено ЄН зворотньої доставки
    }

    public function getStatusName()
    {
        if ($this->StatusCode) {
            return $this->Status;
        } else {
            return 'Новый заказ';
        }
    }

    public static function createInternetDocument($cart, $api_response, $delivery_type, $price, $payer_type, $save_price, $weight)
    {
        $model = new self();
        $model->user_id = Yii::$app->user->id;
        $model->cart = serialize($cart);
        $model->price = $price;
        $profit = 0;
        foreach ($cart['cart'] as $product) {
            if (!$model->image) $model->image = $product['image'];
            $profit = $profit + ($product['price'] - $product['drop_price'])*$product['count'];
        }
        $model->retail_price = $cart['final_price'];
        $model->drop_price = $save_price;
        $model->profit = $price - $cart['drop_final_price'];
        $model->delivery_type = $delivery_type;
        $model->delivery_name = ($delivery_type == 1) ? 'Наложенный платёж' : 'Предоплата';
        $model->PayerType = $payer_type;
        $model->PaymentMethod = 'Cash';
        $model->Weight = $weight;
        $model->ServiceType = 'WarehouseWarehouse';
        $model->CitySender = $cart['CitySender'];
        $model->Sender = $cart['Sender'];
        $model->SenderAddress = $cart['SenderAddress'];
        $model->ContactSender = $cart['ContactSender'];
        $model->ContactRecipient = $cart['ContactRecipient'];
        $model->SendersPhone = $cart['SendersPhone'];
        $model->CityRecipient = $cart['CityRecipient'];
        $model->Recipient = $cart['Recipient'];
        $model->RecipientAddress = $cart['RecipientAddress'];
        $model->RecipientsPhone = $cart['RecipientsPhone'];
        $model->DateTime = $api_response['data'][0]['EstimatedDeliveryDate'];
        $model->sender_city_name = $cart['sender_city_name'];
        $model->sender_warehouses_name = $cart['sender_warehouses_name'];
        $model->sender_last_name = $cart['sender_last_name'];
        $model->sender_first_name = $cart['sender_first_name'];
        $model->sender_middle_name = $cart['sender_middle_name'];
        $model->recipient_city_name = $cart['recipient_city_name'];
        $model->recipient_warehouses_name = $cart['recipient_warehouses_name'];
        $model->recipient_last_name = $cart['recipient_last_name'];
        $model->recipient_first_name = $cart['recipient_first_name'];
        $model->recipient_middle_name = $cart['recipient_middle_name'];
        $model->IntDocNumber = $api_response['data'][0]['IntDocNumber'];
        $model->IntDocRef = $api_response['data'][0]['Ref'];
        $model->CostOnSite = $api_response['data'][0]['CostOnSite'];
        $model->date_update = time();
        $model->np_sender_id = Yii::$app->cache->get('current_np');
        if ($delivery_type == 1) {
            $model->Status = 'Заказ принят';
            $model->StatusCode = '01';
        }
        $model->save();
        //echo '<pre>';print_r($model);die;
        return $model;
    }
}

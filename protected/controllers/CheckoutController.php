<?php

class CheckoutController extends Controller
{
    public $layout = '//layouts/product';

    // @todo make a model for everything and make validation. After launch
    public function actionOrder()
    {
        $orderItems = array();
        $orderTotal = 0;
        foreach(Yii::app()->shoppingCart->getPositions() as $cartItem)
        {
            $orderItem = new OrderItem();
            $orderItem->status = 'processing';
            $orderItem->price = $cartItem->price;
            $orderItem->qty = $cartItem->getQuantity();
            $orderItem->row_total = $cartItem->getSumPrice();
            $orderItem->product_id = $cartItem->id;
            $orderItem->item_id = $cartItem->item->id;
            $orderItem->title = $cartItem->getDynamicTitle();
            $orderItems[] = $orderItem;
            $orderTotal += $orderItem->row_total;
        }

        $customer = new Customer();
        $deliveryId = Yii::app()->shoppingCart->getDeliveryMethodId();
        $deliveryData = Yii::app()->request->getParam('Delivery-'.$deliveryId);
        $addressString = CJSON::encode($deliveryData);
        $customer->firstname = isset($deliveryData['firstName'])? $deliveryData['firstName'] : '';
        $customer->lastname = isset($deliveryData['lastName'])? $deliveryData['lastName'] : '';
        $customer->fullname = isset($deliveryData['name'])? $deliveryData['name'] :
            $deliveryData['firstName'] . ' ' . $deliveryData['lastName'];
        $customer->email = $deliveryData['email'];
        $customer->phone = $deliveryData['phone'];
        $customer->address_string = $addressString;
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->total_price = $orderTotal + Yii::app()->shoppingCart->getDeliveryPrice();
        $order->status = 'processing';
        $order->delivery = $deliveryId;
        $order->address = $addressString;
        $order->payment = Yii::app()->shoppingCart->getPaymentMethodId();
        $order->comment = Yii::app()->request->getParam('comment');
        $order->save();
        $a = $order->getErrors();

        foreach ($orderItems as $orderItem)
        {
            $orderItem->order_id = $order->id;
            $orderItem->save();
        }

        $this->_sendCustomerEmail($order, $orderItems, $customer);
        $this->_sendAdminEmail($order, $orderItems, $customer);

        $this->render('success', array('order' => $order));
    }

    private function _sendCustomerEmail($order, $orderItems, $customer)
    {
        $mail = new YiiMailer('new_order', array('order' => $order, 'orderItems' => $orderItems, 'customer' => $customer));

        //set properties
        $mail->setFrom(Yii::app()->params['adminEmail']);
        $mail->setSubject('Ваш заказ #'.$order->id);
        $mail->setTo($customer->email);
        //send
        if ($mail->send()) {
            Yii::app()->user->setFlash('contact','Вам на email отправлено подверждение заказа.');
        } else {
            Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
        }
    }

    private function _sendAdminEmail($order, $orderItems, $customer)
    {
        $mail = new YiiMailer('new_order_admin', array('order' => $order, 'orderItems' => $orderItems, 'customer' => $customer));

        //set properties
        $mail->setFrom($customer->email);
        $mail->setSubject('Заказ #'.$order->id);
        $mail->setTo(Yii::app()->params['adminEmail']);
        //send
        $mail->send();
    }

    /**
     * dummy
     */
    public function actionValidateOrder()
    {
        $response = array();
        $response['status'] = 'success';
        $this->jsonResponse($response);
    }

}
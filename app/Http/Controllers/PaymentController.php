<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use Exception;

class PaymentController extends Controller {

    private $_api_context;

    public function __construct() {
        // setup PayPal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function debit(Request $request) {

        $card = new CreditCard();
        $card->setType("visa")
                ->setNumber(urlencode($request->number))
                ->setExpireMonth(urlencode($request->month))
                ->setExpireYear(urlencode($request->year))
                ->setCvv2(urlencode($request->cvv))
                ->setFirstName(urlencode($request->first_name))
                ->setLastName(urlencode($request->last_name));

        $fi = new FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));

        $item1 = new Item();
        $item1->setName(urlencode($request->item_name))
                ->setDescription(urlencode($request->description))
                ->setCurrency('USD')
                ->setQuantity(urlencode($request->quantity))
                ->setPrice(urlencode($request->price));

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $amount = new Amount();
        $amount->setCurrency("USD")
                ->setTotal(3396);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo '<pre>';
            print_r($ex->getCode()); // Prints the Error Code
            echo '<pre>';
            print_r(json_decode($ex->getData())); // Prints the detailed error message
            die;
        }
        echo '<pre>';
        print_r($payment->toArray());
        echo '<br>';
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

// add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            echo 'failed';
            die;
            return redirect('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        if (isset($redirect_url)) {
        // redirect to paypal
            return redirect($redirect_url);
        }
        echo 'error';
        die;
        return redirect('/');
    }

    public function test() {
        return view('payment.test');
    }

    /**
     * Save the order from the makePayment function
     *
     *  */
    public function payment($paymentData) {
        $cardNumber = urlencode($paymentData['card_number']);
        $month = urlencode($paymentData['month']);
        $year = urlencode($paymentData['year']);
        $cvv = urlencode($paymentData['cvv']);
        $first_name = urlencode($paymentData['first_name']);
        $last_name = urlencode($paymentData['last_name']);
        $total_amount = urlencode($paymentData['paid_amount']);

        $card = new CreditCard();
        $card->setType("visa")
                ->setNumber($cardNumber)
                ->setExpireMonth($month)
                ->setExpireYear($year)
                ->setCvv2($cvv)
                ->setFirstName($first_name)
                ->setLastName($last_name);

        $fi = new FundingInstrument();
        $fi->setCreditCard($card);

        $payer = new Payer();
        $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));

        $amount = new Amount();
        $amount->setCurrency("USD")
                ->setTotal($total_amount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

        $payment = new Payment();
        $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));
        try {
            $pay = $payment->create($this->_api_context);
            return ['result' => true];
        } catch (Exception $ex) {
            $data = ['result' => false];
            $data['error_code'] = $ex->getCode();
            $data['error_message'] = $ex->getMessage();
            if ($ex->getData()) {
                $data['error_data'] = $this->makeError(json_decode($ex->getData()));
            } else {
                $data['error_data'] = "* Some network issue generated errors";
            }
            return $data;
        }
    }

     /**
     * Displays the details of payment errors
     * @param  int  $id
     * @return\Illuminate\Http\Response
     */
    public function makeError($errorcode) {
        $msg = '';
        foreach ($errorcode->details as $i => $v) {
            if ($v->field) {
                if ($v->issue) {
                    $msg.= '* ' . $v->issue . '<br/>';
                }
            }
        }
        return $msg;
    }

}

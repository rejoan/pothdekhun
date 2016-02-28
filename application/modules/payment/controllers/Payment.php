<?php

require 'application/libraries/authorizenet/autoload.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Payment extends MX_Controller {

    public function index() {

        $data = array(
            'title' => lang('profile')
        );
        $this->nl->view_loader('user', 'payment', NULL, $data, NULL, 'rightbar');
    }

    public function create_customer() {

        define('AUTHORIZENET_LOG_FILE', 'phplog');
        define('MERCHANT_LOGIN_ID', '5FuqU523');
        define('MERCHANT_TRANSACTION_KEY', '4r8346an8uABeQTr');
        define('CREDIT_CARD_NUMBER', '4007000000027');
        define('EXPIRY_DATE', '2038-12');
        $email = 'rejoan@gmail.com';
        //var_dump(MERCHANT_LOGIN_ID);return;

        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(MERCHANT_TRANSACTION_KEY);
        $refId = 'ref' . time();

        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber(CREDIT_CARD_NUMBER);
        $creditCard->setExpirationDate(EXPIRY_DATE);
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);

        // Create the Bill To info
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName("Ellen");
        $billto->setLastName("Johnson");
        $billto->setCompany("Souveniropolis");
        $billto->setAddress("14 Main Street");
        $billto->setCity("Pecan Springs");
        $billto->setState("TX");
        $billto->setZip("44628");
        $billto->setCountry("USA");

        // Create a Customer Profile Request
        //  1. create a Payment Profile
        //  2. create a Customer Profile   
        //  3. Submit a CreateCustomerProfile Request
        //  4. Validate Profiiel ID returned

        $paymentprofile = new AnetAPI\CustomerPaymentProfileType();

        $paymentprofile->setCustomerType('individual');
        $paymentprofile->setBillTo($billto);
        $paymentprofile->setPayment($paymentCreditCard);
        $paymentprofiles[] = $paymentprofile;
        $customerprofile = new AnetAPI\CustomerProfileType();
        $customerprofile->setDescription("Customer 2 Test PHP");

        $customerprofile->setMerchantCustomerId("M_" . $email);
        $customerprofile->setEmail($email);
        $customerprofile->setPaymentProfiles($paymentprofiles);

        $request = new AnetAPI\CreateCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setProfile($customerprofile);
        $controller = new AnetController\CreateCustomerProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            echo "Succesfully create customer profile : " . $response->getCustomerProfileId() . "\n";
            echo "SUCCESS: PAYMENT PROFILE ID : " . $response->getCustomerPaymentProfileIdList()[0] . "\n";
        } else {
            echo "ERROR :  Invalid response\n";
            echo "Response : " . $response->getMessages()->getMessage()[0]->getCode() . "  " . $response->getMessages()->getMessage()[0]->getText() . "\n";
        }
        return $response;
    }

}

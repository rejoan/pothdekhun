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
        $email = 'rejoan.de@gmail.com';
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
        $customerprofile->setDescription("Customer 3 Test PHP");

        $customerprofile->setMerchantCustomerId('46546');
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

    function update_customer($customerProfileId = '39764066', $customerPaymentProfileId = '36070182') {
        // Common setup for API credentials
        define('AUTHORIZENET_LOG_FILE', 'phplog');
        define('MERCHANT_LOGIN_ID', '5FuqU523');
        define('MERCHANT_TRANSACTION_KEY', '4r8346an8uABeQTr');
        define('CREDIT_CARD_NUMBER', '4007000000027');
        define('EXPIRY_DATE', '2038-12');
        //$email = 'rejoan@gmail.com';
        
        
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(MERCHANT_LOGIN_ID);
        $merchantAuthentication->setTransactionKey(MERCHANT_TRANSACTION_KEY);
        $refId = 'ref' . time();
        //Set profile ids of profile to be updated
        $request = new AnetAPI\GetCustomerPaymentProfileRequest();
	$request->setMerchantAuthentication($merchantAuthentication);
	$request->setRefId( $refId);
	$request->setCustomerProfileId($customerProfileId);
	$request->setCustomerPaymentProfileId($customerPaymentProfileId);
	$controller = new AnetController\GetCustomerPaymentProfileController($request);
	$presponse = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
        //echo '<pre>';
        //var_dump($presponse);return;
        // We're updating the billing address but everything has to be passed in an update
        // For card information you can pass exactly what comes back from an GetCustomerPaymentProfile
        // if you don't need to update that info
         //Set profile ids of profile to be updated
	  $request = new AnetAPI\UpdateCustomerPaymentProfileRequest();
	  $request->setMerchantAuthentication($merchantAuthentication);
	  $request->setCustomerProfileId($customerProfileId);
	  $controller = new AnetController\GetCustomerProfileController($request);
        
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($presponse->getPaymentProfile()->getPayment()->getCreditCard()->getCardNumber());
        $creditCard->setExpirationDate($presponse->getPaymentProfile()->getPayment()->getCreditCard()->getExpirationDate());
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);
        // Create the Bill To info for new payment type
        $billto = new AnetAPI\CustomerAddressType();
        $billto->setFirstName("Hellejoan");
        $billto->setLastName("Rejoan");
        $billto->setAddress("Mohammadpur");
        $billto->setCity("Brand New City");
        $billto->setState("WA");
        $billto->setZip("98004");
        $billto->setPhoneNumber("000-000-0000");
        $billto->setfaxNumber("999-999-9999");
        $billto->setCountry("Bangladesh");

        // Create the Customer Payment Profile object
        $paymentprofile = new AnetAPI\CustomerPaymentProfileExType();
        $paymentprofile->setCustomerPaymentProfileId($customerPaymentProfileId);
        $paymentprofile->setBillTo($billto);
        $paymentprofile->setPayment($paymentCreditCard);
        // Submit a UpdatePaymentProfileRequest
        $request->setPaymentProfile($paymentprofile);
        $controller = new AnetController\UpdateCustomerPaymentProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            echo "Update Customer Payment Profile SUCCESS: " . "\n";

            // Update only returns success or fail, if success
            // confirm the update by doing a GetCustomerPaymentProfile
            $getRequest = new AnetAPI\GetCustomerPaymentProfileRequest();
            $getRequest->setMerchantAuthentication($merchantAuthentication);
            $getRequest->setRefId($refId);
            $getRequest->setCustomerProfileId($customerProfileId);
            $getRequest->setCustomerPaymentProfileId($customerPaymentProfileId);
            $controller = new AnetController\GetCustomerPaymentProfileController($getRequest);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
            if (($response != null)) {
                if ($response->getMessages()->getResultCode() == "Ok") {
                    echo "GetCustomerPaymentProfile SUCCESS: " . "\n";
                    echo "Customer Payment Profile Id: " . $response->getPaymentProfile()->getCustomerPaymentProfileId() . "\n";
                    echo "Customer Payment Profile Billing Address: " . $response->getPaymentProfile()->getbillTo()->getAddress() . "\n";
                } else {
                    echo "GetCustomerPaymentProfile ERROR :  Invalid response\n";
                    echo "Response : " . $response->getMessages()->getMessage()[0]->getCode() . "  " . $response->getMessages()->getMessage()[0]->getText() . "\n";
                }
            } else {
                echo "NULL Response Error";
            }
        } else {
            echo "Update Customer Payment Profile: ERROR Invalid response\n";
            echo "Response : " . $response->getMessages()->getMessage()[0]->getCode() . "  " . $response->getMessages()->getMessage()[0]->getText() . "\n";
        }
        return $response;
    }

}

<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class flowbtc extends \ccxt\ndax {
    public function public_get_activate2fa($params = array()) {
        return $this->request('Activate2FA', 'public', 'GET', $params);
    }
    public function public_get_authenticate2fa($params = array()) {
        return $this->request('Authenticate2FA', 'public', 'GET', $params);
    }
    public function public_get_authenticateuser($params = array()) {
        return $this->request('AuthenticateUser', 'public', 'GET', $params);
    }
    public function public_get_getl2snapshot($params = array()) {
        return $this->request('GetL2Snapshot', 'public', 'GET', $params);
    }
    public function public_get_getlevel1($params = array()) {
        return $this->request('GetLevel1', 'public', 'GET', $params);
    }
    public function public_get_getvalidate2farequiredendpoints($params = array()) {
        return $this->request('GetValidate2FARequiredEndpoints', 'public', 'GET', $params);
    }
    public function public_get_logout($params = array()) {
        return $this->request('LogOut', 'public', 'GET', $params);
    }
    public function public_get_gettickerhistory($params = array()) {
        return $this->request('GetTickerHistory', 'public', 'GET', $params);
    }
    public function public_get_getproduct($params = array()) {
        return $this->request('GetProduct', 'public', 'GET', $params);
    }
    public function public_get_getproducts($params = array()) {
        return $this->request('GetProducts', 'public', 'GET', $params);
    }
    public function public_get_getinstrument($params = array()) {
        return $this->request('GetInstrument', 'public', 'GET', $params);
    }
    public function public_get_getinstruments($params = array()) {
        return $this->request('GetInstruments', 'public', 'GET', $params);
    }
    public function public_get_ping($params = array()) {
        return $this->request('Ping', 'public', 'GET', $params);
    }
    public function public_get_trades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params);
    }
    public function public_get_getlasttrades($params = array()) {
        return $this->request('GetLastTrades', 'public', 'GET', $params);
    }
    public function public_get_subscribelevel1($params = array()) {
        return $this->request('SubscribeLevel1', 'public', 'GET', $params);
    }
    public function public_get_subscribelevel2($params = array()) {
        return $this->request('SubscribeLevel2', 'public', 'GET', $params);
    }
    public function public_get_subscribeticker($params = array()) {
        return $this->request('SubscribeTicker', 'public', 'GET', $params);
    }
    public function public_get_subscribetrades($params = array()) {
        return $this->request('SubscribeTrades', 'public', 'GET', $params);
    }
    public function public_get_subscribeblocktrades($params = array()) {
        return $this->request('SubscribeBlockTrades', 'public', 'GET', $params);
    }
    public function public_get_unsubscribeblocktrades($params = array()) {
        return $this->request('UnsubscribeBlockTrades', 'public', 'GET', $params);
    }
    public function public_get_unsubscribelevel1($params = array()) {
        return $this->request('UnsubscribeLevel1', 'public', 'GET', $params);
    }
    public function public_get_unsubscribelevel2($params = array()) {
        return $this->request('UnsubscribeLevel2', 'public', 'GET', $params);
    }
    public function public_get_unsubscribeticker($params = array()) {
        return $this->request('UnsubscribeTicker', 'public', 'GET', $params);
    }
    public function public_get_unsubscribetrades($params = array()) {
        return $this->request('UnsubscribeTrades', 'public', 'GET', $params);
    }
    public function public_get_authenticate($params = array()) {
        return $this->request('Authenticate', 'public', 'GET', $params);
    }
    public function private_get_getuseraccountinfos($params = array()) {
        return $this->request('GetUserAccountInfos', 'private', 'GET', $params);
    }
    public function private_get_getuseraccounts($params = array()) {
        return $this->request('GetUserAccounts', 'private', 'GET', $params);
    }
    public function private_get_getuseraffiliatecount($params = array()) {
        return $this->request('GetUserAffiliateCount', 'private', 'GET', $params);
    }
    public function private_get_getuseraffiliatetag($params = array()) {
        return $this->request('GetUserAffiliateTag', 'private', 'GET', $params);
    }
    public function private_get_getuserconfig($params = array()) {
        return $this->request('GetUserConfig', 'private', 'GET', $params);
    }
    public function private_get_getallunredacteduserconfigsforuser($params = array()) {
        return $this->request('GetAllUnredactedUserConfigsForUser', 'private', 'GET', $params);
    }
    public function private_get_getunredacteduserconfigbykey($params = array()) {
        return $this->request('GetUnredactedUserConfigByKey', 'private', 'GET', $params);
    }
    public function private_get_getuserdevices($params = array()) {
        return $this->request('GetUserDevices', 'private', 'GET', $params);
    }
    public function private_get_getuserreporttickets($params = array()) {
        return $this->request('GetUserReportTickets', 'private', 'GET', $params);
    }
    public function private_get_getuserreportwriterresultrecords($params = array()) {
        return $this->request('GetUserReportWriterResultRecords', 'private', 'GET', $params);
    }
    public function private_get_getaccountinfo($params = array()) {
        return $this->request('GetAccountInfo', 'private', 'GET', $params);
    }
    public function private_get_getaccountpositions($params = array()) {
        return $this->request('GetAccountPositions', 'private', 'GET', $params);
    }
    public function private_get_getallaccountconfigs($params = array()) {
        return $this->request('GetAllAccountConfigs', 'private', 'GET', $params);
    }
    public function private_get_gettreasuryproductsforaccount($params = array()) {
        return $this->request('GetTreasuryProductsForAccount', 'private', 'GET', $params);
    }
    public function private_get_getaccounttrades($params = array()) {
        return $this->request('GetAccountTrades', 'private', 'GET', $params);
    }
    public function private_get_getaccounttransactions($params = array()) {
        return $this->request('GetAccountTransactions', 'private', 'GET', $params);
    }
    public function private_get_getopentradereports($params = array()) {
        return $this->request('GetOpenTradeReports', 'private', 'GET', $params);
    }
    public function private_get_getallopentradereports($params = array()) {
        return $this->request('GetAllOpenTradeReports', 'private', 'GET', $params);
    }
    public function private_get_gettradeshistory($params = array()) {
        return $this->request('GetTradesHistory', 'private', 'GET', $params);
    }
    public function private_get_getopenorders($params = array()) {
        return $this->request('GetOpenOrders', 'private', 'GET', $params);
    }
    public function private_get_getopenquotes($params = array()) {
        return $this->request('GetOpenQuotes', 'private', 'GET', $params);
    }
    public function private_get_getorderfee($params = array()) {
        return $this->request('GetOrderFee', 'private', 'GET', $params);
    }
    public function private_get_getorderhistory($params = array()) {
        return $this->request('GetOrderHistory', 'private', 'GET', $params);
    }
    public function private_get_getordershistory($params = array()) {
        return $this->request('GetOrdersHistory', 'private', 'GET', $params);
    }
    public function private_get_getorderstatus($params = array()) {
        return $this->request('GetOrderStatus', 'private', 'GET', $params);
    }
    public function private_get_getomsfeetiers($params = array()) {
        return $this->request('GetOmsFeeTiers', 'private', 'GET', $params);
    }
    public function private_get_getaccountdeposittransactions($params = array()) {
        return $this->request('GetAccountDepositTransactions', 'private', 'GET', $params);
    }
    public function private_get_getaccountwithdrawtransactions($params = array()) {
        return $this->request('GetAccountWithdrawTransactions', 'private', 'GET', $params);
    }
    public function private_get_getalldepositrequestinfotemplates($params = array()) {
        return $this->request('GetAllDepositRequestInfoTemplates', 'private', 'GET', $params);
    }
    public function private_get_getdepositinfo($params = array()) {
        return $this->request('GetDepositInfo', 'private', 'GET', $params);
    }
    public function private_get_getdepositrequestinfotemplate($params = array()) {
        return $this->request('GetDepositRequestInfoTemplate', 'private', 'GET', $params);
    }
    public function private_get_getdeposits($params = array()) {
        return $this->request('GetDeposits', 'private', 'GET', $params);
    }
    public function private_get_getdepositticket($params = array()) {
        return $this->request('GetDepositTicket', 'private', 'GET', $params);
    }
    public function private_get_getdeposittickets($params = array()) {
        return $this->request('GetDepositTickets', 'private', 'GET', $params);
    }
    public function private_get_getomswithdrawfees($params = array()) {
        return $this->request('GetOMSWithdrawFees', 'private', 'GET', $params);
    }
    public function private_get_getwithdrawfee($params = array()) {
        return $this->request('GetWithdrawFee', 'private', 'GET', $params);
    }
    public function private_get_getwithdraws($params = array()) {
        return $this->request('GetWithdraws', 'private', 'GET', $params);
    }
    public function private_get_getwithdrawtemplate($params = array()) {
        return $this->request('GetWithdrawTemplate', 'private', 'GET', $params);
    }
    public function private_get_getwithdrawtemplatetypes($params = array()) {
        return $this->request('GetWithdrawTemplateTypes', 'private', 'GET', $params);
    }
    public function private_get_getwithdrawticket($params = array()) {
        return $this->request('GetWithdrawTicket', 'private', 'GET', $params);
    }
    public function private_get_getwithdrawtickets($params = array()) {
        return $this->request('GetWithdrawTickets', 'private', 'GET', $params);
    }
    public function private_post_adduseraffiliatetag($params = array()) {
        return $this->request('AddUserAffiliateTag', 'private', 'POST', $params);
    }
    public function private_post_canceluserreport($params = array()) {
        return $this->request('CancelUserReport', 'private', 'POST', $params);
    }
    public function private_post_registernewdevice($params = array()) {
        return $this->request('RegisterNewDevice', 'private', 'POST', $params);
    }
    public function private_post_subscribeaccountevents($params = array()) {
        return $this->request('SubscribeAccountEvents', 'private', 'POST', $params);
    }
    public function private_post_updateuseraffiliatetag($params = array()) {
        return $this->request('UpdateUserAffiliateTag', 'private', 'POST', $params);
    }
    public function private_post_generatetradeactivityreport($params = array()) {
        return $this->request('GenerateTradeActivityReport', 'private', 'POST', $params);
    }
    public function private_post_generatetransactionactivityreport($params = array()) {
        return $this->request('GenerateTransactionActivityReport', 'private', 'POST', $params);
    }
    public function private_post_generatetreasuryactivityreport($params = array()) {
        return $this->request('GenerateTreasuryActivityReport', 'private', 'POST', $params);
    }
    public function private_post_scheduletradeactivityreport($params = array()) {
        return $this->request('ScheduleTradeActivityReport', 'private', 'POST', $params);
    }
    public function private_post_scheduletransactionactivityreport($params = array()) {
        return $this->request('ScheduleTransactionActivityReport', 'private', 'POST', $params);
    }
    public function private_post_scheduletreasuryactivityreport($params = array()) {
        return $this->request('ScheduleTreasuryActivityReport', 'private', 'POST', $params);
    }
    public function private_post_cancelallorders($params = array()) {
        return $this->request('CancelAllOrders', 'private', 'POST', $params);
    }
    public function private_post_cancelorder($params = array()) {
        return $this->request('CancelOrder', 'private', 'POST', $params);
    }
    public function private_post_cancelquote($params = array()) {
        return $this->request('CancelQuote', 'private', 'POST', $params);
    }
    public function private_post_cancelreplaceorder($params = array()) {
        return $this->request('CancelReplaceOrder', 'private', 'POST', $params);
    }
    public function private_post_createquote($params = array()) {
        return $this->request('CreateQuote', 'private', 'POST', $params);
    }
    public function private_post_modifyorder($params = array()) {
        return $this->request('ModifyOrder', 'private', 'POST', $params);
    }
    public function private_post_sendorder($params = array()) {
        return $this->request('SendOrder', 'private', 'POST', $params);
    }
    public function private_post_submitblocktrade($params = array()) {
        return $this->request('SubmitBlockTrade', 'private', 'POST', $params);
    }
    public function private_post_updatequote($params = array()) {
        return $this->request('UpdateQuote', 'private', 'POST', $params);
    }
    public function private_post_cancelwithdraw($params = array()) {
        return $this->request('CancelWithdraw', 'private', 'POST', $params);
    }
    public function private_post_createdepositticket($params = array()) {
        return $this->request('CreateDepositTicket', 'private', 'POST', $params);
    }
    public function private_post_createwithdrawticket($params = array()) {
        return $this->request('CreateWithdrawTicket', 'private', 'POST', $params);
    }
    public function private_post_submitdepositticketcomment($params = array()) {
        return $this->request('SubmitDepositTicketComment', 'private', 'POST', $params);
    }
    public function private_post_submitwithdrawticketcomment($params = array()) {
        return $this->request('SubmitWithdrawTicketComment', 'private', 'POST', $params);
    }
    public function private_post_getorderhistorybyorderid($params = array()) {
        return $this->request('GetOrderHistoryByOrderId', 'private', 'POST', $params);
    }
}
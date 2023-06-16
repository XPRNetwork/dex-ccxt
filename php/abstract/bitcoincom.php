<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class bitcoincom extends \ccxt\fmfwio {
    public function public_get_currency($params = array()) {
        return $this->request('currency', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_currency_currency($params = array()) {
        return $this->request('currency/{currency}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_symbol($params = array()) {
        return $this->request('symbol', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_symbol_symbol($params = array()) {
        return $this->request('symbol/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_ticker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_ticker_symbol($params = array()) {
        return $this->request('ticker/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_trades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_trades_symbol($params = array()) {
        return $this->request('trades/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_orderbook($params = array()) {
        return $this->request('orderbook', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_orderbook_symbol($params = array()) {
        return $this->request('orderbook/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_candles($params = array()) {
        return $this->request('candles', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function public_get_candles_symbol($params = array()) {
        return $this->request('candles/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function private_get_trading_balance($params = array()) {
        return $this->request('trading/balance', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_order($params = array()) {
        return $this->request('order', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_order_clientorderid($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_trading_fee_all($params = array()) {
        return $this->request('trading/fee/all', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_trading_fee_symbol($params = array()) {
        return $this->request('trading/fee/{symbol}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_margin_account($params = array()) {
        return $this->request('margin/account', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_margin_account_symbol($params = array()) {
        return $this->request('margin/account/{symbol}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_margin_position($params = array()) {
        return $this->request('margin/position', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_margin_position_symbol($params = array()) {
        return $this->request('margin/position/{symbol}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_margin_order($params = array()) {
        return $this->request('margin/order', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_margin_order_clientorderid($params = array()) {
        return $this->request('margin/order/{clientOrderId}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_history_order($params = array()) {
        return $this->request('history/order', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_history_trades($params = array()) {
        return $this->request('history/trades', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_history_order_orderid_trades($params = array()) {
        return $this->request('history/order/{orderId}/trades', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_balance($params = array()) {
        return $this->request('account/balance', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_crypto_address_currency($params = array()) {
        return $this->request('account/crypto/address/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_crypto_addresses_currency($params = array()) {
        return $this->request('account/crypto/addresses/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_crypto_used_addresses_currency($params = array()) {
        return $this->request('account/crypto/used-addresses/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_crypto_estimate_withdraw($params = array()) {
        return $this->request('account/crypto/estimate-withdraw', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_crypto_is_mine_address($params = array()) {
        return $this->request('account/crypto/is-mine/{address}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_transactions($params = array()) {
        return $this->request('account/transactions', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_account_transactions_id($params = array()) {
        return $this->request('account/transactions/{id}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_sub_acc($params = array()) {
        return $this->request('sub-acc', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_sub_acc_acl($params = array()) {
        return $this->request('sub-acc/acl', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_sub_acc_balance_subaccountuserid($params = array()) {
        return $this->request('sub-acc/balance/{subAccountUserID}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_get_sub_acc_deposit_address_subaccountuserid_currency($params = array()) {
        return $this->request('sub-acc/deposit-address/{subAccountUserId}/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function private_post_order($params = array()) {
        return $this->request('order', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_margin_order($params = array()) {
        return $this->request('margin/order', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_account_crypto_address_currency($params = array()) {
        return $this->request('account/crypto/address/{currency}', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_account_crypto_withdraw($params = array()) {
        return $this->request('account/crypto/withdraw', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_account_crypto_transfer_convert($params = array()) {
        return $this->request('account/crypto/transfer-convert', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_account_transfer($params = array()) {
        return $this->request('account/transfer', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_account_transfer_internal($params = array()) {
        return $this->request('account/transfer/internal', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_sub_acc_freeze($params = array()) {
        return $this->request('sub-acc/freeze', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_sub_acc_activate($params = array()) {
        return $this->request('sub-acc/activate', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_sub_acc_transfer($params = array()) {
        return $this->request('sub-acc/transfer', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_put_order_clientorderid($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function private_put_margin_account_symbol($params = array()) {
        return $this->request('margin/account/{symbol}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function private_put_margin_order_clientorderid($params = array()) {
        return $this->request('margin/order/{clientOrderId}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function private_put_account_crypto_withdraw_id($params = array()) {
        return $this->request('account/crypto/withdraw/{id}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function private_put_sub_acc_acl_subaccountuserid($params = array()) {
        return $this->request('sub-acc/acl/{subAccountUserId}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function private_delete_order($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_order_clientorderid($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_margin_account($params = array()) {
        return $this->request('margin/account', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_margin_account_symbol($params = array()) {
        return $this->request('margin/account/{symbol}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_margin_position($params = array()) {
        return $this->request('margin/position', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_margin_position_symbol($params = array()) {
        return $this->request('margin/position/{symbol}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_margin_order($params = array()) {
        return $this->request('margin/order', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_margin_order_clientorderid($params = array()) {
        return $this->request('margin/order/{clientOrderId}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_delete_account_crypto_withdraw_id($params = array()) {
        return $this->request('account/crypto/withdraw/{id}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function private_patch_order_clientorderid($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'PATCH', $params, null, null, array("cost" => 1));
    }
    public function publicGetCurrency($params = array()) {
        return $this->request('currency', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetCurrencyCurrency($params = array()) {
        return $this->request('currency/{currency}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetSymbol($params = array()) {
        return $this->request('symbol', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetSymbolSymbol($params = array()) {
        return $this->request('symbol/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetTicker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetTickerSymbol($params = array()) {
        return $this->request('ticker/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetTrades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetTradesSymbol($params = array()) {
        return $this->request('trades/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetOrderbook($params = array()) {
        return $this->request('orderbook', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetOrderbookSymbol($params = array()) {
        return $this->request('orderbook/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetCandles($params = array()) {
        return $this->request('candles', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function publicGetCandlesSymbol($params = array()) {
        return $this->request('candles/{symbol}', 'public', 'GET', $params, null, null, array("cost" => 3));
    }
    public function privateGetTradingBalance($params = array()) {
        return $this->request('trading/balance', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetOrder($params = array()) {
        return $this->request('order', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetOrderClientOrderId($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetTradingFeeAll($params = array()) {
        return $this->request('trading/fee/all', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetTradingFeeSymbol($params = array()) {
        return $this->request('trading/fee/{symbol}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetMarginAccount($params = array()) {
        return $this->request('margin/account', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetMarginAccountSymbol($params = array()) {
        return $this->request('margin/account/{symbol}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetMarginPosition($params = array()) {
        return $this->request('margin/position', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetMarginPositionSymbol($params = array()) {
        return $this->request('margin/position/{symbol}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetMarginOrder($params = array()) {
        return $this->request('margin/order', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetMarginOrderClientOrderId($params = array()) {
        return $this->request('margin/order/{clientOrderId}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetHistoryOrder($params = array()) {
        return $this->request('history/order', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetHistoryTrades($params = array()) {
        return $this->request('history/trades', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetHistoryOrderOrderIdTrades($params = array()) {
        return $this->request('history/order/{orderId}/trades', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountBalance($params = array()) {
        return $this->request('account/balance', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountCryptoAddressCurrency($params = array()) {
        return $this->request('account/crypto/address/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountCryptoAddressesCurrency($params = array()) {
        return $this->request('account/crypto/addresses/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountCryptoUsedAddressesCurrency($params = array()) {
        return $this->request('account/crypto/used-addresses/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountCryptoEstimateWithdraw($params = array()) {
        return $this->request('account/crypto/estimate-withdraw', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountCryptoIsMineAddress($params = array()) {
        return $this->request('account/crypto/is-mine/{address}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountTransactions($params = array()) {
        return $this->request('account/transactions', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetAccountTransactionsId($params = array()) {
        return $this->request('account/transactions/{id}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetSubAcc($params = array()) {
        return $this->request('sub-acc', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetSubAccAcl($params = array()) {
        return $this->request('sub-acc/acl', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetSubAccBalanceSubAccountUserID($params = array()) {
        return $this->request('sub-acc/balance/{subAccountUserID}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privateGetSubAccDepositAddressSubAccountUserIdCurrency($params = array()) {
        return $this->request('sub-acc/deposit-address/{subAccountUserId}/{currency}', 'private', 'GET', $params, null, null, array("cost" => 15.0015));
    }
    public function privatePostOrder($params = array()) {
        return $this->request('order', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostMarginOrder($params = array()) {
        return $this->request('margin/order', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostAccountCryptoAddressCurrency($params = array()) {
        return $this->request('account/crypto/address/{currency}', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostAccountCryptoWithdraw($params = array()) {
        return $this->request('account/crypto/withdraw', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostAccountCryptoTransferConvert($params = array()) {
        return $this->request('account/crypto/transfer-convert', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostAccountTransfer($params = array()) {
        return $this->request('account/transfer', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostAccountTransferInternal($params = array()) {
        return $this->request('account/transfer/internal', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostSubAccFreeze($params = array()) {
        return $this->request('sub-acc/freeze', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostSubAccActivate($params = array()) {
        return $this->request('sub-acc/activate', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostSubAccTransfer($params = array()) {
        return $this->request('sub-acc/transfer', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePutOrderClientOrderId($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function privatePutMarginAccountSymbol($params = array()) {
        return $this->request('margin/account/{symbol}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function privatePutMarginOrderClientOrderId($params = array()) {
        return $this->request('margin/order/{clientOrderId}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function privatePutAccountCryptoWithdrawId($params = array()) {
        return $this->request('account/crypto/withdraw/{id}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function privatePutSubAccAclSubAccountUserId($params = array()) {
        return $this->request('sub-acc/acl/{subAccountUserId}', 'private', 'PUT', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteOrder($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteOrderClientOrderId($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteMarginAccount($params = array()) {
        return $this->request('margin/account', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteMarginAccountSymbol($params = array()) {
        return $this->request('margin/account/{symbol}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteMarginPosition($params = array()) {
        return $this->request('margin/position', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteMarginPositionSymbol($params = array()) {
        return $this->request('margin/position/{symbol}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteMarginOrder($params = array()) {
        return $this->request('margin/order', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteMarginOrderClientOrderId($params = array()) {
        return $this->request('margin/order/{clientOrderId}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteAccountCryptoWithdrawId($params = array()) {
        return $this->request('account/crypto/withdraw/{id}', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function privatePatchOrderClientOrderId($params = array()) {
        return $this->request('order/{clientOrderId}', 'private', 'PATCH', $params, null, null, array("cost" => 1));
    }
}

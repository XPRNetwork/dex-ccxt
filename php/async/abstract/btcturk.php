<?php

namespace ccxt\async\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class btcturk extends \ccxt\async\Exchange {
    public function public_get_orderbook($params = array()) {
        return $this->request('orderbook', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_ticker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params, null, null, array("cost" => 0.1));
    }
    public function public_get_trades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function public_get_server_exchangeinfo($params = array()) {
        return $this->request('server/exchangeinfo', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function private_get_users_balances($params = array()) {
        return $this->request('users/balances', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function private_get_openorders($params = array()) {
        return $this->request('openOrders', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function private_get_allorders($params = array()) {
        return $this->request('allOrders', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function private_get_users_transactions_trade($params = array()) {
        return $this->request('users/transactions/trade', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function private_post_order($params = array()) {
        return $this->request('order', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_post_cancelorder($params = array()) {
        return $this->request('cancelOrder', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function private_delete_order($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function graph_get_ohlcs($params = array()) {
        return $this->request('ohlcs', 'graph', 'GET', $params, null, null, array("cost" => 1));
    }
    public function graph_get_klines_history($params = array()) {
        return $this->request('klines/history', 'graph', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetOrderbook($params = array()) {
        return $this->request('orderbook', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetTicker($params = array()) {
        return $this->request('ticker', 'public', 'GET', $params, null, null, array("cost" => 0.1));
    }
    public function publicGetTrades($params = array()) {
        return $this->request('trades', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function publicGetServerExchangeinfo($params = array()) {
        return $this->request('server/exchangeinfo', 'public', 'GET', $params, null, null, array("cost" => 1));
    }
    public function privateGetUsersBalances($params = array()) {
        return $this->request('users/balances', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function privateGetOpenOrders($params = array()) {
        return $this->request('openOrders', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function privateGetAllOrders($params = array()) {
        return $this->request('allOrders', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function privateGetUsersTransactionsTrade($params = array()) {
        return $this->request('users/transactions/trade', 'private', 'GET', $params, null, null, array("cost" => 1));
    }
    public function privatePostOrder($params = array()) {
        return $this->request('order', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privatePostCancelOrder($params = array()) {
        return $this->request('cancelOrder', 'private', 'POST', $params, null, null, array("cost" => 1));
    }
    public function privateDeleteOrder($params = array()) {
        return $this->request('order', 'private', 'DELETE', $params, null, null, array("cost" => 1));
    }
    public function graphGetOhlcs($params = array()) {
        return $this->request('ohlcs', 'graph', 'GET', $params, null, null, array("cost" => 1));
    }
    public function graphGetKlinesHistory($params = array()) {
        return $this->request('klines/history', 'graph', 'GET', $params, null, null, array("cost" => 1));
    }
}

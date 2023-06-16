<?php

namespace ccxt\abstract;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code


abstract class delta extends \ccxt\Exchange {
    public function public_get_assets($params = array()) {
        return $this->request('assets', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_settings($params = array()) {
        return $this->request('settings', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_indices($params = array()) {
        return $this->request('indices', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_products($params = array()) {
        return $this->request('products', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_tickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_tickers_symbol($params = array()) {
        return $this->request('tickers/{symbol}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_l2orderbook_symbol($params = array()) {
        return $this->request('l2orderbook/{symbol}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_trades_symbol($params = array()) {
        return $this->request('trades/{symbol}', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_history_candles($params = array()) {
        return $this->request('history/candles', 'public', 'GET', $params, null, null, array());
    }
    public function public_get_history_sparklines($params = array()) {
        return $this->request('history/sparklines', 'public', 'GET', $params, null, null, array());
    }
    public function private_get_orders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_orders_leverage($params = array()) {
        return $this->request('orders/leverage', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_positions($params = array()) {
        return $this->request('positions', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_positions_margined($params = array()) {
        return $this->request('positions/margined', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_orders_history($params = array()) {
        return $this->request('orders/history', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_fills($params = array()) {
        return $this->request('fills', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_fills_history_download_csv($params = array()) {
        return $this->request('fills/history/download/csv', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_wallet_balances($params = array()) {
        return $this->request('wallet/balances', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_wallet_transactions($params = array()) {
        return $this->request('wallet/transactions', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_wallet_transactions_download($params = array()) {
        return $this->request('wallet/transactions/download', 'private', 'GET', $params, null, null, array());
    }
    public function private_get_deposits_address($params = array()) {
        return $this->request('deposits/address', 'private', 'GET', $params, null, null, array());
    }
    public function private_post_orders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_orders_batch($params = array()) {
        return $this->request('orders/batch', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_orders_leverage($params = array()) {
        return $this->request('orders/leverage', 'private', 'POST', $params, null, null, array());
    }
    public function private_post_positions_change_margin($params = array()) {
        return $this->request('positions/change_margin', 'private', 'POST', $params, null, null, array());
    }
    public function private_put_orders($params = array()) {
        return $this->request('orders', 'private', 'PUT', $params, null, null, array());
    }
    public function private_put_orders_batch($params = array()) {
        return $this->request('orders/batch', 'private', 'PUT', $params, null, null, array());
    }
    public function private_delete_orders($params = array()) {
        return $this->request('orders', 'private', 'DELETE', $params, null, null, array());
    }
    public function private_delete_orders_all($params = array()) {
        return $this->request('orders/all', 'private', 'DELETE', $params, null, null, array());
    }
    public function private_delete_orders_batch($params = array()) {
        return $this->request('orders/batch', 'private', 'DELETE', $params, null, null, array());
    }
    public function publicGetAssets($params = array()) {
        return $this->request('assets', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetSettings($params = array()) {
        return $this->request('settings', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetIndices($params = array()) {
        return $this->request('indices', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetProducts($params = array()) {
        return $this->request('products', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTickers($params = array()) {
        return $this->request('tickers', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTickersSymbol($params = array()) {
        return $this->request('tickers/{symbol}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetL2orderbookSymbol($params = array()) {
        return $this->request('l2orderbook/{symbol}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetTradesSymbol($params = array()) {
        return $this->request('trades/{symbol}', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetHistoryCandles($params = array()) {
        return $this->request('history/candles', 'public', 'GET', $params, null, null, array());
    }
    public function publicGetHistorySparklines($params = array()) {
        return $this->request('history/sparklines', 'public', 'GET', $params, null, null, array());
    }
    public function privateGetOrders($params = array()) {
        return $this->request('orders', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetOrdersLeverage($params = array()) {
        return $this->request('orders/leverage', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetPositions($params = array()) {
        return $this->request('positions', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetPositionsMargined($params = array()) {
        return $this->request('positions/margined', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetOrdersHistory($params = array()) {
        return $this->request('orders/history', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetFills($params = array()) {
        return $this->request('fills', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetFillsHistoryDownloadCsv($params = array()) {
        return $this->request('fills/history/download/csv', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetWalletBalances($params = array()) {
        return $this->request('wallet/balances', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetWalletTransactions($params = array()) {
        return $this->request('wallet/transactions', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetWalletTransactionsDownload($params = array()) {
        return $this->request('wallet/transactions/download', 'private', 'GET', $params, null, null, array());
    }
    public function privateGetDepositsAddress($params = array()) {
        return $this->request('deposits/address', 'private', 'GET', $params, null, null, array());
    }
    public function privatePostOrders($params = array()) {
        return $this->request('orders', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostOrdersBatch($params = array()) {
        return $this->request('orders/batch', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostOrdersLeverage($params = array()) {
        return $this->request('orders/leverage', 'private', 'POST', $params, null, null, array());
    }
    public function privatePostPositionsChangeMargin($params = array()) {
        return $this->request('positions/change_margin', 'private', 'POST', $params, null, null, array());
    }
    public function privatePutOrders($params = array()) {
        return $this->request('orders', 'private', 'PUT', $params, null, null, array());
    }
    public function privatePutOrdersBatch($params = array()) {
        return $this->request('orders/batch', 'private', 'PUT', $params, null, null, array());
    }
    public function privateDeleteOrders($params = array()) {
        return $this->request('orders', 'private', 'DELETE', $params, null, null, array());
    }
    public function privateDeleteOrdersAll($params = array()) {
        return $this->request('orders/all', 'private', 'DELETE', $params, null, null, array());
    }
    public function privateDeleteOrdersBatch($params = array()) {
        return $this->request('orders/batch', 'private', 'DELETE', $params, null, null, array());
    }
}

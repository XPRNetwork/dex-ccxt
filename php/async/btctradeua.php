<?php

namespace ccxt\async;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use \ccxt\ExchangeError;
use \ccxt\ArgumentsRequired;
use \ccxt\Precise;

class btctradeua extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'id' => 'btctradeua',
            'name' => 'BTC Trade UA',
            'countries' => array( 'UA' ), // Ukraine,
            'rateLimit' => 3000,
            'has' => array(
                'CORS' => null,
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'addMargin' => false,
                'cancelOrder' => true,
                'createMarketOrder' => null,
                'createOrder' => true,
                'createReduceOnlyOrder' => false,
                'fetchBalance' => true,
                'fetchBorrowRate' => false,
                'fetchBorrowRateHistories' => false,
                'fetchBorrowRateHistory' => false,
                'fetchBorrowRates' => false,
                'fetchBorrowRatesPerSymbol' => false,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchLeverage' => false,
                'fetchMarginMode' => false,
                'fetchMarkOHLCV' => false,
                'fetchOpenInterestHistory' => false,
                'fetchOpenOrders' => true,
                'fetchOrderBook' => true,
                'fetchPosition' => false,
                'fetchPositionMode' => false,
                'fetchPositions' => false,
                'fetchPositionsRisk' => false,
                'fetchPremiumIndexOHLCV' => false,
                'fetchTicker' => true,
                'fetchTrades' => true,
                'fetchTradingFee' => false,
                'fetchTradingFees' => false,
                'reduceMargin' => false,
                'setLeverage' => false,
                'setMarginMode' => false,
                'setPositionMode' => false,
                'signIn' => true,
            ),
            'urls' => array(
                'referral' => 'https://btc-trade.com.ua/registration/22689',
                'logo' => 'https://user-images.githubusercontent.com/1294454/27941483-79fc7350-62d9-11e7-9f61-ac47f28fcd96.jpg',
                'api' => 'https://btc-trade.com.ua/api',
                'www' => 'https://btc-trade.com.ua',
                'doc' => 'https://docs.google.com/document/d/1ocYA0yMy_RXd561sfG3qEPZ80kyll36HUxvCRe5GbhE/edit',
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'deals/{symbol}',
                        'trades/sell/{symbol}',
                        'trades/buy/{symbol}',
                        'japan_stat/high/{symbol}',
                    ),
                ),
                'private' => array(
                    'post' => array(
                        'auth',
                        'ask/{symbol}',
                        'balance',
                        'bid/{symbol}',
                        'buy/{symbol}',
                        'my_orders/{symbol}',
                        'order/status/{id}',
                        'remove/order/{id}',
                        'sell/{symbol}',
                    ),
                ),
            ),
            'precisionMode' => TICK_SIZE,
            'markets' => array(
                'BCH/UAH' => array( 'id' => 'bch_uah', 'symbol' => 'BCH/UAH', 'base' => 'BCH', 'quote' => 'UAH', 'baseId' => 'bch', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'BTC/UAH' => array( 'id' => 'btc_uah', 'symbol' => 'BTC/UAH', 'base' => 'BTC', 'quote' => 'UAH', 'baseId' => 'btc', 'quoteId' => 'uah', 'precision' => array( 'price' => $this->parse_number('0.1') ), 'limits' => array( 'amount' => array( 'min' => $this->parse_number('0.0000000001') )), 'type' => 'spot', 'spot' => true ),
                'DASH/BTC' => array( 'id' => 'dash_btc', 'symbol' => 'DASH/BTC', 'base' => 'DASH', 'quote' => 'BTC', 'baseId' => 'dash', 'quoteId' => 'btc', 'type' => 'spot', 'spot' => true ),
                'DASH/UAH' => array( 'id' => 'dash_uah', 'symbol' => 'DASH/UAH', 'base' => 'DASH', 'quote' => 'UAH', 'baseId' => 'dash', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'DOGE/BTC' => array( 'id' => 'doge_btc', 'symbol' => 'DOGE/BTC', 'base' => 'DOGE', 'quote' => 'BTC', 'baseId' => 'doge', 'quoteId' => 'btc', 'type' => 'spot', 'spot' => true ),
                'DOGE/UAH' => array( 'id' => 'doge_uah', 'symbol' => 'DOGE/UAH', 'base' => 'DOGE', 'quote' => 'UAH', 'baseId' => 'doge', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'ETH/UAH' => array( 'id' => 'eth_uah', 'symbol' => 'ETH/UAH', 'base' => 'ETH', 'quote' => 'UAH', 'baseId' => 'eth', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'ITI/UAH' => array( 'id' => 'iti_uah', 'symbol' => 'ITI/UAH', 'base' => 'ITI', 'quote' => 'UAH', 'baseId' => 'iti', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'KRB/UAH' => array( 'id' => 'krb_uah', 'symbol' => 'KRB/UAH', 'base' => 'KRB', 'quote' => 'UAH', 'baseId' => 'krb', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'LTC/BTC' => array( 'id' => 'ltc_btc', 'symbol' => 'LTC/BTC', 'base' => 'LTC', 'quote' => 'BTC', 'baseId' => 'ltc', 'quoteId' => 'btc', 'type' => 'spot', 'spot' => true ),
                'LTC/UAH' => array( 'id' => 'ltc_uah', 'symbol' => 'LTC/UAH', 'base' => 'LTC', 'quote' => 'UAH', 'baseId' => 'ltc', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'NVC/BTC' => array( 'id' => 'nvc_btc', 'symbol' => 'NVC/BTC', 'base' => 'NVC', 'quote' => 'BTC', 'baseId' => 'nvc', 'quoteId' => 'btc', 'type' => 'spot', 'spot' => true ),
                'NVC/UAH' => array( 'id' => 'nvc_uah', 'symbol' => 'NVC/UAH', 'base' => 'NVC', 'quote' => 'UAH', 'baseId' => 'nvc', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'PPC/BTC' => array( 'id' => 'ppc_btc', 'symbol' => 'PPC/BTC', 'base' => 'PPC', 'quote' => 'BTC', 'baseId' => 'ppc', 'quoteId' => 'btc', 'type' => 'spot', 'spot' => true ),
                'SIB/UAH' => array( 'id' => 'sib_uah', 'symbol' => 'SIB/UAH', 'base' => 'SIB', 'quote' => 'UAH', 'baseId' => 'sib', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'XMR/UAH' => array( 'id' => 'xmr_uah', 'symbol' => 'XMR/UAH', 'base' => 'XMR', 'quote' => 'UAH', 'baseId' => 'xmr', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
                'ZEC/UAH' => array( 'id' => 'zec_uah', 'symbol' => 'ZEC/UAH', 'base' => 'ZEC', 'quote' => 'UAH', 'baseId' => 'zec', 'quoteId' => 'uah', 'type' => 'spot', 'spot' => true ),
            ),
            'fees' => array(
                'trading' => array(
                    'maker' => 0.1 / 100,
                    'taker' => 0.1 / 100,
                ),
                'funding' => array(
                    'withdraw' => array(
                        'BTC' => 0.0006,
                        'LTC' => 0.01,
                        'NVC' => 0.01,
                        'DOGE' => 10,
                    ),
                ),
            ),
        ));
    }

    public function sign_in($params = array ()) {
        /**
         * sign in, must be called prior to using other authenticated methods
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return response from exchange
         */
        return yield $this->privatePostAuth ($params);
    }

    public function parse_balance($response) {
        $result = array( 'info' => $response );
        $balances = $this->safe_value($response, 'accounts', array());
        for ($i = 0; $i < count($balances); $i++) {
            $balance = $balances[$i];
            $currencyId = $this->safe_string($balance, 'currency');
            $code = $this->safe_currency_code($currencyId);
            $account = $this->account();
            $account['total'] = $this->safe_string($balance, 'balance');
            $result[$code] = $account;
        }
        return $this->safe_balance($result);
    }

    public function fetch_balance($params = array ()) {
        /**
         * query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {dict} a ~@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure balance structure~
         */
        yield $this->load_markets();
        $response = yield $this->privatePostBalance ($params);
        return $this->parse_balance($response);
    }

    public function fetch_order_book($symbol, $limit = null, $params = array ()) {
        /**
         * fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {str} $symbol unified $symbol of the $market to fetch the order book for
         * @param {int|null} $limit the maximum amount of order book entries to return
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {dict} A dictionary of {@link https://docs.ccxt.com/en/latest/manual.html#order-book-structure order book structures} indexed by $market symbols
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $bids = yield $this->publicGetTradesBuySymbol (array_merge($request, $params));
        $asks = yield $this->publicGetTradesSellSymbol (array_merge($request, $params));
        $orderbook = array(
            'bids' => array(),
            'asks' => array(),
        );
        if ($bids) {
            if (is_array($bids) && array_key_exists('list', $bids)) {
                $orderbook['bids'] = $bids['list'];
            }
        }
        if ($asks) {
            if (is_array($asks) && array_key_exists('list', $asks)) {
                $orderbook['asks'] = $asks['list'];
            }
        }
        return $this->parse_order_book($orderbook, $symbol, null, 'bids', 'asks', 'price', 'currency_trade');
    }

    public function parse_ticker($ticker, $market = null) {
        //
        // [
        //     [1640789101000, 1292663.0, 1311823.61303, 1295794.252, 1311823.61303, 0.030175],
        //     [1640790902000, 1311823.61303, 1310820.96, 1290000.0, 1290000.0, 0.042533],
        // ],
        //
        $symbol = $this->safe_symbol(null, $market);
        $timestamp = $this->milliseconds();
        $result = array(
            'symbol' => $symbol,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'high' => null,
            'low' => null,
            'bid' => null,
            'bidVolume' => null,
            'ask' => null,
            'askVolume' => null,
            'vwap' => null,
            'open' => null,
            'close' => null,
            'last' => null,
            'previousClose' => null,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => null,
            'quoteVolume' => null,
            'info' => $ticker,
        );
        $tickerLength = is_array($ticker) ? count($ticker) : 0;
        if ($tickerLength > 0) {
            $start = max ($tickerLength - 48, 0);
            for ($i = $start; $i < count($ticker); $i++) {
                $candle = $ticker[$i];
                if ($result['open'] === null) {
                    $result['open'] = $this->safe_string($candle, 1);
                }
                $high = $this->safe_string($candle, 2);
                if (($result['high'] === null) || (($high !== null) && Precise::string_lt($result['high'], $high))) {
                    $result['high'] = $high;
                }
                $low = $this->safe_string($candle, 3);
                if (($result['low'] === null) || (($low !== null) && Precise::string_lt($result['low'], $low))) {
                    $result['low'] = $low;
                }
                $baseVolume = $this->safe_string($candle, 5);
                if ($result['baseVolume'] === null) {
                    $result['baseVolume'] = $baseVolume;
                } else {
                    $result['baseVolume'] = Precise::string_add($result['baseVolume'], $baseVolume);
                }
            }
            $last = $tickerLength - 1;
            $result['last'] = $this->safe_string($ticker[$last], 4);
            $result['close'] = $result['last'];
        }
        return $this->safe_ticker($result, $market);
    }

    public function fetch_ticker($symbol, $params = array ()) {
        /**
         * fetches a price $ticker, a statistical calculation with the information calculated over the past 24 hours for a specific $market
         * @param {str} $symbol unified $symbol of the $market to fetch the $ticker for
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {dict} a {@link https://docs.ccxt.com/en/latest/manual.html#$ticker-structure $ticker structure}
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = yield $this->publicGetJapanStatHighSymbol (array_merge($request, $params));
        $ticker = $this->safe_value($response, 'trades');
        //
        // {
        //     "status" => true,
        //     "volume_trade" => "0.495703",
        //     "trades" => [
        //         [1640789101000, 1292663.0, 1311823.61303, 1295794.252, 1311823.61303, 0.030175],
        //         [1640790902000, 1311823.61303, 1310820.96, 1290000.0, 1290000.0, 0.042533],
        //     ],
        // }
        //
        return $this->parse_ticker($ticker, $market);
    }

    public function convert_month_name_to_string($cyrillic) {
        $months = array(
            'Jan' => '01',
            'Feb' => '02',
            'Mar' => '03',
            'Apr' => '04',
            'May' => '05',
            'Jun' => '06',
            'Jul' => '07',
            'Aug' => '08',
            'Sept' => '09',
            'Oct' => '10',
            'Nov' => '11',
            'Dec' => '12',
        );
        return $this->safe_string($months, $cyrillic);
    }

    public function parse_exchange_specific_datetime($cyrillic) {
        $parts = explode(' ', $cyrillic);
        $month = $parts[0];
        $day = str_replace(',', '', $parts[1]);
        if (strlen($day) < 2) {
            $day = '0' . $day;
        }
        $year = str_replace(',', '', $parts[2]);
        $month = str_replace(',', '', $month);
        $month = str_replace('.', '', $month);
        $month = $this->convert_month_name_to_string($month);
        if (!$month) {
            throw new ExchangeError($this->id . ' parseTrade() unrecognized $month name => ' . $cyrillic);
        }
        $hms = $parts[3];
        $hmsParts = explode(':', $hms);
        $h = $this->safe_string($hmsParts, 0);
        $m = '00';
        $ampm = $this->safe_string($parts, 4);
        if ($h === 'noon') {
            $h = '12';
        } else {
            $intH = intval($h);
            if (($ampm !== null) && ($ampm[0] === 'p')) {
                $intH = 12 . $intH;
                if ($intH > 23) {
                    $intH = 0;
                }
            }
            $h = (string) $intH;
            if (strlen($h) < 2) {
                $h = '0' . $h;
            }
            $m = $this->safe_string($hmsParts, 1, '00');
            if (strlen($m) < 2) {
                $m = '0' . $m;
            }
        }
        $ymd = implode('-', array($year, $month, $day));
        $ymdhms = $ymd . 'T' . $h . ':' . $m . ':00';
        $timestamp = $this->parse8601($ymdhms);
        // server reports local time, adjust to UTC
        // a special case for DST
        // subtract 2 hours during winter
        $intM = intval($m);
        if ($intM < 11 || $intM > 2) {
            return $timestamp - 7200000;
        }
        // subtract 3 hours during summer
        return $timestamp - 10800000;
    }

    public function parse_trade($trade, $market = null) {
        $timestamp = $this->parse_exchange_specific_datetime($this->safe_string($trade, 'pub_date'));
        $id = $this->safe_string($trade, 'id');
        $type = 'limit';
        $side = $this->safe_string($trade, 'type');
        $priceString = $this->safe_string($trade, 'price');
        $amountString = $this->safe_string($trade, 'amnt_trade');
        $market = $this->safe_market(null, $market);
        return $this->safe_trade(array(
            'id' => $id,
            'info' => $trade,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'symbol' => $market['symbol'],
            'type' => $type,
            'side' => $side,
            'order' => null,
            'takerOrMaker' => null,
            'price' => $priceString,
            'amount' => $amountString,
            'cost' => null,
            'fee' => null,
        ), $market);
    }

    public function fetch_trades($symbol, $since = null, $limit = null, $params = array ()) {
        /**
         * get the list of most recent $trades for a particular $symbol
         * @param {str} $symbol unified $symbol of the $market to fetch $trades for
         * @param {int|null} $since timestamp in ms of the earliest trade to fetch
         * @param {int|null} $limit the maximum amount of $trades to fetch
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {[dict]} a list of ~@link https://docs.ccxt.com/en/latest/manual.html?#public-$trades trade structures~
         */
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = yield $this->publicGetDealsSymbol (array_merge($request, $params));
        // they report each trade twice (once for both of the two sides of the fill)
        // deduplicate $trades for that reason
        $trades = array();
        for ($i = 0; $i < count($response); $i++) {
            $id = $this->safe_integer($response[$i], 'id');
            if (fmod($id, 2)) {
                $trades[] = $response[$i];
            }
        }
        return $this->parse_trades($trades, $market, $since, $limit);
    }

    public function create_order($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        /**
         * create a trade order
         * @param {str} $symbol unified $symbol of the $market to create an order in
         * @param {str} $type 'market' or 'limit'
         * @param {str} $side 'buy' or 'sell'
         * @param {float} $amount how much of currency you want to trade in units of base currency
         * @param {float|null} $price the $price at which the order is to be fullfilled, in units of the quote currency, ignored in $market orders
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {dict} an {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        if ($type === 'market') {
            throw new ExchangeError($this->id . ' createOrder() allows limit orders only');
        }
        yield $this->load_markets();
        $market = $this->market($symbol);
        $method = 'privatePost' . $this->capitalize($side) . 'Id';
        $request = array(
            'count' => $amount,
            'currency1' => $market['quoteId'],
            'currency' => $market['baseId'],
            'price' => $price,
        );
        return $this->$method (array_merge($request, $params));
    }

    public function cancel_order($id, $symbol = null, $params = array ()) {
        /**
         * cancels an open order
         * @param {str} $id order $id
         * @param {str|null} $symbol not used by btctradeua cancelOrder ()
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {dict} An {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structure}
         */
        $request = array(
            'id' => $id,
        );
        return yield $this->privatePostRemoveOrderId (array_merge($request, $params));
    }

    public function parse_order($order, $market = null) {
        $timestamp = $this->milliseconds();
        $symbol = $this->safe_symbol(null, $market);
        $side = $this->safe_string($order, 'type');
        $price = $this->safe_string($order, 'price');
        $amount = $this->safe_string($order, 'amnt_trade');
        $remaining = $this->safe_string($order, 'amnt_trade');
        return $this->safe_order(array(
            'id' => $this->safe_string($order, 'id'),
            'clientOrderId' => null,
            'timestamp' => $timestamp, // until they fix their $timestamp
            'datetime' => $this->iso8601($timestamp),
            'lastTradeTimestamp' => null,
            'status' => 'open',
            'symbol' => $symbol,
            'type' => null,
            'timeInForce' => null,
            'postOnly' => null,
            'side' => $side,
            'price' => $price,
            'stopPrice' => null,
            'amount' => $amount,
            'filled' => null,
            'remaining' => $remaining,
            'trades' => null,
            'info' => $order,
            'cost' => null,
            'average' => null,
            'fee' => null,
        ), $market);
    }

    public function fetch_open_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        /**
         * fetch all unfilled currently open $orders
         * @param {str} $symbol unified $market $symbol
         * @param {int|null} $since the earliest time in ms to fetch open $orders for
         * @param {int|null} $limit the maximum number of  open $orders structures to retrieve
         * @param {dict} $params extra parameters specific to the btctradeua api endpoint
         * @return {[dict]} a list of {@link https://docs.ccxt.com/en/latest/manual.html#order-structure order structures}
         */
        if ($symbol === null) {
            throw new ArgumentsRequired($this->id . ' fetchOpenOrders() requires a $symbol argument');
        }
        yield $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = yield $this->privatePostMyOrdersSymbol (array_merge($request, $params));
        $orders = $this->safe_value($response, 'your_open_orders');
        return $this->parse_orders($orders, $market, $since, $limit);
    }

    public function nonce() {
        return $this->milliseconds();
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $url = $this->urls['api'] . '/' . $this->implode_params($path, $params);
        $query = $this->omit($params, $this->extract_params($path));
        if ($api === 'public') {
            if ($query) {
                $url .= $this->implode_params($path, $query);
            }
        } else {
            $this->check_required_credentials();
            $nonce = $this->nonce();
            $body = $this->urlencode(array_merge(array(
                'out_order_id' => $nonce,
                'nonce' => $nonce,
            ), $query));
            $auth = $body . $this->secret;
            $headers = array(
                'public-key' => $this->apiKey,
                'api-sign' => $this->hash($this->encode($auth), 'sha256'),
                'Content-Type' => 'application/x-www-form-urlencoded',
            );
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }
}

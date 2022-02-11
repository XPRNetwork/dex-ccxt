<?php

namespace ccxt;

// PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
// https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

use Exception; // a common import
use \ccxt\ExchangeError;
use \ccxt\InsufficientFunds;

class blockchaincom extends Exchange {

    public function describe() {
        return $this->deep_extend(parent::describe (), array(
            'id' => 'blockchaincom',
            'secret' => null,
            'name' => 'Blockchain.com',
            'countries' => array( 'LX' ),
            'rateLimit' => 1000,
            'version' => 'v3',
            'has' => array(
                'CORS' => false,
                'spot' => true,
                'margin' => null, // on exchange but not implemented in CCXT
                'swap' => false,
                'future' => false,
                'option' => false,
                'cancelOrder' => true,
                'cancelOrders' => true,
                'createOrder' => true,
                'fetchBalance' => true,
                'fetchCanceledOrders' => true,
                'fetchClosedOrders' => true,
                'fetchDeposit' => true,
                'fetchDepositAddress' => true,
                'fetchDeposits' => true,
                'fetchFundingHistory' => false,
                'fetchFundingRate' => false,
                'fetchFundingRateHistory' => false,
                'fetchFundingRates' => false,
                'fetchIndexOHLCV' => false,
                'fetchL2OrderBook' => true,
                'fetchL3OrderBook' => true,
                'fetchLedger' => false,
                'fetchMarkets' => true,
                'fetchMarkOHLCV' => false,
                'fetchMyTrades' => true,
                'fetchOHLCV' => false,
                'fetchOpenOrders' => true,
                'fetchOrder' => true,
                'fetchOrderBook' => true,
                'fetchPremiumIndexOHLCV' => false,
                'fetchTicker' => true,
                'fetchTickers' => true,
                'fetchTrades' => false,
                'fetchTradingFees' => true,
                'fetchWithdrawal' => true,
                'fetchWithdrawals' => true,
                'fetchWithdrawalWhitelist' => true, // fetches exchange specific benficiary-ids needed for withdrawals
                'withdraw' => true,
            ),
            'timeframes' => null,
            'urls' => array(
                'logo' => 'https://user-images.githubusercontent.com/1294454/147515585-1296e91b-7398-45e5-9d32-f6121538533f.jpeg',
                'test' => array(
                    'public' => 'https://testnet-api.delta.exchange',
                    'private' => 'https://testnet-api.delta.exchange',
                ),
                'api' => array(
                    'public' => 'https://api.blockchain.com/v3/exchange',
                    'private' => 'https://api.blockchain.com/v3/exchange',
                ),
                'www' => 'https://blockchain.com',
                'doc' => array(
                    'https://api.blockchain.com/v3',
                ),
                'fees' => 'https://exchange.blockchain.com/fees',
            ),
            'api' => array(
                'public' => array(
                    'get' => array(
                        'tickers', // fetchTickers
                        'tickers/{symbol}', // fetchTicker
                        'symbols', // fetchMarkets
                        'symbols/{symbol}', // fetchMarket
                        'l2/{symbol}', // fetchL2OrderBook
                        'l3/{symbol}', // fetchL3OrderBook
                    ),
                ),
                'private' => array(
                    'get' => array(
                        'fees', // fetchFees
                        'orders', // fetchOpenOrders, fetchClosedOrders
                        'orders/{orderId}', // fetchOrder(id)
                        'trades',
                        'fills', // fetchMyTrades
                        'deposits', // fetchDeposits
                        'deposits/{depositId}', // fetchDeposit
                        'accounts', // fetchBalance
                        'accounts/{account}/{currency}',
                        'whitelist', // fetchWithdrawalWhitelist
                        'whitelist/{currency}', // fetchWithdrawalWhitelistByCurrency
                        'withdrawals', // fetchWithdrawalWhitelist
                        'withdrawals/{withdrawalId}', // fetchWithdrawalById
                    ),
                    'post' => array(
                        'orders', // createOrder
                        'deposits/{currency}', // fetchDepositAddress by currency (only crypto supported)
                        'withdrawals', // withdraw
                    ),
                    'delete' => array(
                        'orders', // cancelOrders
                        'orders/{orderId}', // cancelOrder
                    ),
                ),
            ),
            'fees' => array(
                'trading' => array(
                    'feeSide' => 'get',
                    'tierBased' => true,
                    'percentage' => true,
                    'tiers' => array(
                        'taker' => array(
                            array( $this->parse_number('0'), $this->parse_number('0.004') ),
                            array( $this->parse_number('10000'), $this->parse_number('0.0022') ),
                            array( $this->parse_number('50000'), $this->parse_number('0.002') ),
                            array( $this->parse_number('100000'), $this->parse_number('0.0018') ),
                            array( $this->parse_number('500000'), $this->parse_number('0.0018') ),
                            array( $this->parse_number('1000000'), $this->parse_number('0.0018') ),
                            array( $this->parse_number('2500000'), $this->parse_number('0.0018') ),
                            array( $this->parse_number('5000000'), $this->parse_number('0.0016') ),
                            array( $this->parse_number('25000000'), $this->parse_number('0.0014') ),
                            array( $this->parse_number('100000000'), $this->parse_number('0.0011') ),
                            array( $this->parse_number('500000000'), $this->parse_number('0.0008') ),
                            array( $this->parse_number('1000000000'), $this->parse_number('0.0006') ),
                        ),
                        'maker' => array(
                            array( $this->parse_number('0'), $this->parse_number('0.002') ),
                            array( $this->parse_number('10000'), $this->parse_number('0.0012') ),
                            array( $this->parse_number('50000'), $this->parse_number('0.001') ),
                            array( $this->parse_number('100000'), $this->parse_number('0.0008') ),
                            array( $this->parse_number('500000'), $this->parse_number('0.0007000000000000001') ),
                            array( $this->parse_number('1000000'), $this->parse_number('0.0006') ),
                            array( $this->parse_number('2500000'), $this->parse_number('0.0005') ),
                            array( $this->parse_number('5000000'), $this->parse_number('0.0004') ),
                            array( $this->parse_number('25000000'), $this->parse_number('0.0003') ),
                            array( $this->parse_number('100000000'), $this->parse_number('0.0002') ),
                            array( $this->parse_number('500000000'), $this->parse_number('0.0001') ),
                            array( $this->parse_number('1000000000'), $this->parse_number('0') ),
                        ),
                    ),
                ),
            ),
            'requiredCredentials' => array(
                'apiKey' => false,
                'secret' => true,
            ),
            'precisionMode' => TICK_SIZE,
            'exceptions' => array(
                'exact' => array(
                    '401' => '\\ccxt\\AuthenticationError',
                    '404' => '\\ccxt\\OrderNotFound',
                ),
                'broad' => array(),
            ),
        ));
    }

    public function fetch_markets($params = array ()) {
        //
        //     "USDC-GBP" => {
        //         "base_currency" => "USDC",
        //         "base_currency_scale" => 6,
        //         "counter_currency" => "GBP",
        //         "counter_currency_scale" => 2,
        //         "min_price_increment" => 10000,
        //         "min_price_increment_scale" => 8,
        //         "min_order_size" => 500000000,
        //         "min_order_size_scale" => 8,
        //         "max_order_size" => 0,
        //         "max_order_size_scale" => 8,
        //         "lot_size" => 10000,
        //         "lot_size_scale" => 8,
        //         "status" => "open",
        //         "id" => 68,
        //         "auction_price" => 0,
        //         "auction_size" => 0,
        //         "auction_time" => "",
        //         "imbalance" => 0
        //     }
        //
        $markets = $this->publicGetSymbols ($params);
        $marketIds = is_array($markets) ? array_keys($markets) : array();
        $result = array();
        for ($i = 0; $i < count($marketIds); $i++) {
            $marketId = $marketIds[$i];
            $market = $this->safe_value($markets, $marketId);
            $baseId = $this->safe_string($market, 'base_currency');
            $quoteId = $this->safe_string($market, 'counter_currency');
            $base = $this->safe_currency_code($baseId);
            $quote = $this->safe_currency_code($quoteId);
            $numericId = $this->safe_number($market, 'id');
            $active = null;
            $marketState = $this->safe_string($market, 'status');
            if ($marketState === 'open') {
                $active = 'true';
            } else {
                $active = 'false';
            }
            // price precision
            $minPriceIncrementString = $this->safe_string($market, 'min_price_increment');
            $minPriceIncrementScaleString = $this->safe_string($market, 'min_price_increment_scale');
            $minPriceScalePrecisionString = $this->parse_precision($minPriceIncrementScaleString);
            $pricePrecisionString = Precise::string_mul($minPriceIncrementString, $minPriceScalePrecisionString);
            $pricePrecision = $this->parse_number($pricePrecisionString);
            // amount precision
            $lotSizeString = $this->safe_string($market, 'lot_size');
            $lotSizeScaleString = $this->safe_string($market, 'lot_size_scale');
            $lotSizeScalePrecisionString = $this->parse_precision($lotSizeScaleString);
            $amountPrecisionString = Precise::string_mul($lotSizeString, $lotSizeScalePrecisionString);
            $amountPrecision = $this->parse_number($amountPrecisionString);
            // minimum order size
            $minOrderSizeString = $this->safe_string($market, 'min_order_size');
            $minOrderSizeScaleString = $this->safe_string($market, 'min_order_size_scale');
            $minOrderSizeScalePrecisionString = $this->parse_precision($minOrderSizeScaleString);
            $minOrderSizePreciseString = Precise::string_mul($minOrderSizeString, $minOrderSizeScalePrecisionString);
            $minOrderSize = $this->parse_number($minOrderSizePreciseString);
            // maximum order size
            $maxOrderSize = null;
            $maxOrderSize = $this->safe_string($market, 'max_order_size');
            if ($maxOrderSize !== '0') {
                $maxOrderSizeScaleString = $this->safe_string($market, 'max_order_size_scale');
                $maxOrderSizeScalePrecisionString = $this->parse_precision($maxOrderSizeScaleString);
                $maxOrderSizeString = Precise::string_mul($maxOrderSize, $maxOrderSizeScalePrecisionString);
                $maxOrderSize = $this->parse_number($maxOrderSizeString);
            } else {
                $maxOrderSize = null;
            }
            $result[] = array(
                'info' => $market,
                'id' => $marketId,
                'numericId' => $numericId,
                'symbol' => $base . '/' . $quote,
                'base' => $base,
                'quote' => $quote,
                'settle' => null,
                'baseId' => $baseId,
                'quoteId' => $quoteId,
                'settleId' => null,
                'type' => 'spot',
                'spot' => true,
                'margin' => false,
                'swap' => false,
                'future' => false,
                'option' => false,
                'active' => $active,
                'contract' => false,
                'linear' => null,
                'inverse' => null,
                'contractSize' => null,
                'expiry' => null,
                'expiryDatetime' => null,
                'strike' => null,
                'optionType' => null,
                'precision' => array(
                    'amount' => $amountPrecision,
                    'price' => $pricePrecision,
                ),
                'limits' => array(
                    'leverage' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'amount' => array(
                        'min' => $minOrderSize,
                        'max' => $maxOrderSize,
                    ),
                    'price' => array(
                        'min' => null,
                        'max' => null,
                    ),
                    'cost' => array(
                        'min' => null,
                        'max' => null,
                    ),
                ),
            );
        }
        return $result;
    }

    public function fetch_order_book($symbol, $limit = null, $params = array ()) {
        return $this->fetch_l3_order_book($symbol, $limit, $params);
    }

    public function fetch_l3_order_book($symbol, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            'symbol' => $this->market_id($symbol),
        );
        if ($limit !== null) {
            $request['depth'] = $limit;
        }
        $response = $this->publicGetL3Symbol (array_merge($request, $params));
        return $this->parse_order_book($response, $symbol, null, 'bids', 'asks', 'px', 'qty');
    }

    public function fetch_l2_order_book($symbol, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            'symbol' => $this->market_id($symbol),
        );
        if ($limit !== null) {
            $request['depth'] = $limit;
        }
        $response = $this->publicGetL2Symbol (array_merge($request, $params));
        return $this->parse_order_book($response, $symbol, null, 'bids', 'asks', 'px', 'qty');
    }

    public function parse_ticker($ticker, $market = null) {
        //
        //     {
        //     "symbol" => "BTC-USD",
        //     "price_24h" => 47791.86,
        //     "volume_24h" => 362.88635738,
        //     "last_trade_price" => 47587.75
        //     }
        //
        $marketId = $this->safe_string($ticker, 'symbol');
        $symbol = $this->safe_symbol($marketId, $market, '-');
        $last = $this->safe_string($ticker, 'last_trade_price');
        $baseVolume = $this->safe_string($ticker, 'volume_24h');
        $open = $this->safe_string($ticker, 'price_24h');
        return $this->safe_ticker(array(
            'symbol' => $symbol,
            'timestamp' => null,
            'datetime' => null,
            'high' => null,
            'low' => null,
            'bid' => null,
            'bidVolume' => null,
            'ask' => null,
            'askVolume' => null,
            'vwap' => null,
            'open' => $open,
            'close' => null,
            'last' => $last,
            'previousClose' => null,
            'change' => null,
            'percentage' => null,
            'average' => null,
            'baseVolume' => $baseVolume,
            'quoteVolume' => null,
            'info' => $ticker,
        ), $market, false);
    }

    public function fetch_ticker($symbol, $params = array ()) {
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            'symbol' => $market['id'],
        );
        $response = $this->publicGetTickersSymbol (array_merge($request, $params));
        return $this->parse_ticker($response, $market);
    }

    public function fetch_tickers($symbols = null, $params = array ()) {
        $this->load_markets();
        $tickers = $this->publicGetTickers ($params);
        return $this->parse_tickers($tickers, $symbols);
    }

    public function parse_order_state($state) {
        $states = array(
            'OPEN' => 'open',
            'REJECTED' => 'rejected',
            'FILLED' => 'closed',
            'CANCELED' => 'canceled',
            'PART_FILLED' => 'open',
            'EXPIRED' => 'expired',
        );
        return $this->safe_string($states, $state, $state);
    }

    public function parse_order($order, $market = null) {
        //
        //     {
        //         clOrdId => '00001',
        //         ordType => 'MARKET',
        //         ordStatus => 'FILLED',
        //         $side => 'BUY',
        //         $symbol => 'USDC-USDT',
        //         exOrdId => '281775861306290',
        //         $price => null,
        //         text => 'Fill',
        //         lastShares => '30.0',
        //         lastPx => '0.9999',
        //         leavesQty => '0.0',
        //         cumQty => '30.0',
        //         avgPx => '0.9999',
        //         $timestamp => '1633940339619'
        //     }
        //
        $clientOrderId = $this->safe_string($order, 'clOrdId');
        $type = $this->safe_string_lower($order, 'ordType');
        $statusId = $this->safe_string($order, 'ordStatus');
        $state = $this->parse_order_state($statusId);
        $side = $this->safe_string_lower($order, 'side');
        $marketId = $this->safe_string($order, 'symbol');
        $symbol = $this->safe_symbol($marketId, $market, '-');
        $exchangeOrderId = $this->safe_string($order, 'exOrdId');
        $price = ($type !== 'market') ? $this->safe_string($order, 'price') : null;
        $average = $this->safe_number($order, 'avgPx');
        $timestamp = $this->safe_integer($order, 'timestamp');
        $datetime = $this->iso8601($timestamp);
        $filled = $this->safe_string($order, 'cumQty');
        $remaining = $this->safe_string($order, 'leavesQty');
        $result = $this->safe_order(array(
            'id' => $exchangeOrderId,
            'clientOrderId' => $clientOrderId,
            'datetime' => $datetime,
            'timestamp' => $timestamp,
            'lastTradeTimestamp' => null,
            'status' => $state,
            'symbol' => $symbol,
            'type' => $type,
            'timeInForce' => null,
            'side' => $side,
            'price' => $price,
            'average' => $average,
            'amount' => null,
            'filled' => $filled,
            'remaining' => $remaining,
            'cost' => null,
            'trades' => array(),
            'fees' => array(),
            'info' => $order,
        ));
        return $result;
    }

    public function create_order($symbol, $type, $side, $amount, $price = null, $params = array ()) {
        $clientOrderId = $this->safe_string_2($params, 'clientOrderId', 'clOrdId', $this->uuid16());
        $this->load_markets();
        $market = $this->market($symbol);
        $request = array(
            // 'stopPx' : limit $price
            // 'timeInForce' : "GTC" for Good Till Cancel, "IOC" for Immediate or Cancel, "FOK" for Fill or Kill, "GTD" Good Till Date
            // 'expireDate' : expiry date in the format YYYYMMDD
            // 'minQty' : The minimum quantity required for an IOC fill
            'symbol' => $market['id'],
            'side' => strtoupper($side),
            'orderQty' => $this->amount_to_precision($symbol, $amount),
            'ordType' => strtoupper($type), // LIMIT, MARKET, STOP, STOPLIMIT
            'clOrdId' => $clientOrderId,
        );
        $params = $this->omit($params, array( 'clientOrderId', 'clOrdId' ));
        if ($request['ordType'] === 'LIMIT') {
            $request['price'] = $this->price_to_precision($symbol, $price);
        }
        if ($request['ordType'] === 'STOPLIMIT') {
            $request['price'] = $this->price_to_precision($symbol, $price);
            $request['stopPx'] = $this->price_to_precision($symbol, $price);
        }
        $response = $this->privatePostOrders (array_merge($request, $params));
        return $this->parse_order($response, $market);
    }

    public function cancel_order($id, $symbol = null, $params = array ()) {
        $request = array(
            'orderId' => $id,
        );
        $response = $this->privateDeleteOrdersOrderId (array_merge($request, $params));
        return array(
            'id' => $id,
            'info' => $response,
        );
    }

    public function cancel_orders($ids, $symbol = null, $params = array ()) {
        // cancels all open orders if no $symbol specified
        // cancels all open orders of specified $symbol, if $symbol is specified
        $this->load_markets();
        $request = array(
            // 'symbol' => $marketId,
        );
        if ($symbol !== null) {
            $marketId = $this->market_id($symbol);
            $request['symbol'] = $marketId;
        }
        $response = $this->privateDeleteOrders (array_merge($request, $params));
        return array(
            'symbol' => $symbol,
            'info' => $response,
        );
    }

    public function fetch_trading_fees($params = array ()) {
        //
        //     {
        //         makerRate => "0.002",
        //         takerRate => "0.004",
        //         volumeInUSD => "0.0"
        //     }
        //
        $this->load_markets();
        $response = $this->privateGetFees ();
        return array(
            'maker' => $this->safe_number($response, 'makerRate'),
            'taker' => $this->safe_number($response, 'takerRate'),
            'info' => $response,
        );
    }

    public function fetch_canceled_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        $state = 'CANCELED';
        return $this->fetch_orders_by_state($state, $symbol, $since, $limit, $params);
    }

    public function fetch_closed_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        $state = 'FILLED';
        return $this->fetch_orders_by_state($state, $symbol, $since, $limit, $params);
    }

    public function fetch_open_orders($symbol = null, $since = null, $limit = null, $params = array ()) {
        $state = 'OPEN';
        return $this->fetch_orders_by_state($state, $symbol, $since, $limit, $params);
    }

    public function fetch_orders_by_state($state, $symbol = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            // 'to' => unix epoch ms
            // 'from' => unix epoch ms
            'status' => $state,
            'limit' => 100,
        );
        $market = null;
        if ($symbol !== null) {
            $market = $this->market($symbol);
            $request['symbol'] = $market['id'];
        }
        $response = $this->privateGetOrders (array_merge($request, $params));
        return $this->parse_orders($response, $market, $since, $limit);
    }

    public function parse_trade($trade, $market = null) {
        //
        //     {
        //         "exOrdId":281685751028507,
        //         "tradeId":281685434947633,
        //         "execId":8847494003,
        //         "side":"BUY",
        //         "symbol":"AAVE-USDT",
        //         "price":405.34,
        //         "qty":0.1,
        //         "fee":0.162136,
        //         "timestamp":1634559249687
        //     }
        //
        $id = $this->safe_string($trade, 'exOrdId');
        $order = $this->safe_string($trade, 'tradeId');
        $side = strtolower($this->safe_string($trade, 'side'));
        $marketId = $this->safe_string($trade, 'symbol');
        $priceString = $this->safe_string($trade, 'price');
        $amountString = $this->safe_string($trade, 'qty');
        $costString = Precise::string_mul($priceString, $amountString);
        $price = $this->parse_number($priceString);
        $amount = $this->parse_number($amountString);
        $cost = $this->parse_number($costString);
        $timestamp = $this->safe_integer($trade, 'timestamp');
        $datetime = $this->iso8601($timestamp);
        $market = $this->safe_market($marketId, $market, '-');
        $symbol = $market['symbol'];
        $fee = null;
        $feeCost = $this->safe_number($trade, 'fee');
        if ($feeCost !== null) {
            $feeCurrency = null;
            if ($market !== null) {
                if ($side === 'buy') {
                    $base = $market['base'];
                    $feeCurrency = $this->safe_currency_code($base);
                } else if ($side === 'sell') {
                    $quote = $market['quote'];
                    $feeCurrency = $this->safe_currency_code($quote);
                }
            }
            $fee = array( 'cost' => $feeCost, 'currency' => $feeCurrency );
        }
        return array(
            'id' => $id,
            'timestamp' => $timestamp,
            'datetime' => $datetime,
            'symbol' => $symbol,
            'order' => $order,
            'type' => null,
            'side' => $side,
            'takerOrMaker' => null,
            'price' => $price,
            'amount' => $amount,
            'cost' => $cost,
            'fee' => $fee,
            'info' => $order,
        );
    }

    public function fetch_my_trades($symbol = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array();
        if ($limit !== null) {
            $request['limit'] = $limit;
        }
        $market = null;
        if ($symbol !== null) {
            $request['symbol'] = $this->market_id($symbol);
            $market = $this->market($symbol);
        }
        $trades = $this->privateGetFills (array_merge($request, $params));
        return $this->parse_trades($trades, $market, $since, $limit, $params); // need to define
    }

    public function fetch_deposit_address($code, $params = array ()) {
        $this->load_markets();
        $currency = $this->currency($code);
        $request = array(
            'currency' => $currency['id'],
        );
        $response = $this->privatePostDepositsCurrency (array_merge($request, $params));
        $rawAddress = $this->safe_string($response, 'address');
        $tag = null;
        $address = null;
        if ($rawAddress !== null) {
            // if a $tag or memo is used it is separated by a colon in the 'address' value
            list($address, $tag) = explode(':', $rawAddress);
        }
        $result = array( 'info' => $response );
        $result['currency'] = $currency['code'];
        $result['address'] = $address;
        if ($tag !== null) {
            $result['tag'] = $tag;
        }
        return $result;
    }

    public function parse_transaction_state($state) {
        $states = array(
            'COMPLETED' => 'ok', //
            'REJECTED' => 'failed',
            'PENDING' => 'pending',
            'FAILED' => 'failed',
            'REFUNDED' => 'refunded',
        );
        return $this->safe_string($states, $state, $state);
    }

    public function parse_transaction($transaction, $currency = null) {
        //
        // deposit
        //
        //     {
        //         "depositId":"748e9180-be0d-4a80-e175-0156150efc95",
        //         "amount":0.009,
        //         "currency":"ETH",
        //         "address":"0xEC6B5929D454C8D9546d4221ace969E1810Fa92c",
        //         "state":"COMPLETED",
        //         "txHash":"582114562140e51a80b481c2dfebaf62b4ab9769b8ff54820bb67e34d4a3ab0c",
        //         "timestamp":1633697196241
        //     }
        //
        // withdrawal
        //
        //     {
        //         "amount":30.0,
        //         "currency":"USDT",
        //         "beneficiary":"cab00d11-6e7f-46b7-b453-2e8ef6f101fa", // blockchain specific $id
        //         "withdrawalId":"99df5ef7-eab6-4033-be49-312930fbd1ea",
        //         "fee":34.005078,
        //         "state":"COMPLETED",
        //         "timestamp":1634218452549
        //     }
        //
        $type = null;
        $id = null;
        $amount = $this->safe_number($transaction, 'amount');
        $timestamp = $this->safe_integer($transaction, 'timestamp');
        $currencyId = $this->safe_string($transaction, 'currency');
        $code = $this->safe_currency_code($currencyId, $currency);
        $state = $this->safe_string($transaction, 'state');
        if (is_array($transaction) && array_key_exists('depositId', $transaction)) {
            $type = 'deposit';
            $id = $this->safe_string($transaction, 'depositId');
        } else if (is_array($transaction) && array_key_exists('withdrawalId', $transaction)) {
            $type = 'withdrawal';
            $id = $this->safe_string($transaction, 'withdrawalId');
        }
        $feeCost = ($type === 'withdrawal') ? $this->safe_number($transaction, 'fee') : null;
        $fee = null;
        if ($feeCost !== null) {
            $fee = array( 'currency' => $code, 'cost' => $feeCost );
        }
        $address = $this->safe_string($transaction, 'address');
        $txid = $this->safe_string($transaction, 'txhash');
        $result = array(
            'info' => $transaction,
            'id' => $id,
            'txid' => $txid,
            'timestamp' => $timestamp,
            'datetime' => $this->iso8601($timestamp),
            'network' => null,
            'addressFrom' => null,
            'address' => $address,
            'addressTo' => $address,
            'tagFrom' => null,
            'tag' => null,
            'tagTo' => null,
            'type' => $type,
            'amount' => $amount,
            'currency' => $code,
            'status' => $this->parse_transaction_state($state), // 'status' =>   'pending',   // 'ok', 'failed', 'canceled', string
            'updated' => null,
            'comment' => null,
            'fee' => $fee,
        );
        return $result;
    }

    public function fetch_withdrawal_whitelist($params = array ()) {
        $this->load_markets();
        $response = $this->privateGetWhitelist ();
        $result = array();
        for ($i = 0; $i < count($response); $i++) {
            $entry = $response[$i];
            $result[] = array(
                'beneficiaryId' => $this->safe_string($entry, 'whitelistId'),
                'name' => $this->safe_string($entry, 'name'),
                'currency' => $this->safe_string($entry, 'currency'),
                'info' => $entry,
            );
        }
        return $result;
    }

    public function fetch_withdrawal_whitelist_by_currency($currency, $params = array ()) {
        $this->load_markets();
        $request = array(
            'currency' => $this->currencyId ($currency),
        );
        $response = $this->privateGetWhitelistCurrency (array_merge($request, $params));
        $result = array();
        for ($i = 0; $i < count($response); $i++) {
            $entry = $response[$i];
            $result[] = array(
                'beneficiaryId' => $this->safe_string($entry, 'whitelistId'),
                'name' => $this->safe_string($entry, 'name'),
                'currency' => $this->safe_string($entry, 'currency'),
                'info' => $entry,
            );
        }
        return $result;
    }

    public function withdraw($code, $amount, $address, $tag = null, $params = array ()) {
        $this->load_markets();
        $currencyid = $this->currencyId ($code);
        $request = array(
            'amount' => $amount,
            'currency' => $currencyid,
            // 'beneficiary' => address/id,
            'sendMax' => false,
        );
        $response = $this->privatePostWithdrawals (array_merge($request, $params));
        //
        //     array(
        //         $amount => "30.0",
        //         currency => "USDT",
        //         beneficiary => "adcd43fb-9ba6-41f7-8c0d-7013482cb88f",
        //         $withdrawalId => "99df5ef7-eab6-4033-be49-312930fbd1ea",
        //         fee => "34.005078",
        //         state => "PENDING",
        //         timestamp => "1634218452595"
        //     ),
        //
        $withdrawalId = $this->safe_string($response, 'withdrawalId');
        $result = array(
            'info' => $response,
            'id' => $withdrawalId,
        );
        return $result;
    }

    public function fetch_withdrawals($code = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            // 'from' : integer timestamp in ms
            // 'to' : integer timestamp in ms
        );
        if ($since !== null) {
            $request['from'] = $since;
        }
        $response = $this->privateGetWithdrawals (array_merge($request, $params));
        return $this->parse_transactions($response, $code, $since, $limit);
    }

    public function fetch_withdrawal($id, $code = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            'withdrawalId' => $id,
        );
        $response = $this->privateGetWithdrawalsWithdrawalId (array_merge($request, $params));
        return $this->parse_transaction($response);
    }

    public function fetch_deposits($code = null, $since = null, $limit = null, $params = array ()) {
        $this->load_markets();
        $request = array(
            // 'from' : integer timestamp in ms
            // 'to' : integer timestap in ms
        );
        if ($since !== null) {
            $request['from'] = $since;
        }
        $response = $this->privateGetDeposits (array_merge($request, $params));
        return $this->parse_transactions($response, $code, $since, $limit);
    }

    public function fetch_deposit($id, $code = null, $params = array ()) {
        $this->load_markets();
        $depositId = $this->safe_string($params, 'depositId', $id);
        $request = array(
            'depositId' => $depositId,
        );
        $deposit = $this->privateGetDepositsDepositId (array_merge($request, $params));
        return $this->parse_transaction($deposit);
    }

    public function fetch_balance($params = array ()) {
        $this->load_markets();
        $accountName = $this->safe_string($params, 'account', 'primary');
        $params = $this->omit($params, 'account');
        $request = array(
            'account' => $accountName,
        );
        $response = $this->privateGetAccounts (array_merge($request, $params));
        //
        //     {
        //         "primary" => array(
        //             array(
        //                 "currency":"ETH",
        //                 "balance":0.009,
        //                 "available":0.009,
        //                 "balance_local":30.82869,
        //                 "available_local":30.82869,
        //                 "rate":3425.41
        //             ),
        //             ...
        //         )
        //     }
        //
        $balances = $this->safe_value($response, $accountName);
        if ($balances === null) {
            throw new ExchangeError($this->id . ' fetchBalance() could not find the "' . $accountName . '" account');
        }
        $result = array( 'info' => $response );
        for ($i = 0; $i < count($balances); $i++) {
            $entry = $balances[$i];
            $currencyId = $this->safe_string($entry, 'currency');
            $code = $this->safe_currency_code($currencyId);
            $account = $this->account();
            $account['free'] = $this->safe_string($entry, 'available');
            $account['total'] = $this->safe_string($entry, 'balance');
            $result[$code] = $account;
        }
        return $this->safe_balance($result);
    }

    public function fetch_order($id, $symbol = null, $params = array ()) {
        // note => only works with exchange-order-$id
        // does not work with clientOrderId
        $this->load_markets();
        $request = array(
            'orderId' => $id,
        );
        $response = $this->privateGetOrdersOrderId (array_merge($request, $params));
        //
        //     {
        //         "exOrdId" => 11111111,
        //         "clOrdId" => "ABC",
        //         "ordType" => "MARKET",
        //         "ordStatus" => "FILLED",
        //         "side" => "BUY",
        //         "price" => 0.12345,
        //         "text" => "string",
        //         "symbol" => "BTC-USD",
        //         "lastShares" => 0.5678,
        //         "lastPx" => 3500.12,
        //         "leavesQty" => 10,
        //         "cumQty" => 0.123345,
        //         "avgPx" => 345.33,
        //         "timestamp" => 1592830770594
        //     }
        //
        return $this->parse_order($response);
    }

    public function sign($path, $api = 'public', $method = 'GET', $params = array (), $headers = null, $body = null) {
        $requestPath = '/' . $this->implode_params($path, $params);
        $url = $this->urls['api'][$api] . $requestPath;
        $query = $this->omit($params, $this->extract_params($path));
        if ($api === 'public') {
            if ($query) {
                $url .= '?' . $this->urlencode($query);
            }
        } else if ($api === 'private') {
            $this->check_required_credentials();
            $headers = array(
                'X-API-Token' => $this->secret,
            );
            if (($method === 'GET')) {
                if ($query) {
                    $url .= '?' . $this->urlencode($query);
                }
            } else {
                $body = $this->json($query);
                $headers['Content-Type'] = 'application/json';
            }
        }
        return array( 'url' => $url, 'method' => $method, 'body' => $body, 'headers' => $headers );
    }

    public function handle_errors($code, $reason, $url, $method, $headers, $body, $response, $requestHeaders, $requestBody) {
        // {"timestamp":"2021-10-21T15:13:58.837+00:00","status":404,"error":"Not Found","message":"","path":"/orders/505050"
        if ($response === null) {
            return;
        }
        $text = $this->safe_string($response, 'text');
        if ($text !== null) { // if trade currency account is empty returns 200 with rejected order
            if ($text === 'Insufficient Balance') {
                throw new InsufficientFunds($this->id . ' ' . $body);
            }
        }
        $errorCode = $this->safe_string($response, 'status');
        $errorMessage = $this->safe_string($response, 'error');
        if ($code !== null) {
            $feedback = $this->id . ' ' . $this->json($response);
            $this->throw_exactly_matched_exception($this->exceptions['exact'], $errorCode, $feedback);
            $this->throw_broadly_matched_exception($this->exceptions['broad'], $errorMessage, $feedback);
        }
    }
}

//  ---------------------------------------------------------------------------

import Exchange from './abstract/protondex.js';
import { TICK_SIZE } from './base/functions/number.js';
import { ExchangeError, ArgumentsRequired, OrderNotFound } from './base/errors.js';
import { Precise } from './base/Precise.js';
import { sha256 } from './static_dependencies/noble-hashes/sha256.js';
import { ripemd160 } from './static_dependencies/noble-hashes/ripemd160.js';
import { secp256k1 } from './static_dependencies/noble-curves/secp256k1.js';
import { CurveFn, SignatureType } from './static_dependencies/noble-curves/abstract/weierstrass.js';
import { PrivKey, bitMask, numberToBytesBE, concatBytes, hexToBytes } from './static_dependencies/noble-curves/abstract/utils.js';
import { Int, Trade, OrderSide } from './base/types.js';
//  ---------------------------------------------------------------------------

export default class protondex extends Exchange {
    describe () {
        return this.deepExtend (super.describe (), {
            'id': 'protondex',
            'name': 'protondex',
            'countries': [ 'US' ],
            'rateLimit': 600,
            'version': 'v1',
            'has': {
                'CORS': undefined,
                'spot': true,
                'margin': false,
                'swap': false,
                'future': false,
                'option': false,
                'addMargin': false,
                'cancelOrder': true,
                'createOrder': true,
                'createReduceOnlyOrder': false,
                'createStopLimitOrder': false,
                'createStopMarketOrder': false,
                'createStopOrder': false,
                'fetchBalance': true,
                'fetchBorrowRate': false,
                'fetchBorrowRateHistories': false,
                'fetchBorrowRateHistory': false,
                'fetchBorrowRates': false,
                'fetchBorrowRatesPerSymbol': false,
                'fetchCurrencies': false,
                'fetchDepositAddress': false,
                'fetchDepositAddresses': false,
                'fetchDeposits': true,
                'fetchFundingHistory': false,
                'fetchFundingRate': false,
                'fetchFundingRateHistory': false,
                'fetchFundingRates': false,
                'fetchIndexOHLCV': false,
                'fetchL2OrderBook': false,
                'fetchLeverage': false,
                'fetchLeverageTiers': false,
                'fetchMarginMode': false,
                'fetchMarkets': true,
                'fetchMarkOHLCV': false,
                'fetchMyTrades': true,
                'fetchOHLCV': true,
                'fetchOpenInterestHistory': false,
                'fetchOpenOrders': true,
                'fetchOrder': true,
                'fetchOrderBook': true,
                'fetchOrders': true,
                'fetchPosition': false,
                'fetchPositionMode': false,
                'fetchPositions': false,
                'fetchPositionsRisk': false,
                'fetchPremiumIndexOHLCV': false,
                'fetchTicker': true,
                'fetchTickers': true,
                'fetchTrades': true,
                'fetchTradinFee': false,
                'fetchTradingFees': true,
                'fetchTransfer': false,
                'fetchTransfers': false,
                'fetchWithdrawals': false,
                'reduceMargin': false,
                'setLeverage': false,
                'setMarginMode': false,
                'setPositionMode': false,
                'transfer': false,
                'withdraw': false,
            },
            'hostname': 'https://mainnet.api.protondex.com',
            'urls': {
                'logo': 'https://protonswap.com/img/logo.svg',
                'api': {
                    'rest': 'https://mainnet.api.protondex.com/dex',
                    'public': 'https://mainnet.api.protondex.com/dex',
                    'private': 'https://mainnet.api.protondex.com/dex',
                },
                'test': {
                    'rest': 'https://testnet.api.protondex.com/dex',
                    'public': 'https://testnet.api.protondex.com/dex',
                    'private': 'https://testnet.api.protondex.com/dex',
                },
                'www': 'https://protondex.com/',
                'doc': [
                    'https://www.docs.protondex.com',
                ],
                'fees': [
                    'https://www.docs.protondex.com/dex/what-is-proton-dex/dex-fees-and-discounts',
                ],
                'referral': 'https://protondex.com/',
            },
            'api': {
                'public': {
                    'get': [
                        'markets/all',
                        'orders/open', // ?{account}/{marketid}/{offset}/{limit}'
                        'orders/history', // ?{account}/{marketid}/{offset}/{limit}'
                        'orders/lifecycle', // ?{orderid}'
                        'orders/depth', // ?{marketid}/{step}/{limit}'
                        'trades/daily',
                        'trades/history', // ?{account}/{symbol}/{offset}/{ordinal_order_ids}/{limit}'
                        'trades/recent', // ?{marketid}/{offset}/{limit}'
                        'chart/ohlcv', // ?{interval}/{dateFrom}/{dateTo}/{marketid}/{limit}'
                        'status/sync',
                        'account/balances', // ?{account}'
                    ],
                    'post': [
                        'orders/serialize', // application/json - transaction
                        'orders/submit', // application/json - serilized_tx_hex, signatures
                    ],
                },
                'private': {
                    'post': [
                    ],
                    'get': [
                        'user/fees',
                        'account/deposits',
                        'account/withdrawals',
                    ],
                },
            },
            'fees': {
                'trading': {
                    'tierBased': true,
                    'maker': 0.001, // tiered fee discounts
                    'taker': 0.001, // tiered fee discounts
                },
            },
            'precision': {
                'amount': this.parseNumber ('0.00000001'),
                'price': this.parseNumber ('0.00000001'),
            },
            'precisionMode': TICK_SIZE,
        });
    }

    async fetchMarkets (params = {}) {
        /**
         * @method
         * @name protondex#fetchMarkets
         * @description retrieves data on all markets for protondex
         * @param {object} params extra parameters specific to the exchange api endpoint
         * @returns {[object]} an array of objects representing market data
         */
        const response = await this.publicGetMarketsAll (params);
        //
        //    {
        //        "data": [
        //            {
        //                "name": "ETH-BTC",
        //                "precision": 6,
        //                "min_volume": "0.00000001",
        //                "min_price": "0.000001",
        //                "volume": "0.015713",
        //                "last_price": "0.069322",
        //                "highest_bid": "0.063892",
        //                "lowest_ask": "0.071437",
        //                "change_in_24h": "2.85",
        //                "size_precision": 8,
        //                "price_precision": 6
        //            },
        //            ...
        //        ]
        //    }
        //
        const markets = this.safeValue (response, 'data', []);
        const result = [];
        for (let i = 0; i < markets.length; i++) {
            const market = markets[i];
            const [ baseId, quoteId ] = market['symbol'].split ('_');
            const base = this.safeCurrencyCode (baseId);
            const quote = this.safeCurrencyCode (quoteId);
            result.push ({
                'id': market['symbol'],
                'symbol': market['symbol'],
                'base': base,
                'quote': quote,
                'settle': undefined,
                'baseId': baseId,
                'quoteId': quoteId,
                'settleId': undefined,
                'type': 'spot',
                'spot': true,
                'margin': false,
                'swap': false,
                'future': false,
                'option': false,
                'active': true,
                'contract': false,
                'linear': undefined,
                'inverse': undefined,
                'contractSize': undefined,
                'expiry': undefined,
                'expiryDatetime': undefined,
                'strike': undefined,
                'optionType': undefined,
                'precision': {
                    'amount': this.parseNumber (this.parsePrecision (this.safeString (market, 'size_precision'))),
                    'price': this.parseNumber (this.parsePrecision (this.safeString (market, 'price_precision'))),
                },
                'limits': {
                    'leverage': {
                        'min': undefined,
                        'max': undefined,
                    },
                    'amount': {
                        'min': this.safeNumber (market, 'minPrice'),
                        'max': undefined,
                    },
                    'price': {
                        'min': this.safeNumber (market, 'minVolume'),
                        'max': undefined,
                    },
                    'cost': {
                        'min': undefined,
                        'max': undefined,
                    },
                },
                'info': market,
            });
        }
        return result;
    }

    parseTicker (ticker, market = undefined) {
        //
        //     {
        //         "name":"ETH-BTC",
        //         "precision":6,
        //         "min_volume":"0.00000001",
        //         "min_price":"0.000001",
        //         "volume":"0.000452",
        //         "last_price":"0.079059",
        //         "highest_bid":"0.073472",
        //         "lowest_ask":"0.079059",
        //         "change_in_24h":"8.9",
        //         "size_precision":8,
        //         "price_precision":6
        //     }
        //
        const marketId = this.safeString (ticker, 'name');
        market = this.safeMarket (marketId, market, '-');
        const timestamp = this.milliseconds ();
        const last = this.safeString (ticker, 'last_price');
        return this.safeTicker ({
            'symbol': ticker['symbol'],
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'high': this.safeString (ticker, 'high'),
            'low': this.safeString (ticker, 'low'),
            'bid': this.safeString (ticker, 'highest_bid'),
            'bidVolume': this.safeString (ticker, 'volume_bid'),
            'ask': this.safeString (ticker, 'lowest_ask'),
            'askVolume': this.safeString (ticker, 'volume_ask'),
            'vwap': undefined,
            'open': this.safeString (ticker, 'open'),
            'close': this.safeString (ticker, 'close'),
            'last': last,
            'previousClose': undefined,
            'change': undefined,
            'percentage': this.safeString (ticker, 'change_percentage'),
            'average': undefined,
            'baseVolume': undefined,
            'quoteVolume': this.safeString (ticker, 'volume'),
            'info': ticker,
        }, market);
    }

    async fetchTicker (symbol, params = {}) {
        /**
         * @method
         * @name protondex#fetchTicker
         * @description fetches a price ticker, a statistical calculation with the information calculated over the past 24 hours for a specific market
         * @param {string} symbol unified symbol of the market to fetch the ticker for
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} a [ticker structure]{@link https://docs.ccxt.com/en/latest/manual.html#ticker-structure}
         */
        await this.loadMarkets ();
        const tickers = await this.fetchTickers ();
        return tickers[symbol];
    }

    async fetchTickers (symbols = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchTickers
         * @description fetches price tickers for multiple markets, statistical calculations with the information calculated over the past 24 hours each market
         * @param {[string]|undefined} symbols unified symbols of the markets to fetch the ticker for, all market tickers are returned if not assigned
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} an array of [ticker structures]{@link https://docs.ccxt.com/en/latest/manual.html#ticker-structure}
         */
        await this.loadMarkets ();
        symbols = this.marketSymbols (symbols);
        const response = await this.publicGetTradesDaily (params);
        //
        //     {
        //         "data":[
        //             {
        //                 "name":"ETH-BTC",
        //                 "precision":6,
        //                 "min_volume":"0.00000001",
        //                 "min_price":"0.000001",
        //                 "volume":"0.000452",
        //                 "last_price":"0.079059",
        //                 "highest_bid":"0.073472",
        //                 "lowest_ask":"0.079059",
        //                 "change_in_24h":"8.9",
        //                 "size_precision":8,
        //                 "price_precision":6
        //             }
        //         ]
        //     }
        //
        const tickers = this.safeValue (response, 'data', []);
        const result = {};
        for (let i = 0; i < tickers.length; i++) {
            const ticker = this.parseTicker (tickers[i]);
            const symbol = ticker['symbol'];
            result[symbol] = ticker;
        }
        return this.filterByArray (result, 'symbol', symbols);
    }

    async fetchOrderBook (symbol, limit = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchOrderBook
         * @description fetches information on open orders with bid (buy) and ask (sell) prices, volumes and other data
         * @param {string} symbol unified symbol of the market to fetch the order book for
         * @param {int|undefined} limit the maximum amount of order book entries to return
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} A dictionary of [order book structures]{@link https://docs.ccxt.com/en/latest/manual.html#order-book-structure} indexed by market symbols
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'symbol': market['symbol'],
        };
        request['limit'] = (limit !== undefined) ? limit : 100;
        request['step'] = (params['step'] !== undefined) ? params['step'] : 100;
        const response = await this.publicGetOrdersDepth (this.extend (request, params));
        const data = this.safeValue (response, 'data', {});
        return this.parseOrderBook (data, market['symbol'], undefined, 'bids', 'asks', 'bid', 'ask');
    }

    parseTrade (trade, market): Trade {
        //
        // fetchTrades (public)
        //
        //      {
        //          "id":"5ec36295-5c8d-4874-8d66-2609d4938557",
        //          "price":"4050.06","size":"0.0044",
        //          "market_name":"ETH-USDT",
        //          "side":"sell",
        //          "created_at":"2021-12-07T17:47:36.811000Z"
        //      }
        //
        // fetchMyTrades (private)
        //
        //      {
        //              "id": "0718d520-c796-4061-a16b-915cd13f20c6",
        //              "price": "0.00000358",
        //              "size": "50.0",
        //              "market_name": "DOGE-BTC",
        //              "order_id": "ff2616d8-58d4-40fd-87ae-937c73eb6f1c",
        //              "side": "buy",
        //              "fee': "0.00000036",
        //              "fee_currency_code": "btc",
        //              "liquidity": "T",
        //              "created_at": "2021-12-08T18:26:33.840000Z"
        //      }
        //
        const timestamp = this.parse8601 (this.safeString (trade, 'block_time'));
        const tradeId = this.safeString (trade, 'trade_id');
        const priceString = this.safeString (trade, 'price');
        const orderSide = this.safeString (trade, 'order_side');
        const account = this.safeString (trade, 'account');
        const amountString = account === this.safeString (trade, 'bid_user') ? this.safeString (trade, 'bid_amount') : this.safeString (trade, 'ask_amount');
        const orderId = account === this.safeString (trade, 'bid_user') ? this.safeString (trade, 'bid_user_order_id') : this.safeString (trade, 'ask_user_order_id');
        const feeString = account === this.safeString (trade, 'bid_user') ? this.safeString (trade, 'bid_fee') : this.safeString (trade, 'ask_fee');
        const feeCurrencyId = account === this.safeString (trade, 'bid_user') ? this.safeString (market, 'baseId') : this.safeString (market, 'quoteId');
        let fee = undefined;
        if (feeString !== undefined) {
            const feeCurrencyCode = this.safeCurrencyCode (feeCurrencyId);
            fee = {
                'cost': feeString,
                'currency': feeCurrencyCode,
            };
        }
        return this.safeTrade ({
            'info': trade,
            'id': tradeId,
            'timestamp': timestamp,
            'datetime': this.iso8601 (timestamp),
            'symbol': market['symbol'],
            'order': orderId,
            'type': null,
            'side': orderSide,
            'takerOrMaker': undefined,
            'price': priceString,
            'amount': amountString,
            'cost': undefined,
            'fee': fee,
        }, market);
    }

    parseTrades (trades, market, account): Trade[] {
        trades = this.toArray (trades);
        const result = [];
        for (let i = 0; i < trades.length; i++) {
            trades[i]['account'] = account;
            const trade = this.extend (this.parseTrade (trades[i], market));
            result.push (trade);
        }
        return result;
    }

    async fetchMyTrades (symbol: string = undefined, since: Int = undefined, limit: Int = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchMyTrades
         * @description fetch all trades made by the user
         * @param {string|undefined} symbol unified market symbol
         * @param {int|undefined} since the earliest time in ms to fetch trades for
         * @param {int|undefined} limit the maximum number of trades structures to retrieve
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/#/?id=trade-structure}
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        if (params['account'] === undefined) {
            throw new ArgumentsRequired (this.id + ' fetchMyTrades() requires a account argument in params');
        }
        const request = {
            'account': params['account'],
            'symbol': market['symbol'],
        };
        request['limit'] = (limit !== undefined) ? limit : 100;
        request['offset'] = (params['offset'] !== undefined) ? params['offset'] : 0;
        if (params['ordinal_order_ids'] !== undefined) {
            request['ordinal_order_ids'] = params['ordinal_order_ids'];
        }
        const response = await this.publicGetTradesHistory (this.extend (request, params));
        //
        //     [
        //         {
        //             "id": "32164924331503616",
        //             "symbol": "LINK_USDT",
        //             "accountType": "SPOT",
        //             "orderId": "32164923987566592",
        //             "side": "SELL",
        //             "type": "MARKET",
        //             "matchRole": "TAKER",
        //             "createTime": 1648635115525,
        //             "price": "11",
        //             "quantity": "0.5",
        //             "amount": "5.5",
        //             "feeCurrency": "USDT",
        //             "feeAmount": "0.007975",
        //             "pageId": "32164924331503616",
        //             "clientOrderId": "myOwnId-321"
        //         }
        //     ]
        //
        const data = this.safeValue (response, 'data', []);
        return this.parseTrades (data, market, { 'account': params['account'] });
    }

    async fetchOrders (symbol: string = undefined, since: Int = undefined, limit: Int = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchOrders
         * @description get the list of most recent trades for a particular symbol
         * @param {string} symbol unified symbol of the market to fetch trades for
         * @param {int|undefined} since timestamp in ms of the earliest trade to fetch
         * @param {int|undefined} limit the maximum amount of trades to fetch
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/en/latest/manual.html?#public-trades}
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        if (params['account'] === undefined) {
            throw new ArgumentsRequired (this.id + ' fetchOrders() requires a account argument in params');
        }
        const request = {
            'account': params['account'],
            'symbol': market['symbol'],
        };
        request['offset'] = (params['offset'] !== undefined) ? params['offset'] : 0;
        request['limit'] = (limit !== undefined) ? limit : 100;
        if (params['ordinal_order_ids'] !== undefined) {
            request['ordinal_order_ids'] = params['ordinal_order_ids'];
        }
        if (params['trx_id'] !== undefined) {
            request['trx_id'] = params['trx_id'];
        }
        if (params['status'] !== undefined) {
            request['status'] = params['status'];
        }
        const response = await this.publicGetOrdersHistory (this.extend (request, params));
        //
        //      {
        //          "data":[
        //              {
        //                  "id":"5ec36295-5c8d-4874-8d66-2609d4938557",
        //                  "price":"4050.06","size":"0.0044",
        //                  "market_name":"ETH-USDT",
        //                  "side":"sell",
        //                  "created_at":"2021-12-07T17:47:36.811000Z"
        //              },
        //          ]
        //      }
        //
        const data = this.safeValue (response, 'data', []);
        return this.parseOrders (data, market);
    }

    async fetchTrades (symbol: string, since: Int = undefined, limit: Int = undefined, params = {}) {
        /**
         * @method
         * @name protondexx#fetchTrades
         * @description get the list of most recent trades for a particular symbol
         * @param {string} symbol unified symbol of the market to fetch trades for
         * @param {int|undefined} since timestamp in ms of the earliest trade to fetch
         * @param {int|undefined} limit the maximum amount of trades to fetch
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[object]} a list of [trade structures]{@link https://docs.ccxt.com/en/latest/manual.html?#public-trades}
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'symbol': market['symbol'],
        };
        request['limit'] = (limit !== undefined) ? limit : 100;
        request['offset'] = (params['offset'] !== undefined) ? params['offset'] : 0;
        const response = await this.publicGetTradesRecent (this.extend (request, params));
        //
        //      {
        //          "data": [
        //              {
        //                  "id": "0718d520-c796-4061-a16b-915cd13f20c6",
        //                  "price": "0.00000358",
        //                  "size": "50.0",
        //                  "market_name": "DOGE-BTC",
        //                  "order_id": "ff2616d8-58d4-40fd-87ae-937c73eb6f1c",
        //                  "side": "buy",
        //                  "fee': "0.00000036",
        //                  "fee_currency_code": "btc",
        //                  "liquidity": "T",
        //                  "created_at": "2021-12-08T18:26:33.840000Z"
        //              },
        //          ]
        //      }
        //
        const data = this.safeValue (response, 'data', []);
        return this.parseTrades (data, market, '');
    }

    async fetchTradingFees (params = {}) {
        /**
         * @method
         * @name protondex#fetchTradingFees
         * @description fetch the trading fees for multiple markets
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} a dictionary of [fee structures]{@link https://docs.ccxt.com/en/latest/manual.html#fee-structure} indexed by market symbols
         */
        await this.loadMarkets ();
        const response = await this.privateGetUserFees (params);
        //
        //    {
        //        data: {
        //            maker_fee: '0.0',
        //            taker_fee: '0.2',
        //            btc_volume_30d: '0.0'
        //        }
        //    }
        //
        const data = this.safeValue (response, 'data', {});
        const makerString = this.safeString (data, 'maker_fee');
        const takerString = this.safeString (data, 'taker_fee');
        const maker = this.parseNumber (Precise.stringDiv (makerString, '100'));
        const taker = this.parseNumber (Precise.stringDiv (takerString, '100'));
        const result = {};
        for (let i = 0; i < this.symbols.length; i++) {
            const symbol = this.symbols[i];
            result[symbol] = {
                'info': response,
                'symbol': symbol,
                'maker': maker,
                'taker': taker,
                'percentage': true,
                'tierBased': true,
            };
        }
        return result;
    }

    parseBalance (response) {
        const result = { 'info': response };
        const balances = this.safeValue (response, 'data', []);
        for (let i = 0; i < balances.length; i++) {
            const balance = balances[i];
            const currencyId = this.safeString (balance, 'currency');
            const code = this.safeCurrencyCode (currencyId);
            const account = this.account ();
            account['token'] = this.safeString (balance, 'contract');
            account['free'] = this.safeString (balance, 'amount');
            account['total'] = this.safeString (balance, 'amount');
            result[code] = account;
        }
        return this.safeBalance (result);
    }

    async fetchBalance (params = {}) {
        /**
         * @method
         * @name protondex#fetchBalance
         * @description query for balance and get the amount of funds available for trading or funds locked in orders
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} a [balance structure]{@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure}
         */
        await this.loadMarkets ();
        if (params['account'] === undefined) {
            throw new ArgumentsRequired (this.id + ' fetchOrders() requires a account argument in params');
        }
        const request = {
            'account': params['account'],
        };
        const response = await this.publicGetAccountBalances (this.extend (request, params));
        return this.parseBalance (response);
    }

    parseDepositAddress (depositAddress, currency = undefined) {
        //
        //     {
        //         "address":"0x77b5051f97efa9cc52c9ad5b023a53fc15c200d3",
        //         "tag":"0"
        //     }
        //
        const address = this.safeString (depositAddress, 'address');
        const tag = this.safeString (depositAddress, 'tag');
        this.checkAddress (address);
        return {
            'currency': this.safeCurrencyCode (undefined, currency),
            'address': address,
            'tag': tag,
            'network': undefined,
            'info': depositAddress,
        };
    }

    parseOrderStatus (status) {
        const statuses = {
            'fulfilled': 'closed',
            'canceled': 'canceled',
            'pending': 'open',
            'open': 'open',
            'partially_filled': 'open',
        };
        return this.safeString (statuses, status, status);
    }

    parseOrder (order, market = undefined) {
        //
        //     {
        //         "id":"8bdd79f4-8414-40a2-90c3-e9f4d6d1eef4"
        //         "market":"IOT-BTC"
        //         "price":"0.0000003"
        //         "size":"4.0"
        //         "size_filled":"3.0"
        //         "fee":"0.0075"
        //         "fee_currency_code":"iot"
        //         "funds":"0.0"
        //         "status":"canceled"
        //         "order_type":"buy"
        //         "post_only":false
        //         "operation_type":"market_order"
        //         "created_at":"2018-01-12T21:14:06.747828Z"
        //     }
        //
        const marketId = this.safeString (order, 'market');
        const symbol = this.safeSymbol (marketId, market, '-');
        const timestamp = this.parse8601 (this.safeString (order, 'block_time'));
        const priceString = this.safeString (order, 'price');
        const amountString = this.safeString (order, 'quantity_init');
        const remainingString = this.safeString (order, 'quantity_curr');
        const status = this.parseOrderStatus (this.safeString (order, 'status'));
        let type = this.safeString (order, 'order_type');
        if (type !== undefined) {
            const parts = type.split ('_');
            type = parts[0];
        }
        const side = this.safeString (order, 'order_side');
        return this.safeOrder ({
            'id': this.safeString (order, 'order_id'),
            'clientOrderId': this.safeString (order, 'ordinal_order_id'),
            'datetime': this.iso8601 (timestamp),
            'timestamp': timestamp,
            'status': status,
            'symbol': symbol,
            'type': type,
            'side': side,
            'price': priceString,
            'stopPrice': this.safeString (order, 'trigger_price'),
            'cost': undefined,
            'amount': amountString,
            'remaining': remainingString,
            'fee': undefined,
        }, market);
    }

    async fetchOrder (id, symbol = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchOrder
         * @description fetches information on an order made by the user
         * @param {string|undefined} symbol unified symbol of the market the order was made in
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} An [order structure]{@link https://docs.ccxt.com/en/latest/manual.html#order-structure}
         */
        await this.loadMarkets ();
        const request = {
            'order_id': id,
        };
        if (params['ordinal_order_id'] !== undefined) {
            request['ordinal_order_id'] = params['ordinal_order_id'];
        }
        const response = await this.publicGetOrdersLifecycle (this.extend (request, params));
        const data = this.safeValue (response, 'data', {});
        return this.parseOrder (data[0]);
    }

    async fetchOpenOrders (symbol: string = undefined, since: Int = undefined, limit: Int = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchOpenOrders
         * @description fetch all unfilled currently open orders
         * @description fetch all unfilled currently open orders
         * @param {string|undefined} symbol unified market symbol
         * @param {int|undefined} since the earliest time in ms to fetch open orders for
         * @param {int|undefined} limit the maximum number of  open orders structures to retrieve
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[object]} a list of [order structures]{@link https://docs.ccxt.com/en/latest/manual.html#order-structure}
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        if (params['account'] === undefined) {
            throw new ArgumentsRequired (this.id + ' fetchOrders() requires a account argument in params');
        }
        const request = {
            'account': params['account'],
            'symbol': market['symbol'],
        };
        request['offset'] = (params['offset'] !== undefined) ? params['offset'] : 0;
        request['limit'] = (limit !== undefined) ? limit : 100;
        if (params['ordinal_order_ids'] !== undefined) {
            request['ordinal_order_ids'] = params['ordinal_order_ids'];
        }
        const response = await this.publicGetOrdersOpen (this.extend (request, params));
        const data = this.safeValue (response, 'data', []);
        return this.parseOrders (data, market);
    }

    async fetchDeposits (code = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchDeposits
         * @description fetch all deposits made to an account
         * @param {string|undefined} code unified currency code
         * @param {int|undefined} since the earliest time in ms to fetch deposits for
         * @param {int|undefined} limit the maximum number of deposits structures to retrieve
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[object]} a list of [transaction structures]{@link https://docs.ccxt.com/en/latest/manual.html#transaction-structure}
         */
        await this.loadMarkets ();
        const request = {
            // currency: 'xrp', // optional: currency code in lowercase
            // status: 'completed', // optional: withdrawal status
            // since_time // datetime in ISO8601 format (2017-11-06T09:53:08.383210Z)
            // end_time // datetime in ISO8601 format (2017-11-06T09:53:08.383210Z)
            // start_time // datetime in ISO8601 format (2017-11-06T09:53:08.383210Z)
        };
        let currency = undefined;
        if (code !== undefined) {
            currency = this.currency (code);
            request['currency'] = this.safeStringLower (currency, 'id');
        }
        if (since !== undefined) {
            request['since_time'] = this.iso8601 (since);
        }
        const response = await this.privateGetAccountDeposits (this.extend (request, params));
        //
        //     data: [
        //         {
        //             id: '6e2f18b5-f80e-xxx-xxx-xxx',
        //             amount: '0.1',
        //             status: 'completed',
        //             currency_code: 'eth',
        //             txid: '0xxxx',
        //             address: '0xxxx',
        //             tag: null,
        //             type: 'deposit'
        //         },
        //     ]
        //
        const transactions = this.safeValue (response, 'data', []);
        transactions.reverse (); // no timestamp but in reversed order
        return this.parseTransactions (transactions, currency, undefined, limit);
    }

    async fetchWithdrawals (code = undefined, since = undefined, limit = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchWithdrawals
         * @description fetch all withdrawals made from an account
         * @param {string|undefined} code unified currency code
         * @param {int|undefined} since the earliest time in ms to fetch withdrawals for
         * @param {int|undefined} limit the maximum number of withdrawals structures to retrieve
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[object]} a list of [transaction structures]{@link https://docs.ccxt.com/en/latest/manual.html#transaction-structure}
         */
        await this.loadMarkets ();
        const request = {
            // currency: 'xrp', // optional: currency code in lowercase
            // status: 'completed', // optional: withdrawal status
            // since_time // datetime in ISO8601 format (2017-11-06T09:53:08.383210Z)
            // end_time // datetime in ISO8601 format (2017-11-06T09:53:08.383210Z)
            // start_time // datetime in ISO8601 format (2017-11-06T09:53:08.383210Z)
        };
        let currency = undefined;
        if (code !== undefined) {
            currency = this.currency (code);
            request['currency'] = this.safeStringLower (currency, 'id');
        }
        if (since !== undefined) {
            request['since_time'] = this.iso8601 (since);
        }
        const response = await this.privateGetAccountWithdrawals (this.extend (request, params));
        //
        //     data: [
        //         {
        //             id: '25f6f144-3666-xxx-xxx-xxx',
        //             amount: '0.01',
        //             status: 'completed',
        //             fee: '0.0005',
        //             currency_code: 'btc',
        //             txid: '4xxx',
        //             address: 'bc1xxx',
        //             tag: null,
        //             type: 'withdraw'
        //         },
        //     ]
        //
        const transactions = this.safeValue (response, 'data', []);
        transactions.reverse (); // no timestamp but in reversed order
        return this.parseTransactions (transactions, currency, undefined, limit);
    }

    parseTransactionStatus (status) {
        const statuses = {
            'completed': 'ok',
            'denied': 'failed',
            'approval_pending': 'pending',
        };
        return this.safeString (statuses, status, status);
    }

    parseTransaction (transaction, currency = undefined) {
        //
        // fetchWithdrawals, withdraw
        //
        //     {
        //         id: '25f6f144-3666-xxx-xxx-xxx',
        //         amount: '0.01',
        //         status: 'completed',
        //         fee: '0.0005',
        //         currency_code: 'btc',
        //         txid: '4xxx',
        //         address: 'bc1xxx',
        //         tag: null,
        //         type: 'withdraw'
        //     },
        //
        // fetchDeposits
        //
        //     {
        //         id: '6e2f18b5-f80e-xxx-xxx-xxx',
        //         amount: '0.1',
        //         status: 'completed',
        //         currency_code: 'eth',
        //         txid: '0xxxx',
        //         address: '0xxxx',
        //         tag: null,
        //         type: 'deposit'
        //     },
        //
        const id = this.safeString (transaction, 'id');
        const address = this.safeString (transaction, 'address');
        const tag = this.safeString (transaction, 'tag');
        const txid = this.safeString (transaction, 'txid');
        const currencyId = this.safeString (transaction, 'currency_code');
        const code = this.safeCurrencyCode (currencyId, currency);
        let type = this.safeString (transaction, 'type');
        if (type === 'withdraw') {
            type = 'withdrawal';
        }
        const status = this.parseTransactionStatus (this.safeString (transaction, 'status'));
        const amountString = this.safeString (transaction, 'amount');
        const amount = this.parseNumber (amountString);
        const feeCostString = this.safeString (transaction, 'fee');
        let feeCost = 0;
        if (feeCostString !== undefined) {
            feeCost = this.parseNumber (feeCostString);
        }
        return {
            'info': transaction,
            'id': id,
            'txid': txid,
            'timestamp': undefined,
            'datetime': undefined,
            'network': undefined,
            'address': address,
            'addressTo': undefined,
            'addressFrom': undefined,
            'tag': tag,
            'tagTo': undefined,
            'tagFrom': undefined,
            'type': type,
            'amount': amount,
            'currency': code,
            'status': status,
            'updated': undefined,
            'fee': {
                'currency': code,
                'cost': feeCost,
            },
        };
    }

    nonce () {
        return this.milliseconds ();
    }

    async fetchStatusSync (params = {}) {
        /**
         * @method
         * @name protondex#fetchStatusSync
         * @description fetch synchronization time
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} a [balance structure]{@link https://docs.ccxt.com/en/latest/manual.html?#balance-structure}
         */
        const response = await this.publicGetStatusSync ();
        //
        //     [
        //         {
        //           "dbSecondsBehind": 0,
        //           "chronicleSecondsBehind": 0,
        //           "maxSecondsBehind": 0
        //         }
        //     ]
        return response;
    }

    async fetchOHLCV (symbol: string, timeframe = '1W', since: Int = undefined, limit: Int = undefined, params = {}) {
        /**
         * @method
         * @name protondex#fetchOhlcv
         * @description retrive ohlcv charts
         * @param {int} timeframe duration of the input
         * @param {string} symbol unified market symbol
         * @param {timestamp} from_time start date and time
         * @param {timestamp} to_time end date and time
         * @param {integer|undefined} limit count to fetch
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {[[int]]} A list of candles ordered as timestamp, open, high, low, close, volume
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        const request = {
            'interval': timeframe,
            'symbol': market['symbol'],
        };
        const currentTimestamp = this.milliseconds ();
        const oneMonth = 30 * 24 * 60 * 60 * 1000;
        if (params['from_time'] !== undefined) {
            request['from'] = this.ymdhms (this.parseDate (params['from_time']));
        } else {
            const startTime = currentTimestamp - oneMonth;
            request['from'] = this.ymdhms (startTime);
        }
        if (params['to_time'] !== undefined) {
            request['to'] = this.ymdhms (this.parseDate (params['to_time']));
        } else {
            request['to'] = this.ymdhms (currentTimestamp);
        }
        request['limit'] = (limit !== undefined) ? limit : 100;
        const response = await this.publicGetChartOhlcv (this.extend (request, params));
        //
        //   [
        //      {
        //           'close': '0.76',
        //           'count': '0',
        //           'high': '0.76',
        //           'low': '0.76',
        //           'open': '0.76',
        //           'time': '1665950400000',
        //           'volume': '0',
        //           'volume_bid': '0'
        //       }
        //   ]
        const transResults = this.safeValue (response, 'data', []);
        const results = [];
        for (let i = 0; i < transResults.length; i++) {
            results.push (this.parseOHLCV (transResults[i], market));
        }
        return transResults;
    }

    int2octets (num: bigint, ec: CurveFn) {
        // if (typeof num !== 'bigint') throw new Error ('bigint expected');
        const _0n = BigInt (0);
        const ORDER_MASK = bitMask (ec.CURVE.nBitLength);
        if (!(_0n <= num && num < ORDER_MASK)) {
            throw new Error ('bigint expected < 2 XOR ec.CURVE.nBitLength');
        }
        // works with order, can have different size than numToField!
        return numberToBytesBE (num, ec.CURVE.nByteLength);
    }

    privkeyToUint8Array (privkey: PrivKey) {
        const ec: CurveFn = secp256k1;
        const scalar = ec.utils.normPrivateKeyToScalar (privkey);
        return this.int2octets (scalar, ec);
    }

    create_base58_map () {
        const base58Chars = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        const base58M = Array (256).fill (-1) as number[];
        for (let i = 0; i < base58Chars.length; ++i) {
            base58M[base58Chars.charCodeAt (i)] = i;
        }
        return base58M;
    }

    binaryToBase58 (bignum: Uint8Array) {
        const base58Chars = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        const base58Map = this.create_base58_map ();
        const result = [] as number[];
        for (let byte = 0; byte < bignum.length; ++byte) {
            let carry = bignum[byte];
            for (let j = 0; j < result.length; ++j) {
                const x = (base58Map[result[j]] * 256) + carry;
                result[j] = base58Chars.charCodeAt (x % 58);
                if (carry < 58) {
                    carry = 0;
                } else {
                    carry = (carry / 58);
                }
            }
            while (carry) {
                result.push (base58Chars.charCodeAt (carry % 58));
                if (carry < 58) {
                    carry = 0;
                } else {
                    carry = (carry / 58);
                }
            }
        }
        for (let k = 0; k < bignum.length; ++k) {
            const byte = bignum[k];
            if (byte) {
                break;
            } else {
                result.push ('1'.charCodeAt (0));
            }
        }
        result.reverse ();
        let resultString: String = '';
        for (let i = 0; i < result.length; i++) {
            resultString += String.fromCharCode (result[i]);
        }
        return resultString;
    }

    digestSuffixRipemd160 (data: Uint8Array, suffix: string) {
        const d = new Uint8Array (data.length + suffix.length);
        for (let i = 0; i < data.length; ++i) {
            d[i] = data[i];
        }
        for (let i = 0; i < suffix.length; ++i) {
            const len = data.length + i;
            d[len] = suffix.charCodeAt (i);
        }
        return ripemd160 (d);
    }

    keyToString (keyData: Uint8Array, suffix: string, prefix: string) {
        const digest = new Uint8Array (this.digestSuffixRipemd160 (keyData, suffix));
        const whole = new Uint8Array (keyData.length + 4);
        for (let i = 0; i < keyData.length; ++i) {
            whole[i] = keyData[i];
        }
        for (let i = 0; i < 4; ++i) {
            whole[i + keyData.length] = digest[i];
        }
        return prefix + this.binaryToBase58 (whole);
    }

    stringToKey (s: string, size: number, suffix: string) {
        const whole = this.base58ToBinary (s);
        const data: Uint8Array = new Uint8Array (whole.buffer, 0, whole.length - 4);
        const digest = new Uint8Array (this.digestSuffixRipemd160 (data, suffix));
        const digestStatus = (digest[0] !== whole[(whole.length) - 4] || digest[1] !== whole[(whole.length) - 3]
                             || digest[2] !== whole[(whole.length) - 2] || digest[3] !== whole[(whole.length) - 1]);
        if (digestStatus) {
            throw new Error ("checksum doesn't match");
        }
        return data;
    }

    fromElliptic (ellipticSig: SignatureType) {
        (ellipticSig as any).recovery = ellipticSig.recovery || 0;
        const r = numberToBytesBE (ellipticSig.r, 32);
        const s = numberToBytesBE (ellipticSig.s, 32);
        let eosioRecoveryParam: number = 0;
        eosioRecoveryParam = ellipticSig.recovery + 27;
        if (ellipticSig.recovery <= 3) {
            eosioRecoveryParam += 4;
        }
        const initParams = new Uint8Array ([ eosioRecoveryParam ]);
        const sigData = concatBytes (initParams, r, s);
        return this.keyToString (sigData, 'K1', 'SIG_K1_');
    }

    getSignatures (transHex: Uint8Array) {
        let chainID = '384da888112027f0321850a169f737c33e53b388aad48b5adace4bab97f437e0';
        const sandboxMode = this.safeValue (this.options, 'sandboxMode', false);
        if (sandboxMode) {
            chainID = '71ee83bcf52142d61019d95f9cc5427ba6a0d7ff8accd9e2088ae2abeaf3d3dd';
        }
        const e: CurveFn = secp256k1;
        const signatures = [] as string[];
        const initData = new Uint8Array (32);
        const signBuf = concatBytes (hexToBytes (chainID), transHex, initData);
        const digest = e.CURVE.hash (signBuf);
        let arrayData = null;
        if (this.secret.substr (0, 7) === 'PVT_K1_') {
            arrayData = this.stringToKey (this.secret.substr (7), 32, 'K1');
        } else {
            const whole = this.base58ToBinary (this.secret);
            const keyData = new Uint8Array (32);
            for (let i = 0; i < 32; ++i) {
                keyData[i] = whole[i + 1];
            }
            arrayData = this.privkeyToUint8Array (keyData);
        }
        const rawSignature: SignatureType = e.sign (digest, arrayData);
        const signature: string = this.fromElliptic (rawSignature);
        signatures.push (signature);
        return signatures;
    }

    setSandboxMode (enable) {
        super.setSandboxMode (enable);
        this.options['sandboxMode'] = enable;
    }

    async createOrder (symbol: string, type, side: OrderSide, amount, price = undefined, params = {}) {
        /**
         * @method
         * @name protondex#createOrder
         * @description create a trade order
         * @see https://api-docs.protondex.com/reference/orderscontroller_submitorder
         * @param {string} symbol unified symbol of the market to create an order in
         * @param {string} type 'market' or 'limit'
         * @param {string} side 'buy' or 'sell'
         * @param {float} amount how much of currency you want to trade in units of base currency
         * @param {float|undefined} price the price at which the order is to be fullfilled, in units of the quote currency, ignored in market orders
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} an [order structure]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        await this.loadMarkets ();
        if (this.secret === undefined) {
            throw new ArgumentsRequired ('createOrder call requires a secret to be set');
        }
        const market = this.market (symbol);
        const marketid = parseInt (market.info.market_id);
        const accountName = this.safeString (params, 'account');
        const orderType = parseInt (type);
        const orderSide = parseInt (side);
        const orderFillType = this.safeValue (params, 'filltype');
        const orderAmount = amount;
        const triggerPrice = this.safeValue (params, 'triggerprice');
        const referrerName = (params['referrer'] !== undefined) ? params['referrer'] : '';
        const bidTokenPrecision = this.parseToInt (market.info.bid_token.precision);
        const askTokenPrecision = this.parseToInt (market.info.ask_token.precision);
        const bidTokenCode = market.info.bid_token.code.toString ();
        const askTokenCode = market.info.ask_token.code.toString ();
        const bidTokenContract = market.info.bid_token.contract.toString ();
        const askTokenContract = market.info.ask_token.contract.toString ();
        const quantityText = (orderSide === 2) ? (orderAmount.toFixed (bidTokenPrecision) + ' ' + bidTokenCode) : (orderAmount.toFixed (askTokenPrecision) + ' ' + askTokenCode);
        const tokenContract = orderSide === 2 ? bidTokenContract : askTokenContract;
        const bidMultiplier = (orderAmount * this.parseToInt (market.info.bid_token.multiplier));
        const askMultiplier = (orderAmount * this.parseToInt (market.info.ask_token.multiplier));
        const quantity = (orderSide === 2) ? bidMultiplier.toString () : askMultiplier.toString ();
        const orderPrice = Number (price) * Number (Math.pow (10, askTokenPrecision).toFixed (0));
        const actions = [
            {
                'account': tokenContract,
                'name': 'transfer',
                'data': {
                    'from': accountName,
                    'to': 'dex',
                    'quantity': quantityText,
                    'memo': '',
                },
                'authorization': [ {
                    'actor': accountName,
                    'permission': 'active',
                } ],
            },
            {
                'account': 'dex',
                'name': 'placeorder',
                'data': {
                    'market_id': marketid,
                    'account': accountName,
                    'order_type': orderType,
                    'order_side': orderSide,
                    'fill_type': orderFillType,
                    'bid_symbol': {
                        'sym': bidTokenPrecision + ',' + bidTokenCode,
                        'contract': bidTokenContract,
                    },
                    'ask_symbol': {
                        'sym': askTokenPrecision + ',' + askTokenCode,
                        'contract': askTokenContract,
                    },
                    'referrer': referrerName,
                    'quantity': quantity,
                    'price': orderPrice,
                    'trigger_price': triggerPrice,
                },
                'authorization': [ {
                    'actor': accountName,
                    'permission': 'active',
                } ],
            },
            {
                'account': 'dex',
                'name': 'process',
                'data': {
                    'q_size': 20,
                    'show_error_msg': 0,
                },
                'authorization': [ {
                    'actor': accountName,
                    'permission': 'active',
                } ],
            },
        ];
        const request = {
            'transaction': { actions },
        };
        const orderDetails = [];
        let retries = 5;
        while (retries > 0) {
            try {
                const serResponse = await this.publicPostOrdersSerialize (this.extend (request));
                const result = this.safeValue (serResponse, 'data', []);
                const tx = hexToBytes (result['serialized_tx_hex']);
                const signatures = this.getSignatures (tx);
                const orderRequest = {
                    'serialized_tx_hex': String (result['serialized_tx_hex']),
                    'signatures': signatures,
                };
                const response = await this.publicPostOrdersSubmit (this.extend (orderRequest));
                const data = this.safeValue (response, 'data', []);
                // Response format
                // {
                //     trx_id: 'd6124ed37ba30f499ec3043c185d6e458c7f4a581e09a4f3cefe64c723426af0',
                //     block_time: '2023-06-16T19:10:30.000Z',
                //     orders: [
                //         {
                //             ordinal_order_id: '378b28d5164be48adc7c0c7c02a9803abc4109185f11cc6116864e94878ff5cc',
                //             order_id: '3990837',
                //             status: 'create'
                //         }
                //     ]
                // }
                orderDetails['ordinal_order_id'] = data.orders[0].ordinal_order_id;
                orderDetails['order_id'] = data.orders[0].order_id;
                orderDetails['status'] = data.orders[0].status;
                orderDetails['block_time'] = data['block_time'];
                orderDetails['symbol'] = symbol;
                orderDetails['order_type'] = orderType;
                orderDetails['order_side'] = orderSide;
                orderDetails['price'] = orderPrice;
                orderDetails['trigger_price'] = triggerPrice;
                retries = 0;
            } catch (e) {
                if (this.last_json_response) {
                    const message = this.safeString (this.last_json_response.error.details[0], 'message');
                    if (message === 'is_canonical( c ): signature is not canonical') {
                        --retries;
                    } else {
                        retries = 0;
                    }
                }
                if (!retries) {
                    throw e;
                }
            }
        }
        return this.parseOrder (orderDetails, market);
    }

    async cancelOrder (id: string, symbol: string = undefined, params = {}) {
        /**
         * @method
         * @name protondex#cancelOrder
         * @description cancels an open order
         * @param {string} id order id
         * @param {string|undefined} symbol unified symbol of the market the order was made in
         * @param {object} params extra parameters specific to the protondex api endpoint
         * @returns {object} An [order structure]{@link https://docs.ccxt.com/en/latest/manual.html#order-structure}
         */
        await this.loadMarkets ();
        if (this.secret === undefined) {
            throw new ArgumentsRequired ('cancelOrder call requires a secret to be set');
        }
        const orderId = parseInt (id);
        const accountName = this.safeString (params, 'account');
        const actions = [ {
            'account': 'dex',
            'name': 'cancelorder',
            'data': {
                'account': accountName,
                'order_id': orderId,
            },
            'authorization': [ {
                'actor': accountName,
                'permission': 'active',
            } ],
        }, {
            'account': 'dex',
            'name': 'withdrawall',
            'data': {
                'account': accountName,
            },
            'authorization': [ {
                'actor': accountName,
                'permission': 'active',
            } ],
        } ];
        const request = {
            'transaction': { actions },
        };
        let data = undefined;
        let retries = 5;
        while (retries > 0) {
            try {
                const serResponse = await this.publicPostOrdersSerialize (this.extend (request));
                const result = this.safeValue (serResponse, 'data', []);
                const tx = hexToBytes (result['serialized_tx_hex']);
                const signatures = this.getSignatures (tx);
                const orderRequest = {
                    'serialized_tx_hex': String (result['serialized_tx_hex']),
                    'signatures': signatures,
                };
                const response = await this.publicPostOrdersSubmit (this.extend (orderRequest));
                data = this.safeValue (response, 'data', []);
                retries = 0;
            } catch (e) {
                if (this.last_json_response) {
                    const message = this.safeString (this.last_json_response.error.details[0], 'message');
                    if (message === 'is_canonical( c ): signature is not canonical') {
                        --retries;
                    } else {
                        retries = 0;
                    }
                }
                if (!retries) {
                    throw e;
                }
            }
        }
        return data;
    }

    async getorderIds (name: string, symbol: string) {
        try {
            const cancelList = [];
            let i = 0;
            while (true) {
                const ordersList = await this.fetchOpenOrders (symbol, 1, 100, { 'account': name, 'offset': 100 * i, 'ordinal_order_ids': '' });
                if (!ordersList.length) {
                    break;
                }
                for (let j = 0; j < ordersList.length; j++) {
                    cancelList.push (ordersList[j]['id']);
                }
                ++i;
            }
            return cancelList;
        } catch (e) {
            throw new OrderNotFound (' calcelAllOrders() error: order not found');
        }
    }

    async cancelAllOrders (symbol = undefined, params = {}) {
        /**
         * @method
         * @name bittrex#cancelAllOrders
         * @description cancel all open orders
         * @param {string|undefined} symbol unified market symbol, only orders in the market of this symbol are cancelled when symbol is not undefined
         * @param {object} params extra parameters specific to the bittrex api endpoint
         * @returns {[object]} a list of [order structures]{@link https://docs.ccxt.com/#/?id=order-structure}
         */
        await this.loadMarkets ();
        const market = this.market (symbol);
        if (this.secret === undefined) {
            throw new ArgumentsRequired ('cancelOrder call requires a secret to be set');
        }
        const accountName = this.safeString (params, 'account');
        const orderList = await this.getorderIds (accountName, market['symbol']);
        if (!orderList.length) {
            throw new OrderNotFound (' calcelAllOrders() error: no orders found');
        }
        const actions = [];
        for (let i = 0; i < orderList.length; i++) {
            const action = {
                'account': 'dex',
                'name': 'cancelorder',
                'data': {
                    'account': accountName,
                    'order_id': orderList[i],
                },
                'authorization': [ {
                    'actor': accountName,
                    'permission': 'active',
                } ],
            };
            actions.push (action);
        }
        const withdrawAction = {
            'account': 'dex',
            'name': 'withdrawall',
            'data': {
                'account': accountName,
            },
            'authorization': [ {
                'actor': accountName,
                'permission': 'active',
            } ],
        };
        actions.push (withdrawAction);
        const request = {
            'transaction': { actions },
        };
        let data = undefined;
        let retries = 5;
        while (retries > 0) {
            try {
                const serResponse = await this.publicPostOrdersSerialize (this.extend (request));
                const result = this.safeValue (serResponse, 'data', []);
                const tx = hexToBytes (result['serialized_tx_hex']);
                const signatures = this.getSignatures (tx);
                const orderRequest = {
                    'serialized_tx_hex': String (result['serialized_tx_hex']),
                    'signatures': signatures,
                };
                const response = await this.publicPostOrdersSubmit (this.extend (orderRequest));
                data = this.safeValue (response, 'data', []);
                retries = 0;
            } catch (e) {
                if (this.last_json_response) {
                    const message = this.safeString (this.last_json_response.error.details[0], 'message');
                    if (message === 'is_canonical( c ): signature is not canonical') {
                        --retries;
                    } else {
                        retries = 0;
                    }
                }
                if (!retries) {
                    throw e;
                }
            }
        }
        return data;
    }

    sign (path, api = 'public', method = 'GET', params = {}, headers = undefined, body = undefined) {
        let url = this.urls['api']['rest'];
        let request = '/' + this.version + '/' + this.implodeParams (path, params);
        const query = this.omit (params, this.extractParams (path));
        const implodedPath = this.implodeParams (path, params);
        if (api === 'public') {
            if ((method === 'POST') || (method === 'PUT') || (method === 'DELETE')) {
                if (Object.keys (query).length) {
                    body = this.json (query);
                }
                headers = {
                    'Content-Type': 'application/json',
                };
            } else if (Object.keys (query).length) {
                request += '?' + this.urlencode (query);
            }
        } else {
            this.checkRequiredCredentials ();
            const timestamp = this.nonce ().toString ();
            let auth = method + "\n"; // eslint-disable-line quotes
            url += '/' + implodedPath;
            auth += '/' + implodedPath;
            if ((method === 'POST') || (method === 'PUT') || (method === 'DELETE')) {
                auth += "\n"; // eslint-disable-line quotes
                if (Object.keys (query).length) {
                    body = this.json (query);
                    auth += 'requestBody=' + body + '&';
                }
                auth += 'signTimestamp=' + timestamp;
            } else {
                let sortedQuery = this.extend ({ 'signTimestamp': timestamp }, query);
                sortedQuery = this.keysort (sortedQuery);
                auth += "\n" + this.urlencode (sortedQuery); // eslint-disable-line quotes
                if (Object.keys (query).length) {
                    url += '?' + this.urlencode (query);
                }
            }
            const signature = this.hmac (this.encode (auth), this.encode (this.secret), sha256, 'base64');
            headers = {
                'Content-Type': 'application/json',
                'key': this.apiKey,
                'signTimestamp': timestamp,
                'signature': signature,
            };
        }
        url = url + request;
        return { 'url': url, 'method': method, 'body': body, 'headers': headers };
    }

    handleErrors (code, reason, url, method, headers, body, response, requestHeaders, requestBody) {
        if (!response) {
            return; // fallback to default error handler
        }
        const error = this.safeValue (response, 'error');
        if (error !== undefined) {
            const errorCode = this.safeString (error, 'code');
            const feedback = this.id + ' ' + body;
            this.throwExactlyMatchedException (this.exceptions, errorCode, feedback);
            throw new ExchangeError (feedback); // unknown message
        }
    }
}

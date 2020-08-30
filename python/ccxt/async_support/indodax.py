# -*- coding: utf-8 -*-

# PLEASE DO NOT EDIT THIS FILE, IT IS GENERATED AND WILL BE OVERWRITTEN:
# https://github.com/ccxt/ccxt/blob/master/CONTRIBUTING.md#how-to-contribute-code

from ccxt.async_support.base.exchange import Exchange
import hashlib
from ccxt.base.errors import ExchangeError
from ccxt.base.errors import AuthenticationError
from ccxt.base.errors import ArgumentsRequired
from ccxt.base.errors import BadSymbol
from ccxt.base.errors import InsufficientFunds
from ccxt.base.errors import InvalidOrder
from ccxt.base.errors import OrderNotFound


class indodax(Exchange):

    def describe(self):
        return self.deep_extend(super(indodax, self).describe(), {
            'id': 'indodax',
            'name': 'INDODAX',
            'countries': ['ID'],  # Indonesia
            'has': {
                'cancelOrder': True,
                'CORS': False,
                'createMarketOrder': False,
                'createOrder': True,
                'fetchBalance': True,
                'fetchClosedOrders': True,
                'fetchCurrencies': False,
                'fetchMarkets': True,
                'fetchMyTrades': False,
                'fetchOpenOrders': True,
                'fetchOrder': True,
                'fetchOrderBook': True,
                'fetchOrders': False,
                'fetchTicker': True,
                'fetchTickers': False,
                'fetchTime': True,
                'fetchTrades': True,
                'withdraw': True,
            },
            'version': '2.0',  # as of 9 April 2018
            'urls': {
                'logo': 'https://user-images.githubusercontent.com/51840849/87070508-9358c880-c221-11ea-8dc5-5391afbbb422.jpg',
                'api': {
                    'public': 'https://indodax.com/api',
                    'private': 'https://indodax.com/tapi',
                },
                'www': 'https://www.indodax.com',
                'doc': 'https://github.com/btcid/indodax-official-api-docs',
                'referral': 'https://indodax.com/ref/testbitcoincoid/1',
            },
            'api': {
                'public': {
                    'get': [
                        'server_time',
                        'pairs',
                        '{pair}/ticker',
                        '{pair}/trades',
                        '{pair}/depth',
                    ],
                },
                'private': {
                    'post': [
                        'getInfo',
                        'transHistory',
                        'trade',
                        'tradeHistory',
                        'getOrder',
                        'openOrders',
                        'cancelOrder',
                        'orderHistory',
                        'withdrawCoin',
                    ],
                },
            },
            'fees': {
                'trading': {
                    'tierBased': False,
                    'percentage': True,
                    'maker': 0,
                    'taker': 0.003,
                },
            },
            'exceptions': {
                'exact': {
                    'invalid_pair': BadSymbol,  # {"error":"invalid_pair","error_description":"Invalid Pair"}
                    'Insufficient balance.': InsufficientFunds,
                    'invalid order.': OrderNotFound,
                    'Invalid credentials. API not found or session has expired.': AuthenticationError,
                    'Invalid credentials. Bad sign.': AuthenticationError,
                },
                'broad': {
                    'Minimum price': InvalidOrder,
                    'Minimum order': InvalidOrder,
                },
            },
            # exchange-specific options
            'options': {
                'recvWindow': 5 * 1000,  # default 5 sec
                'timeDifference': 0,  # the difference between system clock and exchange clock
                'adjustForTimeDifference': False,  # controls the adjustment logic upon instantiation
            },
            'commonCurrencies': {
                'STR': 'XLM',
                'BCHABC': 'BCH',
                'BCHSV': 'BSV',
                'DRK': 'DASH',
                'NEM': 'XEM',
            },
        })

    def nonce(self):
        return self.milliseconds() - self.options['timeDifference']

    async def fetch_time(self, params={}):
        response = await self.publicGetServerTime(params)
        #
        #     {
        #         "timezone": "UTC",
        #         "server_time": 1571205969552
        #     }
        #
        return self.safe_integer(response, 'server_time')

    async def load_time_difference(self, params={}):
        serverTime = await self.fetch_time(params)
        after = self.milliseconds()
        self.options['timeDifference'] = after - serverTime
        return self.options['timeDifference']

    async def fetch_markets(self, params={}):
        response = await self.publicGetPairs(params)
        #
        #     [
        #         {
        #             "id": "btcidr",
        #             "symbol": "BTCIDR",
        #             "base_currency": "idr",
        #             "traded_currency": "btc",
        #             "traded_currency_unit": "BTC",
        #             "description": "BTC/IDR",
        #             "ticker_id": "btc_idr",
        #             "volume_precision": 0,
        #             "price_precision": 1000,
        #             "price_round": 8,
        #             "pricescale": 1000,
        #             "trade_min_base_currency": 10000,
        #             "trade_min_traded_currency": 0.00007457,
        #             "has_memo": False,
        #             "memo_name": False,
        #             "has_payment_id": False,
        #             "trade_fee_percent": 0.3,
        #             "url_logo": "https://indodax.com/v2/logo/svg/color/btc.svg",
        #             "url_logo_png": "https://indodax.com/v2/logo/png/color/btc.png",
        #             "is_maintenance": 0
        #         }
        #     ]
        #
        result = []
        for i in range(0, len(response)):
            market = response[i]
            id = self.safe_string(market, 'ticker_id')
            baseId = self.safe_string(market, 'traded_currency')
            quoteId = self.safe_string(market, 'base_currency')
            base = self.safe_currency_code(baseId)
            quote = self.safe_currency_code(quoteId)
            symbol = base + '/' + quote
            taker = self.safe_float(market, 'trade_fee_percent')
            isMaintenance = self.safe_integer(market, 'is_maintenance')
            active = False if (isMaintenance) else True
            pricePrecision = self.safe_integer(market, 'price_round')
            precision = {
                'amount': 8,
                'price': pricePrecision,
            }
            limits = {
                'amount': {
                    'min': self.safe_float(market, 'trade_min_traded_currency'),
                    'max': None,
                },
                'price': {
                    'min': self.safe_float(market, 'trade_min_base_currency'),
                    'max': None,
                },
                'cost': {
                    'min': None,
                    'max': None,
                },
            }
            result.append({
                'id': id,
                'symbol': symbol,
                'base': base,
                'quote': quote,
                'baseId': baseId,
                'quoteId': quoteId,
                'taker': taker,
                'percentage': True,
                'precision': precision,
                'limits': limits,
                'info': market,
                'active': active,
            })
        return result

    async def fetch_balance(self, params={}):
        await self.load_markets()
        response = await self.privatePostGetInfo(params)
        balances = self.safe_value(response, 'return', {})
        free = self.safe_value(balances, 'balance', {})
        used = self.safe_value(balances, 'balance_hold', {})
        result = {'info': response}
        currencyIds = list(free.keys())
        for i in range(0, len(currencyIds)):
            currencyId = currencyIds[i]
            code = self.safe_currency_code(currencyId)
            account = self.account()
            account['free'] = self.safe_float(free, currencyId)
            account['used'] = self.safe_float(used, currencyId)
            result[code] = account
        return self.parse_balance(result)

    async def fetch_order_book(self, symbol, limit=None, params={}):
        await self.load_markets()
        request = {
            'pair': self.market_id(symbol),
        }
        orderbook = await self.publicGetPairDepth(self.extend(request, params))
        return self.parse_order_book(orderbook, None, 'buy', 'sell')

    async def fetch_ticker(self, symbol, params={}):
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'pair': market['id'],
        }
        response = await self.publicGetPairTicker(self.extend(request, params))
        #
        #     {
        #         "ticker": {
        #             "high":"0.01951",
        #             "low":"0.01877",
        #             "vol_eth":"39.38839319",
        #             "vol_btc":"0.75320886",
        #             "last":"0.01896",
        #             "buy":"0.01896",
        #             "sell":"0.019",
        #             "server_time":1565248908
        #         }
        #     }
        #
        ticker = response['ticker']
        timestamp = self.safe_timestamp(ticker, 'server_time')
        baseVolume = 'vol_' + market['baseId'].lower()
        quoteVolume = 'vol_' + market['quoteId'].lower()
        last = self.safe_float(ticker, 'last')
        return {
            'symbol': symbol,
            'timestamp': timestamp,
            'datetime': self.iso8601(timestamp),
            'high': self.safe_float(ticker, 'high'),
            'low': self.safe_float(ticker, 'low'),
            'bid': self.safe_float(ticker, 'buy'),
            'bidVolume': None,
            'ask': self.safe_float(ticker, 'sell'),
            'askVolume': None,
            'vwap': None,
            'open': None,
            'close': last,
            'last': last,
            'previousClose': None,
            'change': None,
            'percentage': None,
            'average': None,
            'baseVolume': self.safe_float(ticker, baseVolume),
            'quoteVolume': self.safe_float(ticker, quoteVolume),
            'info': ticker,
        }

    def parse_trade(self, trade, market=None):
        timestamp = self.safe_timestamp(trade, 'date')
        id = self.safe_string(trade, 'tid')
        symbol = None
        if market is not None:
            symbol = market['symbol']
        type = None
        side = self.safe_string(trade, 'type')
        price = self.safe_float(trade, 'price')
        amount = self.safe_float(trade, 'amount')
        cost = None
        if price is not None:
            if amount is not None:
                cost = price * amount
        return {
            'id': id,
            'info': trade,
            'timestamp': timestamp,
            'datetime': self.iso8601(timestamp),
            'symbol': symbol,
            'type': type,
            'side': side,
            'order': None,
            'takerOrMaker': None,
            'price': price,
            'amount': amount,
            'cost': cost,
            'fee': None,
        }

    async def fetch_trades(self, symbol, since=None, limit=None, params={}):
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'pair': market['id'],
        }
        response = await self.publicGetPairTrades(self.extend(request, params))
        return self.parse_trades(response, market, since, limit)

    def parse_order(self, order, market=None):
        #
        #     {
        #         "order_id": "12345",
        #         "submit_time": "1392228122",
        #         "price": "8000000",
        #         "type": "sell",
        #         "order_ltc": "100000000",
        #         "remain_ltc": "100000000"
        #     }
        #
        side = None
        if 'type' in order:
            side = order['type']
        status = self.safe_string(order, 'status', 'open')
        if status == 'filled':
            status = 'closed'
        elif status == 'cancelled':
            status = 'canceled'
        symbol = None
        cost = None
        price = self.safe_float(order, 'price')
        amount = None
        remaining = None
        filled = None
        if market is not None:
            symbol = market['symbol']
            quoteId = market['quoteId']
            baseId = market['baseId']
            if (market['quoteId'] == 'idr') and ('order_rp' in order):
                quoteId = 'rp'
            if (market['baseId'] == 'idr') and ('remain_rp' in order):
                baseId = 'rp'
            cost = self.safe_float(order, 'order_' + quoteId)
            if cost:
                amount = cost / price
                remainingCost = self.safe_float(order, 'remain_' + quoteId)
                if remainingCost is not None:
                    remaining = remainingCost / price
                    filled = amount - remaining
            else:
                amount = self.safe_float(order, 'order_' + baseId)
                cost = price * amount
                remaining = self.safe_float(order, 'remain_' + baseId)
                filled = amount - remaining
        average = None
        if filled:
            average = cost / filled
        timestamp = self.safe_integer(order, 'submit_time')
        fee = None
        id = self.safe_string(order, 'order_id')
        return {
            'info': order,
            'id': id,
            'clientOrderId': None,
            'timestamp': timestamp,
            'datetime': self.iso8601(timestamp),
            'lastTradeTimestamp': None,
            'symbol': symbol,
            'type': 'limit',
            'side': side,
            'price': price,
            'cost': cost,
            'average': average,
            'amount': amount,
            'filled': filled,
            'remaining': remaining,
            'status': status,
            'fee': fee,
            'trades': None,
        }

    async def fetch_order(self, id, symbol=None, params={}):
        if symbol is None:
            raise ArgumentsRequired(self.id + ' fetchOrder requires a symbol')
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'pair': market['id'],
            'order_id': id,
        }
        response = await self.privatePostGetOrder(self.extend(request, params))
        orders = response['return']
        order = self.parse_order(self.extend({'id': id}, orders['order']), market)
        return self.extend({'info': response}, order)

    async def fetch_open_orders(self, symbol=None, since=None, limit=None, params={}):
        await self.load_markets()
        market = None
        request = {}
        if symbol is not None:
            market = self.market(symbol)
            request['pair'] = market['id']
        response = await self.privatePostOpenOrders(self.extend(request, params))
        rawOrders = response['return']['orders']
        # {success: 1, return: {orders: null}} if no orders
        if not rawOrders:
            return []
        # {success: 1, return: {orders: [... objects]}} for orders fetched by symbol
        if symbol is not None:
            return self.parse_orders(rawOrders, market, since, limit)
        # {success: 1, return: {orders: {marketid: [... objects]}}} if all orders are fetched
        marketIds = list(rawOrders.keys())
        exchangeOrders = []
        for i in range(0, len(marketIds)):
            marketId = marketIds[i]
            marketOrders = rawOrders[marketId]
            market = self.markets_by_id[marketId]
            parsedOrders = self.parse_orders(marketOrders, market, since, limit)
            exchangeOrders = self.array_concat(exchangeOrders, parsedOrders)
        return exchangeOrders

    async def fetch_closed_orders(self, symbol=None, since=None, limit=None, params={}):
        if symbol is None:
            raise ArgumentsRequired(self.id + ' fetchOrders requires a symbol argument')
        await self.load_markets()
        request = {}
        market = None
        if symbol is not None:
            market = self.market(symbol)
            request['pair'] = market['id']
        response = await self.privatePostOrderHistory(self.extend(request, params))
        orders = self.parse_orders(response['return']['orders'], market, since, limit)
        orders = self.filter_by(orders, 'status', 'closed')
        if symbol is not None:
            return self.filter_by_symbol(orders, symbol)
        return orders

    async def create_order(self, symbol, type, side, amount, price=None, params={}):
        if type != 'limit':
            raise ExchangeError(self.id + ' allows limit orders only')
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'pair': market['id'],
            'type': side,
            'price': price,
        }
        currency = market['baseId']
        if side == 'buy':
            request[market['quoteId']] = amount * price
        else:
            request[market['baseId']] = amount
        request[currency] = amount
        result = await self.privatePostTrade(self.extend(request, params))
        return {
            'info': result,
            'id': str(result['return']['order_id']),
        }

    async def cancel_order(self, id, symbol=None, params={}):
        if symbol is None:
            raise ArgumentsRequired(self.id + ' cancelOrder requires a symbol argument')
        side = self.safe_value(params, 'side')
        if side is None:
            raise ArgumentsRequired(self.id + ' cancelOrder requires an extra "side" param')
        await self.load_markets()
        market = self.market(symbol)
        request = {
            'order_id': id,
            'pair': market['id'],
            'type': side,
        }
        return await self.privatePostCancelOrder(self.extend(request, params))

    async def withdraw(self, code, amount, address, tag=None, params={}):
        self.check_address(address)
        await self.load_markets()
        currency = self.currency(code)
        # Custom string you need to provide to identify each withdrawal.
        # Will be passed to callback URL(assigned via website to the API key)
        # so your system can identify the request and confirm it.
        # Alphanumeric, max length 255.
        requestId = self.milliseconds()
        # Alternatively:
        # requestId = self.uuid()
        request = {
            'currency': currency['id'],
            'withdraw_amount': amount,
            'withdraw_address': address,
            'request_id': str(requestId),
        }
        if tag:
            request['withdraw_memo'] = tag
        response = await self.privatePostWithdrawCoin(self.extend(request, params))
        #
        #     {
        #         "success": 1,
        #         "status": "approved",
        #         "withdraw_currency": "xrp",
        #         "withdraw_address": "rwWr7KUZ3ZFwzgaDGjKBysADByzxvohQ3C",
        #         "withdraw_amount": "10000.00000000",
        #         "fee": "2.00000000",
        #         "amount_after_fee": "9998.00000000",
        #         "submit_time": "1509469200",
        #         "withdraw_id": "xrp-12345",
        #         "txid": "",
        #         "withdraw_memo": "123123"
        #     }
        #
        id = None
        if ('txid' in response) and (len(response['txid']) > 0):
            id = response['txid']
        return {
            'info': response,
            'id': id,
        }

    def sign(self, path, api='public', method='GET', params={}, headers=None, body=None):
        url = self.urls['api'][api]
        if api == 'public':
            url += '/' + self.implode_params(path, params)
        else:
            self.check_required_credentials()
            body = self.urlencode(self.extend({
                'method': path,
                'timestamp': self.nonce(),
                'recvWindow': self.options['recvWindow'],
            }, params))
            headers = {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Key': self.apiKey,
                'Sign': self.hmac(self.encode(body), self.encode(self.secret), hashlib.sha512),
            }
        return {'url': url, 'method': method, 'body': body, 'headers': headers}

    def handle_errors(self, code, reason, url, method, headers, body, response, requestHeaders, requestBody):
        if response is None:
            return
        # {success: 0, error: "invalid order."}
        # or
        # [{data, ...}, {...}, ...]
        if isinstance(response, list):
            return  # public endpoints may return []-arrays
        error = self.safe_value(response, 'error', '')
        if not ('success' in response) and error == '':
            return  # no 'success' property on public responses
        if self.safe_integer(response, 'success', 0) == 1:
            # {success: 1, return: {orders: []}}
            if not ('return' in response):
                raise ExchangeError(self.id + ': malformed response: ' + self.json(response))
            else:
                return
        feedback = self.id + ' ' + body
        self.throw_exactly_matched_exception(self.exceptions['exact'], error, feedback)
        self.throw_broadly_matched_exception(self.exceptions['broad'], error, feedback)
        raise ExchangeError(feedback)  # unknown message

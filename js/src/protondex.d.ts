import Exchange from './abstract/protondex.js';
import { Int, Trade, OrderSide } from './base/types.js';
export default class protondex extends Exchange {
    describe(): any;
    fetchMarkets(params?: {}): Promise<any[]>;
    parseTicker(ticker: any, market?: any): import("./base/types.js").Ticker;
    fetchTicker(symbol: any, params?: {}): Promise<any>;
    fetchTickers(symbols?: any, params?: {}): Promise<any>;
    fetchOrderBook(symbol: any, limit?: any, params?: {}): Promise<import("./base/types.js").OrderBook>;
    parseTrade(trade: any, market?: any): Trade;
    parseTrades(trades: any, market?: object, since?: Int, limit?: Int, params?: {}): Trade[];
    fetchMyTrades(symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    fetchClosedOrders(symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").Order[]>;
    fetchOrders(symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").Order[]>;
    fetchTrades(symbol: string, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    fetchTradingFees(params?: {}): Promise<{}>;
    parseBalance(response: any): import("./base/types.js").Balances;
    fetchBalance(params?: {}): Promise<import("./base/types.js").Balances>;
    parseDepositAddress(depositAddress: any, currency?: any): {
        currency: any;
        address: string;
        tag: string;
        network: any;
        info: any;
    };
    parseOrderStatus(status: any): string;
    parseOrder(order: any, market?: any): import("./base/types.js").Order;
    fetchOrder(id: string, symbol?: string, params?: {}): Promise<import("./base/types.js").Order>;
    fetchOrderTrades(id: string, symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<Trade[]>;
    fetchOpenOrders(symbol?: string, since?: Int, limit?: Int, params?: {}): Promise<import("./base/types.js").Order[]>;
    fetchDeposits(code?: any, since?: any, limit?: any, params?: {}): Promise<any>;
    fetchWithdrawals(code?: any, since?: any, limit?: any, params?: {}): Promise<any>;
    parseTransactionStatus(status: any): string;
    parseTransaction(transaction: any, currency?: any): {
        info: any;
        id: string;
        txid: string;
        timestamp: any;
        datetime: any;
        network: any;
        address: string;
        addressTo: any;
        addressFrom: any;
        tag: string;
        tagTo: any;
        tagFrom: any;
        type: string;
        amount: number;
        currency: any;
        status: string;
        updated: any;
        fee: {
            currency: any;
            cost: number;
        };
    };
    nonce(): number;
    fetchStatusSync(params?: {}): Promise<any>;
    fetchOHLCV(symbol: string, timeframe?: string, since?: Int, limit?: Int, params?: {}): Promise<any>;
    digestSuffixRipemd160(data: any, suffix: string): Uint8Array;
    keyToString(keyData: any, suffix: string, prefix: string): string;
    stringToKey(s: string, size: number, suffix: string): Uint8Array;
    fromElliptic(ellipticSig: any): string;
    getSignatures(transHex: any): string[];
    setSandboxMode(enable: any): void;
    createOrder(symbol: string, type: any, side: OrderSide, amount: any, price?: any, params?: {}): Promise<import("./base/types.js").Order>;
    cancelOrder(id: string, symbol?: string, params?: {}): Promise<any>;
    getorderIds(name: string, symbol: string): Promise<any[]>;
    cancelAllOrders(symbol?: any, params?: {}): Promise<any>;
    sign(path: any, api?: string, method?: string, params?: {}, headers?: any, body?: any): {
        url: any;
        method: string;
        body: any;
        headers: any;
    };
    handleErrors(code: any, reason: any, url: any, method: any, headers: any, body: any, response: any, requestHeaders: any, requestBody: any): void;
}

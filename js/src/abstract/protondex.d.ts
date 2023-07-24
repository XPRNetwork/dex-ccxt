import { implicitReturnType } from '../base/types.js';
import { Exchange as _Exchange } from '../base/Exchange.js';
interface Exchange {
    publicGetMarketsAll(params?: {}): Promise<implicitReturnType>;
    publicGetOrdersOpen(params?: {}): Promise<implicitReturnType>;
    publicGetOrdersHistory(params?: {}): Promise<implicitReturnType>;
    publicGetOrdersLifecycle(params?: {}): Promise<implicitReturnType>;
    publicGetOrdersDepth(params?: {}): Promise<implicitReturnType>;
    publicGetTradesDaily(params?: {}): Promise<implicitReturnType>;
    publicGetTradesHistory(params?: {}): Promise<implicitReturnType>;
    publicGetTradesRecent(params?: {}): Promise<implicitReturnType>;
    publicGetChartOhlcv(params?: {}): Promise<implicitReturnType>;
    publicGetStatusSync(params?: {}): Promise<implicitReturnType>;
    publicGetAccountBalances(params?: {}): Promise<implicitReturnType>;
    publicPostOrdersSerialize(params?: {}): Promise<implicitReturnType>;
    publicPostOrdersSubmit(params?: {}): Promise<implicitReturnType>;
    privateGetUserFees(params?: {}): Promise<implicitReturnType>;
    privateGetAccountDeposits(params?: {}): Promise<implicitReturnType>;
    privateGetAccountWithdrawals(params?: {}): Promise<implicitReturnType>;
}
declare abstract class Exchange extends _Exchange {
}
export default Exchange;

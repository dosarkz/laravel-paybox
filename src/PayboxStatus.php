<?php

namespace Dosarkz\Paybox;

class PayboxStatus
{
    const PG_STATUS_OK = 'ok';
    const PG_STATUS_ERROR = 'error';

    const PG_TS_STATUS_PARTIAL = 'partial';
    const PG_TS_STATUS_PENDING = 'pending';
    const PG_TS_STATUS_REFUNDED = 'refunded';
    const PG_TS_STATUS_REVOKED = 'revoked';
    const PG_TS_STATUS_OK = 'ok';
    const PG_TS_STATUS_FAILED = 'failed';
    const PG_TS_STATUS_INCOMPLETE = 'incomplete';

    const PG_STATUSES = [
        self::PG_TS_STATUS_PARTIAL => "Новый платеж",
        self::PG_TS_STATUS_PENDING => "Ожидание плательщика или платежной системы",
        self::PG_TS_STATUS_REFUNDED => "По платежу прошел возврат",
        self::PG_TS_STATUS_REVOKED => "По платежу прошла отмена",
        self::PG_TS_STATUS_OK => "Платеж успешно завершен",
        self::PG_TS_STATUS_FAILED => "Платеж в ошибке",
        self::PG_TS_STATUS_INCOMPLETE => "Истекло время жизни платежа",
    ];

    public string $pg_status;
    public string $pg_payment_id;
    public string $pg_transaction_status;
    public int $pg_pg_can_reject;
    public int $pg_testing_mode;
    public int $pg_captured;
    public string $pg_card_pan;
    public string $pg_create_date;
    public string $pg_salt;
    public string $pg_sig;

    /**
     * @return string
     */
    public function getPgStatus(): string
    {
        return $this->pg_status;
    }

    /**
     * @param string $pg_status
     */
    public function setPgStatus(string $pg_status): void
    {
        $this->pg_status = $pg_status;
    }

    /**
     * @return string
     */
    public function getPgPaymentId(): string
    {
        return $this->pg_payment_id;
    }

    /**
     * @param string $pg_payment_id
     */
    public function setPgPaymentId(string $pg_payment_id): void
    {
        $this->pg_payment_id = $pg_payment_id;
    }

    /**
     * @return string
     */
    public function getPgTransactionStatus(): string
    {
        return $this->pg_transaction_status;
    }

    /**
     * @param string $pg_transaction_status
     */
    public function setPgTransactionStatus(string $pg_transaction_status): void
    {
        $this->pg_transaction_status = $pg_transaction_status;
    }

    /**
     * @return int
     */
    public function getPgPgCanReject(): int
    {
        return $this->pg_pg_can_reject;
    }

    /**
     * @param int $pg_pg_can_reject
     */
    public function setPgPgCanReject(int $pg_pg_can_reject): void
    {
        $this->pg_pg_can_reject = $pg_pg_can_reject;
    }

    /**
     * @return int
     */
    public function getPgTestingMode(): int
    {
        return $this->pg_testing_mode;
    }

    /**
     * @param int $pg_testing_mode
     */
    public function setPgTestingMode(int $pg_testing_mode): void
    {
        $this->pg_testing_mode = $pg_testing_mode;
    }

    /**
     * @return int
     */
    public function getPgCaptured(): int
    {
        return $this->pg_captured;
    }

    /**
     * @param int $pg_captured
     */
    public function setPgCaptured(int $pg_captured): void
    {
        $this->pg_captured = $pg_captured;
    }

    /**
     * @return string
     */
    public function getPgCardPan(): string
    {
        return $this->pg_card_pan;
    }

    /**
     * @param string $pg_card_pan
     */
    public function setPgCardPan(string $pg_card_pan): void
    {
        $this->pg_card_pan = $pg_card_pan;
    }

    /**
     * @return string
     */
    public function getPgCreateDate(): string
    {
        return $this->pg_create_date;
    }

    /**
     * @param string $pg_create_date
     */
    public function setPgCreateDate(string $pg_create_date): void
    {
        $this->pg_create_date = $pg_create_date;
    }

    /**
     * @return string
     */
    public function getPgSalt(): string
    {
        return $this->pg_salt;
    }

    /**
     * @param string $pg_salt
     */
    public function setPgSalt(string $pg_salt): void
    {
        $this->pg_salt = $pg_salt;
    }

    /**
     * @return string
     */
    public function getPgSig(): string
    {
        return $this->pg_sig;
    }

    /**
     * @param string $pg_sig
     */
    public function setPgSig(string $pg_sig): void
    {
        $this->pg_sig = $pg_sig;
    }

    public function transactionStatus() : string
    {
        return self::PG_STATUSES[$this->getPgTransactionStatus()] ?? "Data not found";
    }
}

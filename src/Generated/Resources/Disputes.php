<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Disputes
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List disputes**
     *
     * The disputes buyers opened on the store's payments, as their payment providers reported them: the ones that need an answer first, soonest deadline first, then the rest newest first. `status` is how it reads on the dashboard: `needs_response`, `under_review`, `won`, `lost`, `accepted` or `closed` (ended with no chargeback). `providerStatus` is the provider's own last word, `stage` is `inquiry`, `chargeback`, `claim` (a PayPal case), `pre_arbitration` or `arbitration`, and `dueAt` when the provider stops taking an answer, where it says. `answeredFrom` is where it is answered: `here` (through this API: Stripe's, Revolut's, Adyen's, and PayPal's where PayPal is connected with API keys), `provider` (in the provider's own dashboard, named in `answerPlace`) or `none`. `meta.figures` is the dashboard's four: how many need an answer and how many are due within three days, the money in the open ones in the store's currency, how many ended won and lost in the last 90 days, and the orders disputed beside those that took money in that time.
     *
     * Needs the `disputes.read` permission (Read Disputes).
     *
     * Fields:
     *
     * - `q`: Part of the buyer's email, the order's ID or the provider's ID for the dispute.
     * - `show`: Only these: `open` is the two that have not ended. Left out, it is "all".
     * - `provider`: Only disputes with this payment method, by its ID.
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds. Left out, it is 20.
     *
     * @param array{
     *     q?: string,
     *     show?: 'all'|'open'|'needs_response'|'under_review'|'won'|'lost'|'accepted'|'closed',
     *     provider?: string,
     *     page?: int,
     *     perPage?: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: mixed,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/list-disputes
     */
    public function list(array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('disputes.list', [], $params, $options);
    }

    /**
     * **Export disputes**
     *
     * The disputes the same filters would list, as a CSV file, newest first. Add `check=1` for `{ rows }`, how many it would have, which is not counted. A store exports at most 30 files every 10 minutes, whatever they are of and whoever asks: after that the answer is 429.
     *
     * Needs the `disputes.read` permission (Read Disputes). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * Fields:
     *
     * - `q`: Part of the buyer's email, the order's ID or the provider's ID for the dispute.
     * - `show`: Only these: `open` is the two that have not ended. Left out, it is "all".
     * - `provider`: Only disputes with this payment method, by its ID.
     *
     * @param array{
     *     q?: string,
     *     show?: 'all'|'open'|'needs_response'|'under_review'|'won'|'lost'|'accepted'|'closed',
     *     provider?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/export-disputes
     */
    public function export(array $params = [], array $options = []): \Shoply\File
    {
        return $this->caller->call('disputes.export', [], $params, $options);
    }

    /**
     * **List an order's disputes**
     *
     * The disputes on one order, newest first, each as List disputes has it. Most orders have none; a payment disputed twice has two.
     *
     * Needs the `disputes.read` permission (Read Disputes).
     *
     * @param string $orderId The order, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: mixed,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/list-an-orders-disputes
     */
    public function forOrder(string $orderId, array $options = []): mixed
    {
        return $this->caller->call('disputes.forOrder', [$orderId], [], $options);
    }

    /**
     * **Get a dispute**
     *
     * One dispute with everything its page shows. `records` is what Shoply recorded about the order, in four groups (the buyer, the order, after delivery, history), each fact a `name` and a `value` in words, `strong` on the order being opened again from the address it was paid from. A delivered license key or file is never in it. `activity` is every look at the order after delivery, a line each. `draft` is the store's answer as it was left, with `statement`, the whole of what is sent. `can` says what may be done now: `edit`, `submit`, `accept` and `markSubmitted`. `files` are the store's own files for the answer, `after` what was done on Shoply's side (the buyer blacklisted, their keys and files hidden), and `history` the dispute's story, newest first.
     *
     * Needs the `disputes.read` permission (Read Disputes).
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: mixed,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed,
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: int|float,
     *         currency: string,
     *         dateCreated: string
     *     },
     *     can: array{
     *         edit: bool,
     *         submit: bool,
     *         accept: bool,
     *         markSubmitted: bool
     *     },
     *     records: list<array{
     *         key: string,
     *         title: string,
     *         facts: list<array{
     *             key: string,
     *             name: string,
     *             value: string,
     *             strong: bool
     *         }>
     *     }>,
     *     activity: list<string>,
     *     draft: array{
     *         decision: string,
     *         contacted: string,
     *         used: string,
     *         words: string,
     *         saved: bool,
     *         statement: string
     *     },
     *     files: array<mixed>,
     *     after: list<array{
     *         key: string,
     *         done: bool,
     *         text: string
     *     }>,
     *     history: list<array{
     *         at: string,
     *         what: string,
     *         detail: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/get-a-dispute
     */
    public function get(string $disputeId, array $options = []): mixed
    {
        return $this->caller->call('disputes.get', [$disputeId], [], $options);
    }

    /**
     * **Save a dispute's answer**
     *
     * Keeps the fields named and leaves the rest, while the answer can still change: nothing has been sent or accepted, and the dispute has not ended. Answers 409 `not_answerable` after that. Sends nothing anywhere.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * Fields:
     *
     * - `decision`: Whether to fight it or accept it.
     * - `contacted`: Whether the buyer contacted the store before disputing. Empty when not said.
     * - `used`: Whether they used what they bought, or `unknown`. Empty when not said.
     * - `words`: The store's statement in its own words, up to 10,000 characters. Sent apart from what Shoply recorded.
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{
     *     decision?: 'fight'|'accept',
     *     contacted?: ''|'yes'|'no',
     *     used?: ''|'yes'|'unknown',
     *     words?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: mixed,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed,
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: int|float,
     *         currency: string,
     *         dateCreated: string
     *     },
     *     can: array{
     *         edit: bool,
     *         submit: bool,
     *         accept: bool,
     *         markSubmitted: bool
     *     },
     *     records: list<array{
     *         key: string,
     *         title: string,
     *         facts: list<array{
     *             key: string,
     *             name: string,
     *             value: string,
     *             strong: bool
     *         }>
     *     }>,
     *     activity: list<string>,
     *     draft: array{
     *         decision: string,
     *         contacted: string,
     *         used: string,
     *         words: string,
     *         saved: bool,
     *         statement: string
     *     },
     *     files: array<mixed>,
     *     after: list<array{
     *         key: string,
     *         done: bool,
     *         text: string
     *     }>,
     *     history: list<array{
     *         at: string,
     *         what: string,
     *         detail: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/save-a-disputes-answer
     */
    public function saveDraft(string $disputeId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('disputes.saveDraft', [$disputeId], $params, $options);
    }

    /**
     * **Submit a dispute's answer**
     *
     * Sends a dispute's answer to its provider, once: what Shoply recorded, Shoply's PDF of it, the store's own files, and the statement, in each provider's own shape. Stripe's evidence fields; Revolut's files and a challenge whose comment is the statement's first 250 characters; PayPal's evidence, appeal or supporting information, whichever the dispute takes now, with the statement as its notes; Adyen's documents under a defense reason, the statement in the PDF. It cannot be taken back. Any draft fields in the body are saved first. Answers 409 `answered_elsewhere` for a dispute answered in its provider's own dashboard, `not_answerable` for one not waiting on an answer, `past_due` once its deadline has passed, and `file_not_taken` for one of the store's files the provider does not take (Adyen takes no PNG, and a PDF of up to 2 MB). The provider refusing it is 502, with `stripe_key` or `provider_key` where the store's key or app may not answer disputes, and `provider_refused` otherwise, the dispute back to a draft with `answer.note` saying why. A store sends at most 20 answers or acceptances every 10 minutes.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * Fields:
     *
     * - `decision`: Whether to fight it or accept it.
     * - `contacted`: Whether the buyer contacted the store before disputing. Empty when not said.
     * - `used`: Whether they used what they bought, or `unknown`. Empty when not said.
     * - `words`: The store's statement in its own words, up to 10,000 characters. Sent apart from what Shoply recorded.
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{
     *     decision?: 'fight'|'accept',
     *     contacted?: ''|'yes'|'no',
     *     used?: ''|'yes'|'unknown',
     *     words?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/submit-a-disputes-answer
     */
    public function submit(string $disputeId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('disputes.submit', [$disputeId], $params, $options);
    }

    /**
     * **Accept a dispute**
     *
     * Concedes a dispute in its provider (Stripe, Revolut, Adyen, or PayPal's claim, which PayPal refunds from the store's account): the buyer keeps the money and the order becomes a chargeback. Cannot be undone. Answers as Submit does when it cannot be done, and counts toward the same 20 every 10 minutes.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/accept-a-dispute
     */
    public function accept(string $disputeId, array $options = []): mixed
    {
        return $this->caller->call('disputes.accept', [$disputeId], [], $options);
    }

    /**
     * **Mark a dispute as answered**
     *
     * Says the store answered a dispute in its provider's own dashboard (PayPal's Resolution Center, Revolut, Adyen, Whop, Shopify), which Shoply cannot send to. It then reads as under review, and its answer can no longer change. 409 `not_answerable` where it is not waiting on an answer there.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: string,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed,
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: int|float,
     *         currency: string,
     *         dateCreated: string
     *     },
     *     can: array{
     *         edit: bool,
     *         submit: bool,
     *         accept: bool,
     *         markSubmitted: bool
     *     },
     *     records: list<array{
     *         key: string,
     *         title: string,
     *         facts: list<array{
     *             key: string,
     *             name: string,
     *             value: string,
     *             strong: bool
     *         }>
     *     }>,
     *     activity: array<mixed>,
     *     draft: array{
     *         decision: string,
     *         contacted: string,
     *         used: string,
     *         words: string,
     *         saved: bool,
     *         statement: string
     *     },
     *     files: array<mixed>,
     *     after: list<array{
     *         key: string,
     *         done: bool,
     *         text: string
     *     }>,
     *     history: list<array{
     *         at: string,
     *         what: string,
     *         detail: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/mark-a-dispute-as-answered
     */
    public function markSubmitted(string $disputeId, array $options = []): mixed
    {
        return $this->caller->call('disputes.markSubmitted', [$disputeId], [], $options);
    }

    /**
     * **Get a dispute's PDF**
     *
     * The answer as one PDF, as it stands: the dispute, the store's statement, what Shoply recorded, every look at the order after delivery, and the store's refund policy and terms. For a provider that takes a file. Never a license key or a delivered file.
     *
     * Needs the `disputes.read` permission (Read Disputes).
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\File
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/get-a-disputes-pdf
     */
    public function packet(string $disputeId, array $options = []): \Shoply\File
    {
        return $this->caller->call('disputes.packet', [$disputeId], [], $options);
    }

    /**
     * **Add a file to a dispute's answer**
     *
     * One of the store's own files for the answer, sent as `multipart/form-data` in a field called `file`: a PDF, a PNG or a JPEG, its type read from the file itself. One of each `kind`, a new one in place of the one there was, and all of a dispute's files together up to 4 MB, which with Shoply's PDF is within Stripe's limit. Sent to Stripe as `customer_communication`, `receipt` and `service_documentation`, and to Revolut, PayPal and Adyen beside Shoply's PDF. For a dispute answered to Adyen, a PNG is refused as `invalid_type`, and a PDF over 2 MB as `too_large`: Adyen takes neither. A store adds at most 30 files every 10 minutes.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * Fields:
     *
     * - `kind`: What the file is: a chat with the buyer, a receipt, or something else. Left out, it is "other".
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string,
     *     kind?: 'communication'|'receipt'|'other'
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/add-a-file-to-a-disputes-answer
     */
    public function addFile(string $disputeId, array $params, array $options = []): mixed
    {
        return $this->caller->call('disputes.addFile', [$disputeId], $params, $options);
    }

    /**
     * **Remove a file from a dispute's answer**
     *
     * While the answer can still change.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * @param string $disputeId The dispute, by its ID.
     * @param string $fileId The file, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/remove-a-file-from-a-disputes-answer
     */
    public function deleteFile(string $disputeId, string $fileId, array $options = []): mixed
    {
        return $this->caller->call('disputes.deleteFile', [$disputeId, $fileId], [], $options);
    }

    /**
     * **Hide or show what an order delivered**
     *
     * Hides the order's license keys, files and instructions from its buyer for this dispute, on the order's page, in the customer panel and at its download links, or shows them again. What was emailed cannot be taken back. A dispute that is won shows them again by itself.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * Fields:
     *
     * - `hidden` (required): True to hide them, false to show them again.
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{
     *     hidden: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: mixed,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed,
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: int|float,
     *         currency: string,
     *         dateCreated: string
     *     },
     *     can: array{
     *         edit: bool,
     *         submit: bool,
     *         accept: bool,
     *         markSubmitted: bool
     *     },
     *     records: list<array{
     *         key: string,
     *         title: string,
     *         facts: list<array{
     *             key: string,
     *             name: string,
     *             value: string,
     *             strong: bool
     *         }>
     *     }>,
     *     activity: list<string>,
     *     draft: array{
     *         decision: string,
     *         contacted: string,
     *         used: string,
     *         words: string,
     *         saved: bool,
     *         statement: string
     *     },
     *     files: array<mixed>,
     *     after: list<array{
     *         key: string,
     *         done: bool,
     *         text: string
     *     }>,
     *     history: list<array{
     *         at: string,
     *         what: string,
     *         detail: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/hide-or-show-what-an-order-delivered
     */
    public function access(string $disputeId, array $params, array $options = []): mixed
    {
        return $this->caller->call('disputes.access', [$disputeId], $params, $options);
    }

    /**
     * **Blacklist a dispute's buyer**
     *
     * Puts the buyer's email and the addresses they ordered from on the blacklist, as a dispute does by itself where the store's settings say to. Rules already there are left as they are.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * @param string $disputeId The dispute, by its ID.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     id: string,
     *     orderId: string,
     *     email: string,
     *     provider: string,
     *     providerName: string,
     *     externalId: string,
     *     reason: string,
     *     reasonText: string,
     *     stage: string,
     *     providerStatus: string,
     *     status: string,
     *     amount: int|float,
     *     currency: string,
     *     dueAt: string,
     *     answer: array{
     *         state: string,
     *         at: mixed,
     *         by: string,
     *         note: string
     *     },
     *     answeredFrom: string,
     *     answerPlace: string,
     *     accessTaken: bool,
     *     dateCreated: string,
     *     dateClosed: mixed,
     *     order: array{
     *         id: string,
     *         status: string,
     *         amount: int|float,
     *         currency: string,
     *         dateCreated: string
     *     },
     *     can: array{
     *         edit: bool,
     *         submit: bool,
     *         accept: bool,
     *         markSubmitted: bool
     *     },
     *     records: list<array{
     *         key: string,
     *         title: string,
     *         facts: list<array{
     *             key: string,
     *             name: string,
     *             value: string,
     *             strong: bool
     *         }>
     *     }>,
     *     activity: list<string>,
     *     draft: array{
     *         decision: string,
     *         contacted: string,
     *         used: string,
     *         words: string,
     *         saved: bool,
     *         statement: string
     *     },
     *     files: array<mixed>,
     *     after: list<array{
     *         key: string,
     *         done: bool,
     *         text: string
     *     }>,
     *     history: list<array{
     *         at: string,
     *         what: string,
     *         detail: string
     *     }>
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/blacklist-a-disputes-buyer
     */
    public function blacklist(string $disputeId, array $options = []): mixed
    {
        return $this->caller->call('disputes.blacklist', [$disputeId], [], $options);
    }

    /**
     * **Get dispute settings**
     *
     * What happens by itself when a dispute opens, how one is answered, and who is told. Amounts are in the store's currency, `currency`.
     *
     * Needs the `disputes.read` permission (Read Disputes).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     blacklist: bool,
     *     takeBackAccess: bool,
     *     acceptSmall: bool,
     *     acceptUnder: int|float,
     *     autoSubmit: bool,
     *     askAboveOn: bool,
     *     askAbove: int|float,
     *     emailOpened: bool,
     *     emailClosed: bool,
     *     discord: bool,
     *     currency: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/get-dispute-settings
     */
    public function settings(array $options = []): mixed
    {
        return $this->caller->call('disputes.settings', [], [], $options);
    }

    /**
     * **Change dispute settings**
     *
     * Changes the settings named and keeps the rest. Accepting small ones and submitting before the deadline are for disputes answered from Shoply (Stripe's, Revolut's, Adyen's, and PayPal's with API keys), and run every few minutes: a dispute under `acceptUnder` that nobody has started an answer for is accepted, and with a day left an answer is submitted as it stands, or where there is none, only when the buyer opened their order or took a file from the address they paid from. Nothing over `askAbove` is sent or accepted by itself where `askAboveOn` is on.
     *
     * Needs the `disputes.write` permission (Answer Disputes).
     *
     * Fields:
     *
     * - `blacklist`: Blacklist the buyer's email and addresses when a dispute opens.
     * - `takeBackAccess`: Hide what the order delivered from its buyer while a dispute is open, shown again if it is won.
     * - `acceptSmall`: Accept a dispute answered from Shoply under `acceptUnder` rather than fight it.
     * - `acceptUnder`: The amount, above 0.
     * - `autoSubmit`: Submit the answer of a dispute answered from Shoply with a day left.
     * - `askAboveOn`: Never send or accept one over `askAbove` by itself.
     * - `askAbove`: The amount, above 0, up to 1,000,000.
     * - `emailOpened`: Email the store when one opens, with its deadline.
     * - `emailClosed`: Email the store how one ended.
     * - `discord`: Post both to the store's Discord. Needs a webhook in its notification settings.
     *
     * @param array{
     *     blacklist?: bool,
     *     takeBackAccess?: bool,
     *     acceptSmall?: bool,
     *     acceptUnder?: int|float,
     *     autoSubmit?: bool,
     *     askAboveOn?: bool,
     *     askAbove?: int|float,
     *     emailOpened?: bool,
     *     emailClosed?: bool,
     *     discord?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     blacklist: bool,
     *     takeBackAccess: bool,
     *     acceptSmall: bool,
     *     acceptUnder: int|float,
     *     autoSubmit: bool,
     *     askAboveOn: bool,
     *     askAbove: int|float,
     *     emailOpened: bool,
     *     emailClosed: bool,
     *     discord: bool,
     *     currency: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/disputes/change-dispute-settings
     */
    public function updateSettings(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('disputes.updateSettings', [], $params, $options);
    }
}

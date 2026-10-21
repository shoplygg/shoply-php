<?php

declare(strict_types=1);

namespace Shoply;

/**
 * A request Shoply refused, or one that never got an answer.
 *
 * `status` is the HTTP status (0 when nothing answered), `errorCode` the word that does not
 * change (`not_found`, `missing_scope`, `validation_failed`, `rate_limited`... and
 * `connection_error` or `timeout` when nothing answered), `errors` what is wrong with each
 * field for `validation_failed`, `requestId` what to quote to Shoply about it, `retryAfter`
 * the seconds to wait when told to slow down, and `body` the whole answer.
 */
final class ShoplyException extends \RuntimeException
{
    /**
     * @param array<string, string>|null $errors
     */
    public function __construct(
        string $message,
        public readonly int $status = 0,
        public readonly ?string $errorCode = null,
        public readonly ?array $errors = null,
        public readonly ?string $requestId = null,
        public readonly ?int $retryAfter = null,
        public readonly mixed $body = null,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($message, $status, $previous);
    }
}

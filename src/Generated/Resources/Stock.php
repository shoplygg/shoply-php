<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Stock
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List a variant's license keys**
     *
     * The license keys a variant has in stock: the unsold ones and nothing else. A key that was delivered belongs to its order and is read there.
     *
     * Needs the `stock.read` permission (Read Stock).
     *
     * Fields:
     *
     * - `page`: Which page of the list. The first is 1. Left out, it is 1.
     * - `perPage`: How many a page holds, up to 5,000. Left out, it is 100.
     * - `search`: Only keys that contain this.
     *
     * @param string $variantId The variant, as a product's `variants` name it.
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     search?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return \Shoply\Page<array{
     *     id: string,
     *     value: string
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/list-a-variants-license-keys
     */
    public function listKeys(string $variantId, array $params = [], array $options = []): \Shoply\Page
    {
        return $this->caller->call('stock.listKeys', [$variantId], $params, $options);
    }

    /**
     * **Add license keys**
     *
     * Adds license keys to a variant's stock, up to 5,000 in one request. A variant and a store each hold as many unsold keys as the store's plan does.
     *
     * A key that would go to more than one buyer is a duplicate: one the variant delivered before, one it has in stock, or one sent twice in the same request. A request with any is refused with `duplicate_keys`, which counts each kind (`sold`, `inStock`, `repeated`), and nothing is added, unless `duplicates` says what to do. `skip` adds the rest and leaves them out; `keep` stocks every one, which is how one key is sold to several buyers. In the answer, `duplicates` counts the ones stocked and `leftOut` the ones left out.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * Fields:
     *
     * - `keys` (required): The keys, one an entry, each up to 500 characters with no line break in it.
     * - `duplicates`: What to do with a key that would go to more than one buyer. `ask` refuses the request with `duplicate_keys`. Left out, it is "ask".
     *
     * @param string $variantId The variant.
     * @param array{
     *     keys: list<string>,
     *     duplicates?: 'ask'|'skip'|'keep'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     added: int|float,
     *     skipped: int|float,
     *     duplicates: int|float,
     *     leftOut: int|float,
     *     available: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/add-license-keys
     */
    public function addKeys(string $variantId, array $params, array $options = []): mixed
    {
        return $this->caller->call('stock.addKeys', [$variantId], $params, $options);
    }

    /**
     * **Replace a variant's license keys**
     *
     * Makes the variant's unsold stock exactly the keys sent. Keys already delivered are not touched: they are order history, not stock. Up to 5,000 keys, and only for a variant with no more than that in stock: one with more is refused with `validation_error`, and its keys are added and deleted instead.
     *
     * A key the variant delivered before, or one sent twice, would go to more than one buyer, and is refused with `duplicate_keys` as Add license keys refuses it, unless `duplicates` says `skip` or `keep`. A key that is in the stock being replaced is not one.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * Fields:
     *
     * - `keys` (required): The keys the variant is to have in stock, one an entry. An empty list empties the stock.
     * - `expectedAvailable`: How many unsold keys you last read. Sent, the change is refused with `stale_write` if that number has changed, so a key sold in the meantime is not put back.
     * - `expectedStock`: The `stock` a list of the variant's keys answered beside its first page, read with no search (in `meta`). Sent, the change is refused with `stale_write` if any of those keys was sold or removed, or another added, since: a sale and an addition together leave the count the same.
     * - `duplicates`: What to do with a key that would go to more than one buyer. `ask` refuses the request with `duplicate_keys`. Left out, it is "ask".
     *
     * @param string $variantId The variant.
     * @param array{
     *     keys: list<string>,
     *     expectedAvailable?: int,
     *     expectedStock?: string,
     *     duplicates?: 'ask'|'skip'|'keep'
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/replace-a-variants-license-keys
     */
    public function replaceKeys(string $variantId, array $params, array $options = []): mixed
    {
        return $this->caller->call('stock.replaceKeys', [$variantId], $params, $options);
    }

    /**
     * **Delete license keys**
     *
     * Deletes the unsold keys among the ones named. `removed` in the answer can be lower than the number sent: a key sold in the meantime stays with its order.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * Fields:
     *
     * - `ids` (required): The keys to delete, by ID.
     *
     * @param string $variantId The variant.
     * @param array{
     *     ids: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     removed: int|float,
     *     available: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/delete-license-keys
     */
    public function deleteKeys(string $variantId, array $params, array $options = []): mixed
    {
        return $this->caller->call('stock.deleteKeys', [$variantId], $params, $options);
    }

    /**
     * **Delete a license key**
     *
     * Deletes one unsold key. Refused for a key that has been sold.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * @param string $variantId The variant.
     * @param string $keyId The key.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/delete-a-license-key
     */
    public function deleteKey(string $variantId, string $keyId, array $options = []): mixed
    {
        return $this->caller->call('stock.deleteKey', [$variantId, $keyId], [], $options);
    }

    /**
     * **List a variant's files**
     *
     * The files a variant delivers to its buyers.
     *
     * Needs the `stock.read` permission (Read Stock).
     *
     * @param string $variantId The variant.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array<mixed>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/list-a-variants-files
     */
    public function listFiles(string $variantId, array $options = []): mixed
    {
        return $this->caller->call('stock.listFiles', [$variantId], [], $options);
    }

    /**
     * **Start a file upload**
     *
     * The first of three steps to give a variant a file to deliver. This one says what the file is and answers a signed address to send it to. Then send the file itself to that address with a `PUT`. Then call "Finish a file upload".
     *
     * How many files a variant and a store hold, how large one may be and how much a store holds in all are the store's plan's. Accepted: ZIP, RAR, 7z, PDF, MP4, MP3, WAV, EPUB, EXE, DMG, MSI and APK.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * Fields:
     *
     * - `name` (required): The file's name, with its ending. Buyers download it under this name.
     * - `size` (required): Its size in bytes.
     *
     * @param string $variantId The variant.
     * @param array{
     *     name: string,
     *     size: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/start-a-file-upload
     */
    public function addFile(string $variantId, array $params, array $options = []): mixed
    {
        return $this->caller->call('stock.addFile', [$variantId], $params, $options);
    }

    /**
     * **Finish a file upload**
     *
     * The last step of adding a file: says the file has been sent. Shoply checks it arrived and is the size that was said, and from then on buyers of the variant receive it. For a new version started with "Start replacing a file", the answer is the file it replaced, under that file's own `id`, now with the new version's name and size.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * @param string $variantId The variant.
     * @param string $fileId The file, as "Start a file upload" or "Start replacing a file" named it.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/finish-a-file-upload
     */
    public function finishFile(string $variantId, string $fileId, array $options = []): mixed
    {
        return $this->caller->call('stock.finishFile', [$variantId, $fileId], [], $options);
    }

    /**
     * **Start replacing a file**
     *
     * The first of three steps to put a new version of a file in its place, the same three as adding one: this one says what the new version is and answers a signed address to send it to, then send it there with a `PUT`, then call "Finish a file upload" with the `id` this step answered.
     *
     * Once it is finished, everybody who bought the file downloads the new version, buyers of past orders too. The file keeps its own `id`, and every download link already sent goes on working. Until then they download the old one, so an upload that fails or is never finished changes nothing. It takes the old file's place rather than one more, so it counts against the variant's and the store's files as the old one did, and against the store's storage by the difference in size.
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * Fields:
     *
     * - `name` (required): The new version's name, with its ending. Buyers download it under this name from then on.
     * - `size` (required): Its size in bytes.
     *
     * @param string $variantId The variant.
     * @param string $fileId The file to replace.
     * @param array{
     *     name: string,
     *     size: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/start-replacing-a-file
     */
    public function replaceFile(string $variantId, string $fileId, array $params, array $options = []): mixed
    {
        return $this->caller->call('stock.replaceFile', [$variantId, $fileId], $params, $options);
    }

    /**
     * **Delete a file**
     *
     * Takes a file off the variant: buyers from now on are not sent it. Buyers who already paid for it keep downloading it, and it still counts against the store's file storage while they do. To give everybody a new version instead, use "Start replacing a file".
     *
     * Needs the `stock.write` permission (Change Stock).
     *
     * @param string $variantId The variant.
     * @param string $fileId The file.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/stock/delete-a-file
     */
    public function deleteFile(string $variantId, string $fileId, array $options = []): mixed
    {
        return $this->caller->call('stock.deleteFile', [$variantId, $fileId], [], $options);
    }
}

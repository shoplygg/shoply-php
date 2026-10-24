<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class EmailTemplates
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List email templates**
     *
     * Every email a store can write, in the order the dashboard lists them: its `kind`, `group`, `name`, `when` it is sent, whether the store has `edited` it (and which of `html`, `css` and `subject`), and `updatedAt`. `meta.shared` is the CSS every email gets (`css`, null where it is Shoply's look, `baseCss`), and `meta.sendable` whether the store can send email at all.
     *
     * Needs the `emails.read` permission (Read Email Templates).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     kind: string,
     *     group: string,
     *     name: string,
     *     when: string,
     *     edited: bool,
     *     html: bool,
     *     css: bool,
     *     subject: bool,
     *     updatedAt: mixed
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/list-email-templates
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.list', [], [], $options);
    }

    /**
     * **Get the shared email CSS**
     *
     * The look every email gets but one with a `css` of its own, as `css` (null where it is Shoply's look), `updatedAt`, and Shoply's look as `baseCss`, `var(--accent)` in it for the shop's colour.
     *
     * Needs the `emails.read` permission (Read Email Templates).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     css: string,
     *     updatedAt: string,
     *     baseCss: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/get-the-shared-email-css
     */
    public function shared(array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.shared', [], [], $options);
    }

    /**
     * **Change the shared email CSS**
     *
     * The look every email gets but one with a `css` of its own, a whole sheet, checked as an email's own is; empty, null or `baseCss` as it is for none, which is Shoply's look. Saving one draws every email from its template, Shoply's original where the store has not written one.
     *
     * Needs the `emails.write` permission (Change Email Templates).
     *
     * Fields:
     *
     * - `css` (required): The whole look, or null for Shoply's.
     * - `expectedUpdatedAt`: The `updatedAt` you read; one changed since is refused with `stale_write`.
     *
     * @param array{
     *     css: string,
     *     expectedUpdatedAt?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     css: string,
     *     updatedAt: string,
     *     baseCss: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/change-the-shared-email-css
     */
    public function saveShared(array $params, array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.saveShared', [], $params, $options);
    }

    /**
     * **Get an email template**
     *
     * One email: what it is, its `variables` and `parts` (each a `name` and what it is), the marks it must hold (`required`), its `original` HTML, what the store has saved, `shared` (the CSS every email gets), `baseCss` (Shoply's look for the classes the originals are written with) and `accent` (the shop's colour, which `var(--accent)` is). The email is drawn with `css`, else `shared`, else `baseCss`. Each of `html`, `css` and `subject` is the store's own, or null where it is Shoply's original. A CSS is a whole look, never rules over another: an email is drawn with its own `css`, else the shared CSS, else Shoply's look (`baseCss`), where `var(--accent)` is the shop's colour. The HTML is the email's card and the lines under it, with Liquid's marks for what changes from one buyer to the next: `{{ order.id }}` prints a value, escaped, and `{{ parts.delivery }}` a part only Shoply writes. `variables` and `parts` say which an email has. Shoply writes the page round it, its dark look, and a last line under it, "Sent with Shoply", which no template changes. `originalSubject` is the original subject as a sample buyer would get it, and `originalSubjectSource` the same written with its variables.
     *
     * Needs the `emails.read` permission (Read Email Templates).
     *
     * @param string $kind Which email: `receipt`, `invoice`, `reward`, `panel-code`, `balance-code`, `site-code`, `ticket-reply`, `sub-renewal`, `sub-charged`, `sub-due`, `sub-declined`, `sub-paused`, `sub-ended`, `recovery-first`, `recovery-declined`, `recovery-second`, `winback-first`, `winback-second`.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     kind: string,
     *     group: string,
     *     name: string,
     *     when: string,
     *     marketing: bool,
     *     required: list<string>,
     *     variables: list<array{
     *         name: string,
     *         about: string
     *     }>,
     *     parts: list<array{
     *         name: string,
     *         about: string
     *     }>,
     *     original: string,
     *     originalSubject: string,
     *     originalSubjectSource: string,
     *     html: mixed,
     *     css: mixed,
     *     subject: mixed,
     *     updatedAt: mixed,
     *     shared: mixed,
     *     baseCss: string,
     *     accent: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/get-an-email-template
     */
    public function show(string $kind, array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.show', [$kind], [], $options);
    }

    /**
     * **Change an email template**
     *
     * Changes each of `html`, `css` and `subject` sent, and keeps the rest; null, an empty string, or the original's own HTML puts that one back to the original. Answers the email as Get an email template does. Refused with `template_problems` while anything would stop it, `problems` saying what and on which line, for `html`, `css` and `subject`. The HTML may hold the tags an email is made of, never a script, a form, a frame or <style>, and its links go to https, http, mailto or #, its pictures to https; up to 64 KB. Comments are taken out when it is sent, which `problems` says as a warning. The CSS is the email's whole look, and the shared CSS no longer changes an email that has one: start from `shared`, or `baseCss` where it is null. It sets how things look, with type, class, id and attribute selectors, and @media; no url(), no position, and no < or backslash; up to 32 KB. A subject is one line of up to 150 characters, and may hold the email's variables. Before it is saved the email is drawn for a sample buyer, and refused where it closes a <div> it never opened, where a mark it must hold is in its code but not in what it draws (inside a comment, or under a condition that is false), or where its subject comes out empty. Cart Recovery's and Win-Back's emails must hold `{{ links.unsubscribe }}`, and their subjects are those Change Cart Recovery and Change Win-Back set.
     *
     * Needs the `emails.write` permission (Change Email Templates).
     *
     * Fields:
     *
     * - `html`: The email's HTML, or null for the original.
     * - `css`: Its whole look, or null to follow the shared CSS. The look it would get anyway is saved as null.
     * - `subject`: Its subject, or null for the original.
     * - `expectedUpdatedAt`: The `updatedAt` you read; a template changed since is refused with `stale_write`.
     *
     * @param string $kind Which email: `receipt`, `invoice`, `reward`, `panel-code`, `balance-code`, `site-code`, `ticket-reply`, `sub-renewal`, `sub-charged`, `sub-due`, `sub-declined`, `sub-paused`, `sub-ended`, `recovery-first`, `recovery-declined`, `recovery-second`, `winback-first`, `winback-second`.
     * @param array{
     *     html?: string,
     *     css?: string,
     *     subject?: string,
     *     expectedUpdatedAt?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     kind: string,
     *     group: string,
     *     name: string,
     *     when: string,
     *     marketing: bool,
     *     required: list<string>,
     *     variables: list<array{
     *         name: string,
     *         about: string
     *     }>,
     *     parts: list<array{
     *         name: string,
     *         about: string
     *     }>,
     *     original: string,
     *     originalSubject: string,
     *     originalSubjectSource: string,
     *     html: mixed,
     *     css: string,
     *     subject: string,
     *     updatedAt: string,
     *     shared: mixed,
     *     baseCss: string,
     *     accent: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/change-an-email-template
     */
    public function update(string $kind, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.update', [$kind], $params, $options);
    }

    /**
     * **Preview an email template**
     *
     * The email for a sample buyer as it would be sent with what you send in place of what is saved: its `subject`, the whole page as `html`, its plain `text`, the `values` its variables had, and `problems` as Change an email template would say them. Nothing is saved and nothing is sent.
     *
     * Needs the `emails.read` permission (Read Email Templates).
     *
     * Fields:
     *
     * - `html`: HTML to preview in place of what is saved; null for the original.
     * - `css`: Its whole look, to preview in place of what is saved.
     * - `subject`: A subject to preview in place of what is saved.
     * - `shared`: The look every email gets, in place of what is saved.
     *
     * @param string $kind Which email: `receipt`, `invoice`, `reward`, `panel-code`, `balance-code`, `site-code`, `ticket-reply`, `sub-renewal`, `sub-charged`, `sub-due`, `sub-declined`, `sub-paused`, `sub-ended`, `recovery-first`, `recovery-declined`, `recovery-second`, `winback-first`, `winback-second`.
     * @param array{
     *     html?: string,
     *     css?: string,
     *     subject?: string,
     *     shared?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     subject: string,
     *     html: string,
     *     text: string,
     *     parts: array{
     *         delivery: string,
     *         buttons: string,
     *         summary: string,
     *         reply_note: string
     *     },
     *     values: array{
     *         'store.name': string,
     *         'store.url': string,
     *         'store.panel_url': string,
     *         'buyer.email': string,
     *         'order.id': string,
     *         'order.paid_at': string,
     *         'order.total': string,
     *         'order.paid_with': string,
     *         'order.invoice_attached': bool,
     *         'links.order': string,
     *         'links.review': string,
     *         year: string
     *     },
     *     problems: array{
     *         html: array<mixed>,
     *         css: array<mixed>,
     *         subject: array<mixed>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/preview-an-email-template
     */
    public function preview(string $kind, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.preview', [$kind], $params, $options);
    }

    /**
     * **Revert an email template**
     *
     * Puts the email back as Shoply wrote it: its HTML, CSS and subject. Answers it as Get an email template does.
     *
     * Needs the `emails.write` permission (Change Email Templates).
     *
     * @param string $kind Which email: `receipt`, `invoice`, `reward`, `panel-code`, `balance-code`, `site-code`, `ticket-reply`, `sub-renewal`, `sub-charged`, `sub-due`, `sub-declined`, `sub-paused`, `sub-ended`, `recovery-first`, `recovery-declined`, `recovery-second`, `winback-first`, `winback-second`.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     kind: string,
     *     group: string,
     *     name: string,
     *     when: string,
     *     marketing: bool,
     *     required: list<string>,
     *     variables: list<array{
     *         name: string,
     *         about: string
     *     }>,
     *     parts: list<array{
     *         name: string,
     *         about: string
     *     }>,
     *     original: string,
     *     originalSubject: string,
     *     originalSubjectSource: string,
     *     html: mixed,
     *     css: mixed,
     *     subject: mixed,
     *     updatedAt: mixed,
     *     shared: mixed,
     *     baseCss: string,
     *     accent: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/email-templates/revert-an-email-template
     */
    public function revert(string $kind, array $options = []): mixed
    {
        return $this->caller->call('emailTemplates.revert', [$kind], [], $options);
    }
}

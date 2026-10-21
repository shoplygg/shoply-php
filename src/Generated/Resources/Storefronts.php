<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Storefronts
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **List storefronts**
     *
     * The store's storefronts: each a design of its site, on a theme. One of them is live (`meta.liveId`), which is the one buyers see. A store holds up to 10. `meta.themes` is the themes a new one can start from.
     *
     * Needs the `storefronts.read` permission (Read Storefronts).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     theme: string,
     *     themeVersion: string,
     *     published: bool,
     *     publishedAt: mixed,
     *     live: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     code: bool,
     *     engine: string,
     *     codeOnCopy: mixed,
     *     unpublished: bool,
     *     accent: mixed,
     *     headingFont: mixed,
     *     pages: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/list-storefronts
     */
    public function list(array $options = []): mixed
    {
        return $this->caller->call('storefronts.list', [], [], $options);
    }

    /**
     * **Create a storefront**
     *
     * Adds a storefront as a draft: a theme's starting design, or a copy of one the store already has. Answers the store's storefronts with the new one among them.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `name` (required): What to call it.
     * - `theme`: The theme it starts from, by its ID in `meta.themes`. Left out, it is "simplistic".
     * - `from`: A storefront to copy in place of starting from the theme, by its ID.
     *
     * @param array{
     *     name: string,
     *     theme?: string,
     *     from?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     theme: string,
     *     themeVersion: string,
     *     published: bool,
     *     publishedAt: mixed,
     *     live: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     code: bool,
     *     engine: string,
     *     codeOnCopy: mixed,
     *     unpublished: bool,
     *     accent: mixed,
     *     headingFont: mixed,
     *     pages: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/create-a-storefront
     */
    public function create(array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.create', [], $params, $options);
    }

    /**
     * **Import a storefront**
     *
     * Makes a new storefront, as a draft, from one that was exported: the JSON document "Export a storefront" answers under `storefront`, sent as `multipart/form-data` in a field called `file`. Nothing in it is trusted: its design is rebuilt from the theme, and each of its files is checked. One thing wrong refuses all of it, and the refusal names the file. `meta.imported` says which storefront it became and how many problems its code has to be fixed before it can be published.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * @param array{
     *     file: string|\CURLFile,
     *     filename?: string,
     *     contentType?: string
     * } $params The file: a path on disk, or a CURLFile.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return mixed
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/import-a-storefront
     */
    public function import(array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.import', [], $params, $options);
    }

    /**
     * **Export a storefront**
     *
     * A storefront to keep, work on or hand on: its design, and every file of its code when it has code of its own, as text. `storefront` in the answer is what "Import a storefront" takes.
     *
     * Needs the `storefronts.read` permission (Read Storefronts). It is one of the heavier reads, and is counted against a smaller budget of its own: 60 a minute for each key.
     *
     * @param string $storefrontId The storefront.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     filename: string,
     *     storefront: array{
     *         kind: string,
     *         format: int|float,
     *         exportedAt: string,
     *         name: string,
     *         theme: string,
     *         design: array{
     *             version: int|float,
     *             theme: array{
     *                 accent: string,
     *                 accentText: string,
     *                 page: string,
     *                 cards: string,
     *                 text: string,
     *                 muted: string,
     *                 border: string,
     *                 tintArt: bool,
     *                 headingFont: string,
     *                 bodyFont: string,
     *                 headingWeight: string,
     *                 radius: string,
     *                 buttonRadius: string,
     *                 pageWidth: int|float,
     *                 motion: bool,
     *                 customCss: string
     *             },
     *             announcement: array{
     *                 enabled: bool,
     *                 text: string,
     *                 icon: string,
     *                 link: string,
     *                 bg: string,
     *                 color: string,
     *                 dismissible: bool
     *             },
     *             header: array{
     *                 showLogo: bool,
     *                 logo: string,
     *                 logoSize: int|float,
     *                 showName: bool,
     *                 categoriesMenu: bool,
     *                 categoriesLabel: string,
     *                 nav: list<array{
     *                     label: mixed,
     *                     link: mixed,
     *                     icon: mixed
     *                 }>,
     *                 featured: bool,
     *                 showBlog: bool,
     *                 showOnline: bool,
     *                 showSearch: bool,
     *                 showCart: bool,
     *                 showAccount: bool,
     *                 accountLabel: string
     *             },
     *             footer: array{
     *                 showLogo: bool,
     *                 showName: bool,
     *                 tagline: string,
     *                 about: string,
     *                 columns: list<array{
     *                     title: mixed,
     *                     links: mixed
     *                 }>,
     *                 legalTitle: string,
     *                 policies: bool,
     *                 privacy: string,
     *                 help: bool,
     *                 helpTitle: string,
     *                 helpText: string,
     *                 helpLabel: string,
     *                 helpLink: string,
     *                 directory: bool,
     *                 socials: array<mixed>,
     *                 copyright: string
     *             },
     *             cart: array{
     *                 openOnAdd: bool,
     *                 bar: bool,
     *                 showImages: bool,
     *                 title: string,
     *                 checkoutLabel: string,
     *                 note: string,
     *                 emptyText: string,
     *                 emptyLinkLabel: string,
     *                 emptyLink: string
     *             },
     *             pages: list<array{
     *                 id: string,
     *                 kind: string,
     *                 name: string,
     *                 path: string,
     *                 title: string,
     *                 description: string,
     *                 hideHeader: bool,
     *                 hideFooter: bool,
     *                 sections: list<mixed>
     *             }>
     *         },
     *         files: mixed
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/export-a-storefront
     */
    public function export(string $storefrontId, array $options = []): mixed
    {
        return $this->caller->call('storefronts.export', [$storefrontId], [], $options);
    }

    /**
     * **Rename a storefront**
     *
     * Changes what a storefront is called. Buyers never see the name. Answers the store's storefronts again.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `name` (required): The new name.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     name: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     theme: string,
     *     themeVersion: string,
     *     published: bool,
     *     publishedAt: mixed,
     *     live: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     code: bool,
     *     engine: string,
     *     codeOnCopy: mixed,
     *     unpublished: bool,
     *     accent: mixed,
     *     headingFont: mixed,
     *     pages: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/rename-a-storefront
     */
    public function rename(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.rename', [$storefrontId], $params, $options);
    }

    /**
     * **Delete a storefront**
     *
     * Removes a storefront that is not the live one. Answers the storefronts that are left.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * @param string $storefrontId The storefront.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     theme: string,
     *     themeVersion: string,
     *     published: bool,
     *     publishedAt: string,
     *     live: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     code: bool,
     *     engine: string,
     *     codeOnCopy: mixed,
     *     unpublished: bool,
     *     accent: mixed,
     *     headingFont: mixed,
     *     pages: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/delete-a-storefront
     */
    public function delete(string $storefrontId, array $options = []): mixed
    {
        return $this->caller->call('storefronts.delete', [$storefrontId], [], $options);
    }

    /**
     * **Make a storefront live**
     *
     * Makes this storefront the one buyers see, as it was last published. Answers the store's storefronts again.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `publish`: For a storefront that was never published: publish it as it stands and make it live in one go. A mistake in one of its templates refuses it and names the file. Left out, it is false.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     publish?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return list<array{
     *     id: string,
     *     name: string,
     *     theme: string,
     *     themeVersion: string,
     *     published: bool,
     *     publishedAt: string,
     *     live: bool,
     *     createdAt: string,
     *     updatedAt: string,
     *     code: bool,
     *     engine: string,
     *     codeOnCopy: mixed,
     *     unpublished: bool,
     *     accent: mixed,
     *     headingFont: mixed,
     *     pages: int|float
     * }>
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefronts/make-a-storefront-live
     */
    public function setLive(string $storefrontId, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('storefronts.setLive', [$storefrontId], $params, $options);
    }

    /**
     * **Get a storefront's code**
     *
     * Whether this storefront can be edited as code (`available`), whether it has files of its own yet (`started`), and when it has: every file with its SHA-256 `hash`, what is wrong in the templates (`code.problems`), the count of changes to its files (`code.rev`) and to its design (`version`), which "Publish a storefront's code" takes, and a link to look at the draft on the store's own address for an hour (`preview`: its `url`, with `param` set to `token` in the query string). A file's text is "Get a file", or every file at once in "Export a storefront".
     *
     * Needs the `storefronts.read` permission (Read Storefronts).
     *
     * @param string $storefrontId The storefront.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     storefront: array{
     *         id: string,
     *         name: string,
     *         theme: string,
     *         themeVersion: string,
     *         published: bool,
     *         publishedAt: mixed,
     *         live: bool,
     *         createdAt: string,
     *         updatedAt: string,
     *         code: bool,
     *         engine: string,
     *         codeOnCopy: mixed,
     *         unpublished: bool,
     *         accent: mixed,
     *         headingFont: mixed,
     *         pages: int|float
     *     },
     *     theme: string,
     *     available: bool,
     *     started: bool,
     *     version: int|float,
     *     code: mixed,
     *     versions: array<mixed>,
     *     preview: mixed
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/get-a-storefronts-code
     */
    public function code(string $storefrontId, array $options = []): mixed
    {
        return $this->caller->call('storefronts.code', [$storefrontId], [], $options);
    }

    /**
     * **Give a storefront files**
     *
     * Gives a storefront files of its own, copied from its theme's, as opening the code studio does. Until then it is drawn from its theme's files and follows them as they change. Nothing buyers see changes. Refused with `code_needs_copy` for a storefront from before its theme could be edited as code: make a copy of it ("Create a storefront" with `from`) and work on that. Answers as "Get a storefront's code".
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * @param string $storefrontId The storefront.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     storefront: array{
     *         id: string,
     *         name: string,
     *         theme: string,
     *         themeVersion: string,
     *         published: bool,
     *         publishedAt: mixed,
     *         live: bool,
     *         createdAt: string,
     *         updatedAt: string,
     *         code: bool,
     *         engine: string,
     *         codeOnCopy: mixed,
     *         unpublished: bool,
     *         accent: mixed,
     *         headingFont: mixed,
     *         pages: int|float
     *     },
     *     theme: string,
     *     available: bool,
     *     started: bool,
     *     version: int|float,
     *     code: array{
     *         rev: int|float,
     *         ahead: int|float,
     *         designAhead: bool,
     *         base: string,
     *         files: list<array{
     *             path: string,
     *             hash: string,
     *             size: int|float,
     *             added: bool,
     *             changed: bool,
     *             updatedAt: string
     *         }>,
     *         problems: array<mixed>,
     *         limits: array{
     *             files: int|float,
     *             fileBytes: int|float,
     *             bytes: int|float,
     *             used: int|float
     *         },
     *         folders: array{
     *             layout: list<string>,
     *             pages: list<string>,
     *             elements: list<string>,
     *             parts: list<string>,
     *             assets: list<string>,
     *             locales: list<string>,
     *             config: list<string>
     *         }
     *     },
     *     versions: array<mixed>,
     *     preview: array{
     *         url: string,
     *         param: string,
     *         token: string,
     *         seconds: int|float,
     *         pages: list<array{
     *             name: string,
     *             path: string
     *         }>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/give-a-storefront-files
     */
    public function codeStart(string $storefrontId, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codeStart', [$storefrontId], [], $options);
    }

    /**
     * **Get a file**
     *
     * One file of the storefront's draft, with its text in `content` and its SHA-256 in `hash`. `file_not_found` for a path it does not have.
     *
     * Needs the `storefronts.read` permission (Read Storefronts).
     *
     * Fields:
     *
     * - `path` (required): The file's path, its folder and its name: `pages/index.liquid`, `assets/theme.css`.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     path: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     path: string,
     *     hash: string,
     *     size: int|float,
     *     added: bool,
     *     changed: bool,
     *     updatedAt: string,
     *     content: string
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/get-a-file
     */
    public function codeFile(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codeFile', [$storefrontId], $params, $options);
    }

    /**
     * **Save a file**
     *
     * Saves a file the draft has. Send `was`, the `hash` it had when you read it, and the save is refused with `file_conflict` if it has changed since (in the code studio, say), with the file as it now stands in `file`: left out, it is saved whatever happened in between. Saved to the draft only: buyers see it once it is published. Answers the file as it now stands (`file`) and the whole list again (`code`), with what is now wrong in the templates. What is written counts toward the store's hour of saves, as the code studio's does.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `path` (required): The file's path, its folder and its name: `pages/index.liquid`, `assets/theme.css`.
     * - `content` (required): The file's whole text.
     * - `was`: The SHA-256 the file had when you read it.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     path: string,
     *     content: string,
     *     was?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     file: array{
     *         path: string,
     *         hash: string,
     *         size: int|float,
     *         added: bool,
     *         changed: bool,
     *         updatedAt: string,
     *         content: string
     *     },
     *     rev: int|float,
     *     code: array{
     *         rev: int|float,
     *         ahead: int|float,
     *         designAhead: bool,
     *         base: string,
     *         files: list<array{
     *             path: string,
     *             hash: string,
     *             size: int|float,
     *             added: bool,
     *             changed: bool,
     *             updatedAt: string
     *         }>,
     *         problems: array<mixed>,
     *         limits: array{
     *             files: int|float,
     *             fileBytes: int|float,
     *             bytes: int|float,
     *             used: int|float
     *         },
     *         folders: array{
     *             layout: list<string>,
     *             pages: list<string>,
     *             elements: list<string>,
     *             parts: list<string>,
     *             assets: list<string>,
     *             locales: list<string>,
     *             config: list<string>
     *         }
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/save-a-file
     */
    public function codeSave(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codeSave', [$storefrontId], $params, $options);
    }

    /**
     * **Add a file**
     *
     * Adds a file the draft does not have. Its path has to be in one of the folders a storefront has (`code.folders` in "Get a storefront's code") with that folder's ending. Answers as "Save a file".
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `path` (required): The file's path, its folder and its name: `pages/index.liquid`, `assets/theme.css`.
     * - `content` (required): The file's whole text.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     path: string,
     *     content: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     file: array{
     *         path: string,
     *         hash: string,
     *         size: int|float,
     *         added: bool,
     *         changed: bool,
     *         updatedAt: string,
     *         content: string
     *     },
     *     rev: int|float,
     *     code: array{
     *         rev: int|float,
     *         ahead: int|float,
     *         designAhead: bool,
     *         base: string,
     *         files: list<array{
     *             path: string,
     *             hash: string,
     *             size: int|float,
     *             added: bool,
     *             changed: bool,
     *             updatedAt: string
     *         }>,
     *         problems: array<mixed>,
     *         limits: array{
     *             files: int|float,
     *             fileBytes: int|float,
     *             bytes: int|float,
     *             used: int|float
     *         },
     *         folders: array{
     *             layout: list<string>,
     *             pages: list<string>,
     *             elements: list<string>,
     *             parts: list<string>,
     *             assets: list<string>,
     *             locales: list<string>,
     *             config: list<string>
     *         }
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/add-a-file
     */
    public function codeAdd(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codeAdd', [$storefrontId], $params, $options);
    }

    /**
     * **Delete a file**
     *
     * Takes a file you added out of the draft. A file of the theme's can be changed and put back, never deleted: `file_fixed`.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `path` (required): The file's path, its folder and its name: `pages/index.liquid`, `assets/theme.css`.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     path: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     rev: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/delete-a-file
     */
    public function codeDelete(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codeDelete', [$storefrontId], $params, $options);
    }

    /**
     * **Rename a file**
     *
     * Moves a file you added to another path. A file of the theme's keeps its name (`file_fixed`).
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `from` (required): Its path now.
     * - `to` (required): Its new path.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     from: string,
     *     to: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     file: array{
     *         path: string,
     *         hash: string,
     *         size: int|float,
     *         added: bool,
     *         changed: bool,
     *         updatedAt: string
     *     },
     *     rev: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/rename-a-file
     */
    public function codeRename(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codeRename', [$storefrontId], $params, $options);
    }

    /**
     * **Publish a storefront's code**
     *
     * Puts the draft live, its files and its design together, and makes this storefront the one buyers see, as Publish in the code studio does. Send `rev` and `version` from "Get a storefront's code" as you last read it: if either has moved since (somebody saved in the meantime) it is refused with `draft_conflict`, so you never publish what you have not seen. A mistake in a template refuses it with `code_problems`, the mistakes listed in `problems`.
     *
     * Needs the `storefronts.write` permission (Change Storefronts).
     *
     * Fields:
     *
     * - `rev` (required): The files' count of changes, `code.rev`.
     * - `version` (required): The design's, `version`.
     *
     * @param string $storefrontId The storefront.
     * @param array{
     *     rev: int,
     *     version: int
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     storefront: array{
     *         id: string,
     *         name: string,
     *         theme: string,
     *         themeVersion: string,
     *         published: bool,
     *         publishedAt: string,
     *         live: bool,
     *         createdAt: string,
     *         updatedAt: string,
     *         code: bool,
     *         engine: string,
     *         codeOnCopy: mixed,
     *         unpublished: bool,
     *         accent: mixed,
     *         headingFont: mixed,
     *         pages: int|float
     *     },
     *     theme: string,
     *     available: bool,
     *     started: bool,
     *     version: int|float,
     *     code: array{
     *         rev: int|float,
     *         ahead: int|float,
     *         designAhead: bool,
     *         base: string,
     *         files: list<array{
     *             path: string,
     *             hash: string,
     *             size: int|float,
     *             added: bool,
     *             changed: bool,
     *             updatedAt: string
     *         }>,
     *         problems: array<mixed>,
     *         limits: array{
     *             files: int|float,
     *             fileBytes: int|float,
     *             bytes: int|float,
     *             used: int|float
     *         },
     *         folders: array{
     *             layout: list<string>,
     *             pages: list<string>,
     *             elements: list<string>,
     *             parts: list<string>,
     *             assets: list<string>,
     *             locales: list<string>,
     *             config: list<string>
     *         }
     *     },
     *     versions: list<array{
     *         id: string,
     *         number: int|float,
     *         live: bool,
     *         files: int|float,
     *         createdAt: string
     *     }>,
     *     preview: array{
     *         url: string,
     *         param: string,
     *         token: string,
     *         seconds: int|float,
     *         pages: list<array{
     *             name: string,
     *             path: string
     *         }>
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/storefront-code/publish-a-storefronts-code
     */
    public function codePublish(string $storefrontId, array $params, array $options = []): mixed
    {
        return $this->caller->call('storefronts.codePublish', [$storefrontId], $params, $options);
    }
}

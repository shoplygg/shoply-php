<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Tax
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get tax settings**
     *
     * Whether the store collects tax at checkout, whether its prices include it, the places it collects in and at what rate, and each country's built-in rate. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.read` permission (Read Finance).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     collect: bool,
     *     included: bool,
     *     business: bool,
     *     home: string,
     *     homeName: string,
     *     rates: list<array{
     *         country: string,
     *         countryName: string,
     *         region: string,
     *         regionName: string,
     *         rate: int|float,
     *         label: string,
     *         standard: int|float
     *     }>,
     *     standard: array{
     *         AT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LV: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ES: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GB: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         UA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         JP: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TW: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ID: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         VN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         OM: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ZA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MX: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PE: array{
     *             label: string,
     *             rate: int|float
     *         }
     *     },
     *     eu: list<string>,
     *     regions: array{
     *         US: list<array{
     *             code: string,
     *             name: string
     *         }>
     *     },
     *     limit: int|float,
     *     maxRate: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/tax/get-tax-settings
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('tax.show', [], [], $options);
    }

    /**
     * **Update tax settings**
     *
     * Changes the store's three tax switches. Only what is sent changes. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.write` permission (Change Finance).
     *
     * Fields:
     *
     * - `collect`: Whether tax is charged at checkout.
     * - `included`: Whether the store's prices already include the tax. Off, it is added on top.
     * - `business`: Whether a business buyer's VAT number takes the tax off, when the EU's register confirms it and it is from another country than the store's.
     *
     * @param array{
     *     collect?: bool,
     *     included?: bool,
     *     business?: bool
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     collect: bool,
     *     included: bool,
     *     business: bool,
     *     home: string,
     *     homeName: string,
     *     rates: array<mixed>,
     *     standard: array{
     *         AT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LV: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ES: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GB: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         UA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         JP: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TW: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ID: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         VN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         OM: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ZA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MX: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PE: array{
     *             label: string,
     *             rate: int|float
     *         }
     *     },
     *     eu: list<string>,
     *     regions: array{
     *         US: list<array{
     *             code: string,
     *             name: string
     *         }>
     *     },
     *     limit: int|float,
     *     maxRate: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/tax/update-tax-settings
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('tax.update', [], $params, $options);
    }

    /**
     * **Add or change tax rates**
     *
     * Adds each place the store collects tax in, or changes its rate where it already does. The United States is taxed a state at a time. Answers the tax settings as they now stand. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.write` permission (Change Finance).
     *
     * Fields:
     *
     * - `places` (required): The places.
     *
     * @param array{
     *     places: list<array{
     *         country: string,
     *         region?: string,
     *         rate?: int|float
     *     }>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     collect: bool,
     *     included: bool,
     *     business: bool,
     *     home: string,
     *     homeName: string,
     *     rates: list<array{
     *         country: string,
     *         countryName: string,
     *         region: string,
     *         regionName: string,
     *         rate: int|float,
     *         label: string,
     *         standard: int|float
     *     }>,
     *     standard: array{
     *         AT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LV: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ES: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GB: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         UA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         JP: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TW: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ID: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         VN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         OM: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ZA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MX: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PE: array{
     *             label: string,
     *             rate: int|float
     *         }
     *     },
     *     eu: list<string>,
     *     regions: array{
     *         US: list<array{
     *             code: string,
     *             name: string
     *         }>
     *     },
     *     limit: int|float,
     *     maxRate: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/tax/add-or-change-tax-rates
     */
    public function setRates(array $params, array $options = []): mixed
    {
        return $this->caller->call('tax.setRates', [], $params, $options);
    }

    /**
     * **Remove a tax rate**
     *
     * Stops collecting tax in a place. A country named with no state goes with all of its states. Answers the tax settings as they now stand. Refused with `business_details_required` until the store has its business details.
     *
     * Needs the `finance.write` permission (Change Finance).
     *
     * Fields:
     *
     * - `country` (required): The country, as a two-letter code.
     * - `region`: One state of it. Left out, the whole country.
     *
     * @param array{
     *     country: string,
     *     region?: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     collect: bool,
     *     included: bool,
     *     business: bool,
     *     home: string,
     *     homeName: string,
     *     rates: list<array{
     *         country: string,
     *         countryName: string,
     *         region: string,
     *         regionName: string,
     *         rate: int|float,
     *         label: string,
     *         standard: int|float
     *     }>,
     *     standard: array{
     *         AT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         FR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         DE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         HU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LV: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PT: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SK: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ES: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         GB: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         LI: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         RS: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         UA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AU: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NZ: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         JP: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TW: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         TH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MY: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ID: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         VN: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         SA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         BH: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         OM: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         IL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         EG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         ZA: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         NG: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         KE: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         MX: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CL: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         CO: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         AR: array{
     *             label: string,
     *             rate: int|float
     *         },
     *         PE: array{
     *             label: string,
     *             rate: int|float
     *         }
     *     },
     *     eu: list<string>,
     *     regions: array{
     *         US: list<array{
     *             code: string,
     *             name: string
     *         }>
     *     },
     *     limit: int|float,
     *     maxRate: int|float
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/tax/remove-a-tax-rate
     */
    public function deleteRate(array $params, array $options = []): mixed
    {
        return $this->caller->call('tax.deleteRate', [], $params, $options);
    }
}

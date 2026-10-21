<?php

// Written by scripts/generate.php from the API reference. Do not edit by hand.

declare(strict_types=1);

namespace Shoply\Generated\Resources;

use Shoply\Generated\Caller;

final class Routing
{

    public function __construct(private readonly Caller $caller)
    {
    }

    /**
     * **Get Payment Routing**
     *
     * `settings`: whether it is on, how a checkout is given a processor (`mode`: `share`, by the share of the month's volume each should have; `order`, the first that can take it; `cheapest`, by the payment fee rates set in Finance), whether a declined card is moved to the next (`retry`), whether a returning buyer goes to their last one (`sticky`), and the health guard (`guard`, pausing a processor with `guardDeclines` of its last `guardWindow` routed payments declined) and `disputeAlert`, the dispute percent the store is told of. `processors` are in the routing in their order, each with its share, caps and order limits, its `state` (`rotation`, `cap`, `paused`, or `off` where it cannot take a card today) and its figures this month. `rules` are checked in their order, `available` is the connected card methods not in the routing yet, and `set` is false where the store has never set it up.
     *
     * Needs the `routing.read` permission (Read Payment Routing).
     *
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: list<array{
     *         id: string,
     *         kind: string,
     *         countries: list<string>,
     *         amountOp: mixed,
     *         amount: mixed,
     *         action: string,
     *         provider: string
     *     }>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/get-payment-routing
     */
    public function show(array $options = []): mixed
    {
        return $this->caller->call('routing.show', [], [], $options);
    }

    /**
     * **Change Payment Routing**
     *
     * Changes the settings named and keeps the rest. Switching it on needs a processor in the routing that can take a card today. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `enabled`: Whether checkouts are routed.
     * - `mode`: How a checkout is given a processor.
     * - `retry`: Whether a declined card is moved to the next processor. A card declined as stolen, lost or fake never is.
     * - `sticky`: Whether a returning buyer goes to the processor they last paid with.
     * - `guard`: Whether a processor whose keys fail, or with too many declines, is paused. The last one in rotation never is.
     * - `guardDeclines`: How many of the window's payments declined pause a processor, from 1 to `guardWindow`.
     * - `guardWindow`: How many of its last routed payments are judged, from 5 to 200.
     * - `disputeAlert`: The percent of a processor's paid orders disputed that the store is told of, once a week at most, above 0 and up to 100. Empty or null for none. Nothing is moved for it.
     *
     * @param array{
     *     enabled?: bool,
     *     mode?: 'share'|'order'|'cheapest',
     *     retry?: bool,
     *     sticky?: bool,
     *     guard?: bool,
     *     guardDeclines?: int,
     *     guardWindow?: int,
     *     disputeAlert?: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: list<array{
     *         id: string,
     *         kind: string,
     *         countries: list<string>,
     *         amountOp: mixed,
     *         amount: mixed,
     *         action: string,
     *         provider: string
     *     }>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/change-payment-routing
     */
    public function update(array $params = [], array $options = []): mixed
    {
        return $this->caller->call('routing.update', [], $params, $options);
    }

    /**
     * **Add a processor**
     *
     * Puts one of the store's connected card methods into the routing, last. The shares are made even again. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `provider` (required): The card method, by its name in "List payment methods".
     *
     * @param array{
     *     provider: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: mixed,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: array<mixed>,
     *     available: list<array{
     *         provider: string,
     *         name: string,
     *         usable: bool
     *     }>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/add-a-processor
     */
    public function addProcessor(array $params, array $options = []): mixed
    {
        return $this->caller->call('routing.addProcessor', [], $params, $options);
    }

    /**
     * **Change a processor**
     *
     * Sets a processor's share and limits, all five at once: one left out is no limit, and a share left out is 0. Caps count every paid order through the method, routed or not, over the UTC month and day. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `share`: Its share of the month's volume, as a whole percent from 0 to 100, for `mode` `share`.
     * - `capMonth`: The most it is given in a UTC month, in the store's currency. Empty for no cap.
     * - `capDay`: The most it is given in a UTC day. No more than `capMonth`.
     * - `minOrder`: The smallest order it is given.
     * - `maxOrder`: The largest order it is given. At least `minOrder`.
     *
     * @param string $provider The processor, by its payment method's name in "List payment methods".
     * @param array{
     *     share?: int,
     *     capMonth?: int|float,
     *     capDay?: int|float,
     *     minOrder?: int|float,
     *     maxOrder?: int|float
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: array<mixed>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/change-a-processor
     */
    public function updateProcessor(string $provider, array $params = [], array $options = []): mixed
    {
        return $this->caller->call('routing.updateProcessor', [$provider], $params, $options);
    }

    /**
     * **Remove a processor**
     *
     * Takes a processor out of the routing, with every rule about it. The method itself stays connected. The last one out switches routing off. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * @param string $provider The processor, by its payment method's name in "List payment methods".
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: array<mixed>,
     *     available: list<array{
     *         provider: string,
     *         name: string,
     *         usable: bool
     *     }>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/remove-a-processor
     */
    public function removeProcessor(string $provider, array $options = []): mixed
    {
        return $this->caller->call('routing.removeProcessor', [$provider], [], $options);
    }

    /**
     * **Put a processor back**
     *
     * Puts a processor the health guard paused back into the split. A `routing.processor_resumed` webhook is sent. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * @param string $provider The processor, by its payment method's name in "List payment methods".
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: list<array{
     *         id: string,
     *         kind: string,
     *         countries: list<string>,
     *         amountOp: mixed,
     *         amount: mixed,
     *         action: string,
     *         provider: string
     *     }>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/put-a-processor-back
     */
    public function resumeProcessor(string $provider, array $options = []): mixed
    {
        return $this->caller->call('routing.resumeProcessor', [$provider], [], $options);
    }

    /**
     * **Sort processors**
     *
     * Sets the processors' order, which `mode` `order` takes the first of. Every processor in the routing, once each. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `providers` (required): The processors' names in their new order.
     *
     * @param array{
     *     providers: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: array<mixed>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/sort-processors
     */
    public function sortProcessors(array $params, array $options = []): mixed
    {
        return $this->caller->call('routing.sortProcessors', [], $params, $options);
    }

    /**
     * **Add a rule**
     *
     * Adds a rule, last. Every `never` that fits an order leaves its processor out, then the first `only` that fits picks. A store holds up to 50. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `kind` (required): What it looks at: the buyer's country, or the order's amount.
     * - `countries`: For `country`: up to 100 countries, as two-letter codes.
     * - `amountOp`: For `amount`: whether it is about orders over the amount or under it.
     * - `amount`: For `amount`: the amount, in the store's currency.
     * - `action` (required): `only`: such orders go to this processor and no other. `never`: they never go to it.
     * - `provider` (required): The processor the rule is about, one in the routing.
     *
     * @param array{
     *     kind: 'country'|'amount',
     *     countries?: list<string>,
     *     amountOp?: 'over'|'under',
     *     amount?: int|float,
     *     action: 'only'|'never',
     *     provider: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: list<array{
     *         id: string,
     *         kind: string,
     *         countries: array<mixed>,
     *         amountOp: string,
     *         amount: int|float,
     *         action: string,
     *         provider: string
     *     }>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/add-a-rule
     */
    public function addRule(array $params, array $options = []): mixed
    {
        return $this->caller->call('routing.addRule', [], $params, $options);
    }

    /**
     * **Change a rule**
     *
     * Replaces a rule with the one sent. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `kind` (required): What it looks at: the buyer's country, or the order's amount.
     * - `countries`: For `country`: up to 100 countries, as two-letter codes.
     * - `amountOp`: For `amount`: whether it is about orders over the amount or under it.
     * - `amount`: For `amount`: the amount, in the store's currency.
     * - `action` (required): `only`: such orders go to this processor and no other. `never`: they never go to it.
     * - `provider` (required): The processor the rule is about, one in the routing.
     *
     * @param string $ruleId The rule.
     * @param array{
     *     kind: 'country'|'amount',
     *     countries?: list<string>,
     *     amountOp?: 'over'|'under',
     *     amount?: int|float,
     *     action: 'only'|'never',
     *     provider: string
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: list<array{
     *         id: string,
     *         kind: string,
     *         countries: list<string>,
     *         amountOp: mixed,
     *         amount: mixed,
     *         action: string,
     *         provider: string
     *     }>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/change-a-rule
     */
    public function updateRule(string $ruleId, array $params, array $options = []): mixed
    {
        return $this->caller->call('routing.updateRule', [$ruleId], $params, $options);
    }

    /**
     * **Delete a rule**
     *
     * Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * @param string $ruleId The rule.
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: array<mixed>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/delete-a-rule
     */
    public function deleteRule(string $ruleId, array $options = []): mixed
    {
        return $this->caller->call('routing.deleteRule', [$ruleId], [], $options);
    }

    /**
     * **Sort rules**
     *
     * Sets the order rules are checked in. Every rule, once each. Answers the whole of Payment Routing again, as "Get Payment Routing" does.
     *
     * Needs the `routing.write` permission (Change Payment Routing).
     *
     * Fields:
     *
     * - `ids` (required): The rules' IDs in their new order.
     *
     * @param array{
     *     ids: list<string>
     * } $params
     * @param array{idempotencyKey?: string, timeout?: int|float, maxRetries?: int, headers?: array<string, string>} $options
     * @return array{
     *     set: bool,
     *     settings: array{
     *         enabled: bool,
     *         mode: string,
     *         retry: bool,
     *         sticky: bool,
     *         guard: bool,
     *         guardDeclines: int|float,
     *         guardWindow: int|float,
     *         disputeAlert: int|float
     *     },
     *     processors: list<array{
     *         provider: string,
     *         name: string,
     *         share: int|float,
     *         capMonth: int|float,
     *         capDay: mixed,
     *         minOrder: mixed,
     *         maxOrder: mixed,
     *         state: string,
     *         pausedReason: string,
     *         pausedAt: mixed,
     *         month: int|float,
     *         day: int|float,
     *         approved: mixed,
     *         disputes: mixed,
     *         fee: mixed
     *     }>,
     *     rules: list<array{
     *         id: string,
     *         kind: string,
     *         countries: list<string>,
     *         amountOp: mixed,
     *         amount: mixed,
     *         action: string,
     *         provider: string
     *     }>,
     *     available: array<mixed>,
     *     figures: array{
     *         routed: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         approved: mixed,
     *         saved: array{
     *             orders: int|float,
     *             volume: int|float
     *         },
     *         disputes: mixed
     *     },
     *     limits: array{
     *         rules: int|float,
     *         countries: int|float,
     *         guardWindowMin: int|float,
     *         guardWindowMax: int|float
     *     }
     * }
     * @throws \Shoply\ShoplyException
     * @see https://docs.shoply.gg/api-reference/payment-routing/sort-rules
     */
    public function sortRules(array $params, array $options = []): mixed
    {
        return $this->caller->call('routing.sortRules', [], $params, $options);
    }
}

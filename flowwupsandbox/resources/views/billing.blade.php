<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Billing') }} ({{ Auth::user()->currentTeam->name }})
        </h2>
    </x-slot>
    <!-- Pricing table -->
    <div class="mb-3" style="display:none;">
        <h6 class="mb-0 font-weight-semibold">
            Table view
        </h6>
        <span class="text-muted d-block">Simple table with content</span>
    </div>
    <div class="card" style="display:none;">
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered table-lg text-center">
                <thead>
                    <tr>
                        <th class="text-left">Choose a plan</th>
                        <th>
                            <h6 class="font-weight-semibold my-1">Starter</h6>
                            <h4 class="font-weight-semibold mb-0">
                                $25
                                <span class="font-size-base text-muted font-weight-normal">/ month</span>
                            </h4>
                        </th>
                        <th>
                            <h6 class="font-weight-semibold my-1">Growth</h6>
                            <h4 class="font-weight-semibold mb-0">
                                $35
                                <span class="font-size-base text-muted font-weight-normal">/ month</span>
                            </h4>
                        </th>
                        <th>
                            <h6 class="font-weight-semibold my-1">Business</h6>
                            <h4 class="font-weight-semibold mb-0">
                                $49
                                <span class="font-size-base text-muted font-weight-normal">/ month</span>
                            </h4>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">Total Active Boards</td>
                        <td>5</td>
                        <td>15</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td class="text-left">Tracked Users</td>
                        <td>250</td>
                        <td>2,500</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td class="text-left">Active Team Members</td>
                        <td>3</td>
                        <td>15</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td class="text-left">Backups</td>
                        <td><i class="icon-cancel-square2 text-danger"></i></td>
                        <td><i class="icon-checkbox-checked2 text-success"></i></td>
                        <td><i class="icon-checkbox-checked2 text-success"></i></td>
                    </tr>
                    <tr>
                        <td class="text-left">24/7 support</td>
                        <td><i class="icon-cancel-square2 text-danger"></i></td>
                        <td><i class="icon-cancel-square2 text-danger"></i></td>
                        <td><i class="icon-checkbox-checked2 text-success"></i></td>
                    </tr>
                    <tr class="table-border-solid">
                        <td> </td>
                        <td><a class="btn bg-blue" href="#"><i class="icon-cart mr-2"></i> Order</a></td>
                        <td><a class="btn bg-blue" href="#"><i class="icon-cart mr-2"></i> Order</a></td>
                        <td><a class="btn bg-blue" href="#"><i class="icon-cart mr-2"></i> Order</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /pricing table -->

    <!-- Pricing table two -->
    <div class="mb-3 pt-2">
        <h6 class="mb-0 font-weight-semibold">
            Chose a Plan
        </h6>
        <span class="text-muted d-block">FLOWWUP uses Stripe for billing. You will be taken to Stripe's website to manage your subscription.</span>
    </div>

    <div class="card-group mb-3">
        <div class="card">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Choose a Plan</h4>
                <h1 class="pricing-table-price"><span class="mr-1"></span></h1>
                <ul class="pricing-table-list list-unstyled mb-3">
                    <li><strong></strong> </li>
                    <li><strong>Total Teams </strong> </li>
                    <li><strong>Total Active Boards </strong> </li>
                    <li><strong>Tracked Users</strong></li>
                    <li><strong>Active Team Members</strong> </li>
                    <li><strong>Daily Backups</strong> </li>
                    <li><strong>24/7 Support</strong> </li>
                </ul>
                <!-- <a href="#" class="btn bg-danger-400 btn-lg text-uppercase font-size-sm font-weight-semibold">Purchase</a> -->
            </div>
        </div>

        <div class="card">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Starter</h4>
                <h1 class="pricing-table-price"><span class="mr-1">$</span>25
                </h1>
               
                <ul class="pricing-table-list list-unstyled mb-3">
                    <li><strong></strong> </li>
                    <li><strong>1</strong> </li>
                    <li><strong>5</strong> </li>
                    <li><strong>250</strong> </li>
                    <li><strong>3</strong> </li>
                    <li><strong><i class="icon-cancel-square2 text-danger"></i></strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                </ul>
                <button data-plan="plan_starter"  class="btn bg-primary-400 btn-lg text-uppercase font-size-sm font-weight-semibold">Subscribe</button>
            </div>


        </div>

        <div class="card">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Growth</h4>
                <h1 class="pricing-table-price"><span class="mr-1">$</span>35</h1>
                <ul class="pricing-table-list list-unstyled mb-3">
                    <li><strong></strong> </li>
                    <li><strong>5</strong> </li>
                    <li><strong>15</strong> </li>
                    <li><strong>2,500</strong> </li>
                    <li><strong>15</strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                </ul>
                <button data-plan="plan_growth" class="btn bg-pink-600 btn-lg text-uppercase font-size-sm font-weight-semibold">Subscribe</button>
            </div>
            <div class="ribbon-container">
                <div class="ribbon bg-pink-600">Popular</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Business</h4>
                <h1 class="pricing-table-price"><span class="mr-1">$</span>49</h1>
                <ul class="pricing-table-list list-unstyled mb-3">
                    <li><strong></strong> </li>
                    <li><strong>10</strong> </li>
                    <li><strong>Unlimited</strong> </li>
                    <li><strong>Unlimited</strong> </li>
                    <li><strong>Unlimited</strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                </ul>
                <button data-plan="plan_business" class="btn bg-primary-400 btn-lg text-uppercase font-size-sm font-weight-semibold">Subscribe</button>
            </div>
        </div>
    </div>
    <!-- /pricing table two -->
    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-10 sm:mt-0">
                <x-jet-action-section>
                    <x-slot name="title">
                        {{ __('Manage Subscription') }}
                    </x-slot>

                    <x-slot name="description">
                        {{ __('Subscribe, upgrade, downgrade or cancel your subscription.') }}
                    </x-slot>

                    <x-slot name="content">
                        <p>{{ env('APP_NAME') . __(' uses Stripe for billing. You will be taken to Stripe\'s website to manage your subscription.') }}</p>

                        @if (Auth::user()->currentTeam->subscribed('default'))
                        <div class="mt-6">
                            <a class="btn" href="{{ route('stripe.portal') }}">
                                {{ __('Manage Subscription') }}
                            </a>
                        </div>
                        @else
                        <div id="error-message" class="hidden p-2 mt-4 bg-pink-100"></div>

                        <div class="mt-4">
                            <button data-plan="plan_XXXXX" class="btn checkout-btn">
                                {{ __('Subscribe to Plan 1') }}
                            </button>
                        </div>
                        <div class="mt-4">
                            <button data-plan="plan_XXXXX" class="btn checkout-btn">
                                {{ __('Subscribe to Plan 2') }}
                            </button>
                        </div>
                        @endif
                    </x-slot>
                </x-jet-action-section>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
var handleFetchResult = function(result) {
    if (!result.ok) {
        return result.json().then(function(json) {
            if (json.error && json.error.message) {
                throw new Error(result.url + ' ' + result.status + ' ' + json.error.message);
            }
        });
    }
    return result.json();
};

var createCheckoutSession = function(plan) {
    return fetch("/stripe/checkout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            plan: plan
        })
    }).then(handleFetchResult);
};

var handleResult = function(result) {
    if (result.error) {
        showErrorMessage(result.error.message);
    }
};

var showErrorMessage = function(message) {
    var errorEl = document.getElementById("error-message")
    errorEl.textContent = message;
    errorEl.style.display = "block";
};

var stripe = Stripe('{{ env('STRIPE_KEY') }}');
var checkoutBtns = document.getElementsByClassName('checkout-btn');

for (var i = 0; i < checkoutBtns.length; i++) {
    checkoutBtns[i].addEventListener("click", function(e) {
        var plan = e.target.getAttribute("data-plan");

        createCheckoutSession(plan).then(function(data) {
            stripe
                .redirectToCheckout({
                    sessionId: data.sessionId
                })
                .then(handleResult);
        });
    })
}
</script>
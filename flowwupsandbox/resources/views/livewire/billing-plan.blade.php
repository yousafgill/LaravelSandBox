<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Billing') }} ({{ Auth::user()->currentTeam->name }})
        </h2>
    </x-slot>
    <div class="mb-3 pt-2">
        <h6 class="mb-0 font-weight-semibold">
            Chose a Billing Plan
        </h6>
        <span class="text-muted d-block">FLOWWUP uses Stripe for billing. You will be taken to Stripe's website to manage your subscription.</span>
    </div>
    @if ($trialExpired)
    <div class="alert alert-danger">
        Your Free Trial is over. Please choose plan to continue.
    </div>
    @endif
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


        <div class="card {{$starter_class}}">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Starter</h4>
                <h1 class="pricing-table-price"><span class="mr-1">$</span>35
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
                
                @if($planname=='Starter')
                    @if($planstatus=="Cancel")
                        <a href="#" wire:click.prevent="$emit('reactivateplan')" class="btn bg-success btn-lg text-uppercase font-size-sm font-weight-semibold">Re-Activate</a>
                    @else
                        <a href="{{route('subscription.cancel')}}" class="btn bg-danger btn-lg text-uppercase font-size-sm font-weight-semibold">Cancel Subscription</a>
                    @endif
                @else
                    <button data-plan="price_1InS0bKZIdFWcYAY4rOG3dNR" class="btn bg-primary-400 btn-lg text-uppercase font-size-sm font-weight-semibold checkout-btn">{{$sbtn}}</button>
                @endif
            </div>
        </div>

        <div class="card {{$growth_class}}">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Growth</h4>
                <h1 class="pricing-table-price"><span class="mr-1">$</span>75</h1>
                <ul class="pricing-table-list list-unstyled mb-3">
                    <li><strong></strong> </li>
                    <li><strong>1</strong> </li>
                    <li><strong>15</strong> </li>
                    <li><strong>2,500</strong> </li>
                    <li><strong>15</strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                </ul>
                
                @if($planname=='Growth')
                    @if($planstatus=="Cancel")
                        <a href="#" wire:click.prevent="$emit('reactivateplan')" class="btn bg-success btn-lg text-uppercase font-size-sm font-weight-semibold">Re-Activate</a>
                    @else
                        <a href="{{route('subscription.cancel')}}" class="btn bg-danger btn-lg text-uppercase font-size-sm font-weight-semibold">Cancel Subscription</a>
                    @endif
                @else
                    <button data-plan="price_1InS0bKZIdFWcYAYzvhQIMaj" class="btn bg-pink-600 btn-lg text-uppercase font-size-sm font-weight-semibold checkout-btn">{{$gbtn}}</button>
                @endif
            </div>
            <div class="ribbon-container">
                <div class="ribbon bg-pink-600">Popular</div>
            </div>
        </div>

        <div class="card {{$business_class}}">
            <div class="card-body text-center px-0">
                <h4 class="mt-2 mb-3">Business</h4>
                <h1 class="pricing-table-price"><span class="mr-1">$</span>125</h1>
                <ul class="pricing-table-list list-unstyled mb-3">
                    <li><strong></strong> </li>
                    <li><strong>1</strong> </li>
                    <li><strong>Unlimited</strong> </li>
                    <li><strong>Unlimited</strong> </li>
                    <li><strong>Unlimited</strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                    <li><strong><i class="icon-checkbox-checked2 text-success"></i></strong> </li>
                </ul>
                
                @if($planname=='Business')
                    @if($planstatus=="Cancel")
                        <a href="#" wire:click.prevent="$emit('reactivateplan')"  class="btn bg-success btn-lg text-uppercase font-size-sm font-weight-semibold">Re-Activate</a>
                    @else
                        <a href="{{route('subscription.cancel')}}" class="btn bg-danger btn-lg text-uppercase font-size-sm font-weight-semibold">Cancel Subscription</a>
                    @endif
                @else
                    <button data-plan="price_1InS0bKZIdFWcYAYrab5zPKv" class="btn bg-primary-400 btn-lg text-uppercase font-size-sm font-weight-semibold checkout-btn">{{$bbtn}}</button>
                @endif

            </div>
        </div>
    </div>

</div>

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

var stripe = Stripe('pk_test_51CnW0OKZIdFWcYAYX69ayYYZ7kRLrBnTXyg6RJzDg4KuhOoEsahisxFy62rs70QrlIcYhwhJtT9zyIPdCQl0NNeN00bePJFhjC');
// var stripe = Stripe('{{ env('STRIPE_KEY') }}');
var checkoutBtns = document.getElementsByClassName('checkout-btn');

for (var i = 0; i < checkoutBtns.length; i++) {
    checkoutBtns[i].addEventListener("click", function(e) {
        var plan = e.target.getAttribute("data-plan");

        createCheckoutSession(plan).then(function(data) {
            stripe.redirectToCheckout({
                    sessionId: data.sessionId
                })
                .then(handleResult);
        });
    })
}
</script>
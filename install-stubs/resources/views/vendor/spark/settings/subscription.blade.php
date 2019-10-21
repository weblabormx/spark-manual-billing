@if(SparkManualBilling::showBilling())
    <spark-subscription :user="user" :team="team" :billable-type="billableType" inline-template>
        <div>
            <div v-if="plans.length > 0">
                <!-- Trial Expiration Notice -->
                @include('spark::settings.subscription.trial-expiration-notice')

                <!-- New Subscription -->
                <div v-if="needsSubscription">
                    @include('spark::settings.subscription.subscribe')
                </div>

                <!-- Update Subscription -->
                <div v-if="subscriptionIsActive">
                    @include('spark::settings.subscription.update-subscription')
                </div>

                <!-- Resume Subscription -->
                <div v-if="subscriptionIsOnGracePeriod">
                    @include('spark::settings.subscription.resume-subscription')
                </div>

                <!-- Cancel Subscription -->
                <div v-if="subscriptionIsActive">
                    @include('spark::settings.subscription.cancel-subscription')
                </div>
            </div>

            <!-- Plan Features Modal -->
            @include('spark::modals.plan-details')
        </div>
    </spark-subscription>
@else
    <div class="card">
        <div class="card-header">
            {{__('Subscription')}}
        </div>
        <div class="card-body">
            <p>{{__('Please contact to our team to active your subscription.')}}</p>
            <footer class="blockquote-footer">You can Email us to <cite title="Source Title">{{ Spark::$sendsSupportEmailsTo }}</cite></footer>
        </div>
    </div>
@endif
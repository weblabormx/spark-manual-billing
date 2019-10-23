# Spark Manual Billing

Package to add extra features to Laravel Spark using Teams billing.

## Features
### Done
- Allows to add manually extra time for free trial to teams
- Allows to mark payments as done (In case you accept payments via a third party payment method)
- User search improved
- Option to disable suscriptions (In case you want to handle it manually or want to use another payment method)

### To do's 
We would like to implement more features for this packages, with your support or code collaboration it can be possible to be done. (We are open to new suggestions!)
- To work with user billing
- To accept payments with Paypal besides Stripe

## Documentation
### Installation
- Execute `composer require weblabormx/spark-manual-billing`
- Install executing the next command `php artisan spark:manual-billing`, this command will edit some spark views.

### Disable Suscriptions

You can disable the suscriptions by modifying the SparkServiceProvider

```
use WeblaborMx\SparkManualBilling\SparkManualBilling;

public function booted()
{
	SparkManualBilling::hideBilling();
}
```

## Premium Support
If you'd like to implement this package in your project and need our help, or you just want to help this package to continue being develop please write us to carlosescobar@weblabor.mx and we can talk about prices for premium support.
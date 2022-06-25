# Changelog

All notable changes to `laravel-alma-client` will be documented in this file.

## **Version 1.0.2**
- Final release with somme added methods
  getPaymentStatus(string $paymentId): Payment
  public function createPayment(array $data): Payment
  getFeePlans(
        string $kind = FeePlan::KIND_GENERAL,
        $installmentsCounts = "all",
        bool $includeDeferred = false
    )

## **Version 1.0.1**

### Fixed
- Instanciate Alma Client take good config key
- Client implementation

### Changed
- Require Alma client ~1 instead of fixed ^1.8

## **Version 1.0.0**

### Initial release

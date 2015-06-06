##1.0.0

* Initial release

##2.0.0

* Added namespaces

##2.0.1

* Removed function factory in ItemCollectionFactoryInterface and renamed it ItemCollectionInterface to avoid duplicate function names with PropertyInterface. 
Duplicate function names in implemented interfaces is allowed in some envoriments.

##2.0.2
* Renamed ItemCollectionFactoryInterface to ItemCollectionInterface that was missed in 2.0.1

##3.0.0
* Added GetAddresses, GetPaymentOptions and AuthorizePayment endpoints that is mainly used for invoice payments. In this upgrade some refactoring had to be done. 
Some Paynova/request/model's have been moved to Paynova/model's and other needed changes.

##3.0.1
* Text changes to README.md

##3.0.2
* Text updates
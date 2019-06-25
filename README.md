# M-PESA API


M-PESA MIPAY Api
---


## making requests

* all api calls are POST requests 
* the content body is json 
* all api responses are json 

# authentication

constants parameters to include in all requests

```
CHID = 13;
gateway_host = gomipay.com;
lat = '0.0'
lng = '0.0'
```

api access parameters
```
username
password
api key

```
variable parameters

* timestamp
 unix timestamp

* ip_address 
YOUR HOST IP ADDRESS (ipv4|ipv6)


### payload encryption
all requests require a `sec_hash` that can be generated as described below

payload is the POST data  
`sec_hash` and `credentials` are not included in the sec_hash generation

the payload key values are combined into a string like GET query params 
i.e  

```
key1=val1&key2=val2
```
the payload keys *must* be lowercased when creating the string  

the `sec_hash` is a keyed hash value of the payload string using the HMAC method (sha256) 

base64 decoded *API key* is the shared secret key used for generating the HMAC variant of the message digest

## endpoints
> please note that it must end in a slash

### /api/REMIT

#### params
* MSISDN
message recipient
* product_id
the product to send money to (B2B|B2C)
* scheduled_send 
format = "17/09/2016 6:31 am" (d/m/Y H:M (am/pm))


# response 
the response will contain the following keys

* "response_status"
only status of 00 is a success
* "response" 
message accompanying the status 



# M-PESA C2B

#### Checkout
A `reference` is used to make a request
To obtain a `reference`,   
a service user must have made a prior service request (SALE ORDER) to obtain a reference to use in 
the request.   
A reference can only be used once and would no longer be accessible once a payment is made


#### Sale
To obtain `product_item_id`, the service user would be issued with the `product_item_id` Identifying the  
product for sale and can be used repeatedly to make  multiple sales of different amounts with different users.


#### Order
To obtain `cart_items`, the service (`ADD TO CART`) must have been done, and the items on cart obtained, 


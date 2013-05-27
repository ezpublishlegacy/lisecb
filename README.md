lisecb
======

ECB Currency Converter extension for eZPublish


Calculates the amount of EUR price in another currency.

Pricedata are fetched from the ECB and cached for 1 day (var/cache/):
http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml 

Template Operators: 
```
{$price|exchange("CHF")} -> returns the current price.

{$price|rate("CHF")} -> returns the current rate.
```
View: 
```
/lisecb/converter/(price)/100/(currency)/CHF
-> returns Json: {"price" : "100", "rate" : "1.232")}
```

Javascript Example: 
```JavaScript
<script type="text/javascript">
function getCurrency(price,currency)
{
   $.ajax({
  url: '/lisecb/convert/(price)/'+ price + '/(currency)/' + currency ,
  dataType: 'json',
  success: function(data){
        $("#currency").html(data.price);
        $("#rate").html(data.rate);
     }
    });
}
</script>
```
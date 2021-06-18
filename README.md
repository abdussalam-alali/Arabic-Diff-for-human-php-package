# Arabic diffForHumans()
<hr>

### Description:
Generating Arabic human-readable strings for the time difference between the current date and a given date
### Examples
Current Date: 2021-06-18 9:58pm , Given date: 2021-06-18 10:00pm

        result : منذ دقيقتين

Current Date: 2021-06-14 9:58pm , Given date: 2021-06-18 10:00pm

        result : منذ 4 أيام
### Installing
Using composer: <br>
``

### Usage:
1- Get Diff from timestamp :

```php
use Abdussalam\ArDiffForHumans\ArabicDiffForHumans;

ArabicDiffForHumans::get($timestamp); 
```
Example:
```php
    // Current date 2021-06-18 10:09pm
    $time = "2018-1-1";
    $timeStamp = strtotime($time);
    echo ArabicDiffForHumans::get($timeStamp); 
// منذ 3 سنين
```

2- Get Diff from timestamp :

```php
use Abdussalam\ArDiffForHumans\ArabicDiffForHumans;

ArabicDiffForHumans::getFromDateString($dateString); 
```
Example:

```php
    // Current date 2021-06-18 10:09pm
    $time = "2018-1-1";
    
    echo ArabicDiffForHumans::getFromDateString($time); 
// منذ 3 سنين
```


### In Blade view:


```php
    {{ Abdussalam\ArDiffForHumans\ArabicDiffForHumans::get($timeStamp) }}
   {{ Abdussalam\ArDiffForHumans\ArabicDiffForHumans::getFromDateString($dateString) }}
```

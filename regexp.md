---
title: Regular Expressions
---

=====javascript math id= parameter in querystring=====
```javascript
var link = "http://aap.com?nav_id=3-1&id=138622&index=14";
var matches = link.match(/&id=([^&]*)/);
var id = matches ? matches[1] : null;
//result: 138622
```

=====regexp pal=====
http://www.regexpal.com/

=====javascript parse whitespace=====
```javascript
let wc = "        7      1312";
wc.split(/,?\s+/).filter(Boolean);
```

=====Shiffman about regex=====
http://shiffman.net/a2z/regex/

===== Find all URLs starting with http and ending with .html =====
this works in the SublimeText search function:
  (http).*(.html)

===== Online tools =====
* http://regexr.com/
* http://txt2re.com/
* http://www.phpliveregex.com/ (php)

===== expr =====
```bash
expr "ok T:83.4 /0.0 B:0.0 /0.0 @:0" : 'ok T:\([0-9]*\.[0-9]*\)'
```

=====sed & cut=====
```bash
grep -o '\(T:\)\([0-9]*\.[0-9]*\)' /tmp/UltiFi/ttyACM0/ temp.out | cut -c 3-
```
```bash
grep "spotify:track:" spotify.json | cut -c 16-51
grep "spotify:track:" spotify.json | head -n 1 | cut -c 16-51    # only first result
```

=====awk=====
see [[awk]]

=====turing machine with SED=====
http://sed.sourceforge.net/grabbag/scripts/turing.sed

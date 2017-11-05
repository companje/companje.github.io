---
title: PDF
---

===== pdf to jpg =====
http://pdf2jpg.net/

===== text files to pdf =====
<code bash>
#!/bin/bash
for file in *.txt; do
    textutil -convert rtf -font 'Courier New' -fontsize 9 ${file} -output ${file}.rtf
    cupsfilter -D ${file}.rtf > ${file}.pdf
done
</code>

===== images to pdf=====
  convert 1.png 2.png 3.png 4.png 5.png 6.png 7.png 8.png 9.png 10.png 11.png 12.png 13.png 14.png 15.png siene-sam.pdf
  
===== Online client-sided pdf to text =====
* http://pdftotext.org/

===== PDFTK =====
* Install ''pdftk'' for usefull command-line PDF stuff.

=====remove page 4 from a pdf=====
  pdftk input.pdf cat 1-3 5 output bijlage1.pdf
  
====concat=====
  pdftk offerte.pdf bijlage1.pdf bijlage2.pdf bijlage3.pdf output combi.pdf
  
====qpdf=====
  qpdf --linearize input.pdf output.pdf

#!/bin/bash
cd /var/www/html/tesisPPP/files/24ada0/Process
./teqc +qc /var/www/html/tesisPPP/files/24ada0/Rinex/BOGA2730.17O
./azelplot /var/www/html/tesisPPP/files/24ada0/Process/BOGA.inp
sh BOGA.bat
convert -density 300 BOGA.ps -resize 1024x1024 /var/www/html/tesisPPP/files/24ada0/Report/BOGA_2.gif
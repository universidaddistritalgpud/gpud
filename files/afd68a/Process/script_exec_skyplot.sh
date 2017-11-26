#!/bin/bash
cd /var/www/html/tesisPPP/files/afd68a/Process
./teqc +qc /var/www/html/tesisPPP/files/afd68a/Rinex/VIVI0660.12O
./azelplot /var/www/html/tesisPPP/files/afd68a/Process/VIVI.inp
sh VIVI.bat
convert -density 300 VIVI.ps -resize 1024x1024 /var/www/html/tesisPPP/files/afd68a/Report/VIVI_2.gif
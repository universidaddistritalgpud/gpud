#!/bin/tcsh
gmt gmtset PS_MEDIA Custom_250x280
gmt psxy elevRings_BOGA_20170930-160000_20170930-235945.dat -R-1.6/1.6/-1.6/1.6 -JX7.0  -W1.0p -G0/0/0 -G230 -V  -K -P -X0.75 -Y1.0 > BOGA.ps
gmt psxy cutoffRing_BOGA_20170930-160000_20170930-235945.dat -R -JX  -W0.2t4_8:0p  -G255 -V  -O -K -P >> BOGA.ps
gmt psxy elevRings_BOGA_20170930-160000_20170930-235945.dat -R -JX -W1.0p -G/0/0/0  -V  -O -K -P >> BOGA.ps
gmt psxy elevRings_BOGA_20170930-160000_20170930-235945.dat -R -JX -W0.5p -G/255/255/255  -V  -O -K -P >> BOGA.ps
gmt pstext title_BOGA_20170930-160000_20170930-235945.txt -R -JX -N -V  -O -K -P >> BOGA.ps
gmt psvelo mp_BOGA_20170930-160000_20170930-235945.xy -R -JX  -L -W0.5p -G175/175/175 -Se1/0.95/0 -A0.0/0.0/0.0 -N  -O -K -P -V >>  BOGA.ps

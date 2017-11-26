#!/bin/tcsh
gmt gmtset PS_MEDIA Custom_250x280
gmt psxy elevRings_VIVI_20120306-160000_20120306-235945.dat -R-1.6/1.6/-1.6/1.6 -JX7.0  -W1.0p -G0/0/0 -G230 -V  -K -P -X0.75 -Y1.0 > VIVI.ps
gmt psxy cutoffRing_VIVI_20120306-160000_20120306-235945.dat -R -JX  -W0.2t4_8:0p  -G255 -V  -O -K -P >> VIVI.ps
gmt psxy elevRings_VIVI_20120306-160000_20120306-235945.dat -R -JX -W1.0p -G/0/0/0  -V  -O -K -P >> VIVI.ps
gmt psxy elevRings_VIVI_20120306-160000_20120306-235945.dat -R -JX -W0.5p -G/255/255/255  -V  -O -K -P >> VIVI.ps
gmt pstext title_VIVI_20120306-160000_20120306-235945.txt -R -JX -N -V  -O -K -P >> VIVI.ps
gmt psvelo mp_VIVI_20120306-160000_20120306-235945.xy -R -JX  -L -W0.5p -G175/175/175 -Se1/0.95/0 -A0.0/0.0/0.0 -N  -O -K -P -V >>  VIVI.ps
gmt psxy 2VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 3VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 6VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 9VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 12VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 14VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 15VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 16VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 18VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 19VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 20VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 21VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 22VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 24VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 25VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 27VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 29VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 30VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 31VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy 32VIVI_20120306-160000_20120306-235945.sat.xy -R -JX -W0.15p -V -P  -O -K >> VIVI.ps
gmt psxy hr_VIVI_20120306-160000_20120306-235945.xy -R -JX -V  -Sc0.03 -Gred -O -K -P >> VIVI.ps
gmt pstext hr_VIVI_20120306-160000_20120306-235945.txt -R -JX -V -O -K -P >> VIVI.ps
gmt psxy cross_VIVI_20120306-160000_20120306-235945.txt -R -JX -V  -W0.15p -O -K -P -G0 >> VIVI.ps
gmt pstext nesw_VIVI_20120306-160000_20120306-235945.txt  -R  -JX -O -K  -N   >> VIVI.ps
gmt psvelo arrows_VIVI_20120306-160000_20120306-235945.xy -R -JX  -L  -W1.0p -Gred -Se1/0.95/7 -A0.0020/0.035/0.025 -N -O -K -P -V >> VIVI.ps
gmt pstext ring_VIVI_20120306-160000_20120306-235945.txt -R  -JX -O -N -W1.0p>> VIVI.ps
echo ------------------------------ 
echo ------------------------------ 
echo View or print VIVI.ps

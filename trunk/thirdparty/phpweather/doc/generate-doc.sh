#!/bin/bash
#
# Copyright 2004 Martin Geisler <gimpster@gimpster.com>
# You're free to use this script as described in the GPL.

echo -n "Generating phpweather.dvi... "
texi2dvi -q -c src/phpweather.texi
echo "done."

echo -n "Generating phpweather.pdf... "
texi2pdf -q -c src/phpweather.texi
echo "done."

echo -n "Generating phpweather.html... "
texi2html src/phpweather.texi
echo "done."

echo -n "Generating phpweather.ps... "
dvips -q phpweather.dvi -o phpweather.ps
echo "done."

echo -n "Generating phpweather.info... "
makeinfo -I src src/phpweather.texi
echo "done."

echo -n "Generating phpweather.txt... "
makeinfo -I src --no-headers src/phpweather.texi -o phpweather.txt
echo "done."

echo -n "Generating AUTHORS... "
makeinfo --no-headers src/contributors.texi -o ../AUTHORS
echo "done."

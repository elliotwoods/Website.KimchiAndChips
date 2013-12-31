php works.php > works.html

for phpName in *.php
do
	say "$phpName file.."
	base=`basename $phpName .php`
	htmlName=$base
	htmlName+=".html"
	say $htmlName
done
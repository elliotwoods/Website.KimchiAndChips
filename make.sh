php works.php > works.html

for phpName in *.php
do
	base=`basename $phpName .php`
	htmlName=$base
	htmlName+=".html"

	#say "$phpName file.."
	#say $htmlName

	php $phpName --export > $htmlName
done
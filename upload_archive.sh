rm archive/*_cache.json
rsync -urltv --delete -e ssh ./archive kimchiandchips@kimchiandchips.com:~/kimchiandchips
